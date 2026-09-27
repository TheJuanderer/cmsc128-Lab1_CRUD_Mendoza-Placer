<?php
    include 'DBConnector.php';
    include 'query_helpers.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: index.php');
        exit;
    }

    $task_id = intval($_POST['task_id'] ?? 0);
    toggle_task_done($conn, $task_id);

    // send the user back to whatever filtered/sorted view they were on
    $back = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header('Location: ' . $back);
    exit;
?>
