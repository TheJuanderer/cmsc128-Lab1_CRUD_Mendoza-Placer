<?php
    include 'DBConnector.php';
    include 'query_helpers.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $task_id = intval($_POST['task_id'] ?? 0);
    $task = get_task($conn, $task_id);

    if ($task) {
        soft_delete_task($conn, $task_id);

        // read once by index.php to render the undo toast
        $_SESSION['undo_task_id'] = $task_id;
        $_SESSION['undo_task_title'] = $task['title'];
        $_SESSION['flash_success'] = 'Task deleted.';
    }

    header('Location: index.php');
    exit;
?>
