<?php
$filename = "recipes.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Overwrite mode: replace all recipes
    if (isset($_GET['overwrite']) && $data && is_array($data)) {
        $lines = [];
        foreach ($data as $recipe) {
            $lines[] = json_encode($recipe);
        }
        file_put_contents($filename, implode("\n", $lines) . "\n");
        echo json_encode(['success' => true]);
        exit;
    }

    // Save a new recipe (append)
    if ($data && isset($data['name'], $data['ingredients'], $data['instructions'], $data['submittedBy'], $data['approved'])) {
        $line = json_encode($data) . "\n";
        file_put_contents($filename, $line, FILE_APPEND | LOCK_EX);
        echo json_encode(['success' => true]);
        exit;
    }
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
    exit;
} else {
    // Read all recipes
    $recipes = [];
    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $recipes[] = json_decode($line, true);
        }
    }
    echo json_encode($recipes);
    exit;
}
?>