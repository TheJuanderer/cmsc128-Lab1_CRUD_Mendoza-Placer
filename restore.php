<?php
    include 'DBConnector.php';
    include 'query_helpers.php';

    // Ensure the script is only accessed via POST requests to prevent direct URL access
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    // Retrieve and sanitize the task ID from the POST request, defaulting to 0
    $task_id = intval($_POST['task_id'] ?? 0);
    restore_task($conn, $task_id);

    // Set a session flash message to display a success notification on the main page
    $_SESSION['flash_success'] = 'Task restored.';

    header('Location: index.php');
    exit;
?>
