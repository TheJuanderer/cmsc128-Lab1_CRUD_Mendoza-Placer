<?php
    include 'DBConnector.php';
    include 'query_helpers.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $task_id = intval($_POST['task_id'] ?? 0);
    restore_task($conn, $task_id);

    $_SESSION['flash_success'] = 'Task restored.';

    header('Location: index.php');
    exit;
?>
