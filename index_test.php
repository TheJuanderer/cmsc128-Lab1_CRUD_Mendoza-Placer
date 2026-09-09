<?php

    // this is the file where the reading is done

    include 'DBConnector.php';
    include 'query_helpers.php';
    

    // JOIN so we get readable names instead of raw priority_id/category_id
    $sql = "
        SELECT 
            Task.task_id,
            Task.title,
            Task.due_date,
            Priority.priority_name,
            Category.category_name
        FROM Task
        JOIN Priority ON Task.priority_id = Priority.priority_id
        JOIN Category ON Task.category_id = Category.category_id
        ORDER BY Task.due_date ASC
    ";

    $tasks = query_ret($conn, $sql);

    if ($tasks === false) {
        die("Error fetching tasks: " . $conn->error);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>To-Do List</title>
</head>
<body>

    <h1>My To-Do List</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Title</th>
                <th>Due Date</th>
                <th>Priority</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($tasks)): ?>
                <tr>
                    <td colspan="4">No tasks yet.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['title']) ?></td>
                        <td><?= htmlspecialchars($task['due_date']) ?></td>
                        <td><?= htmlspecialchars($task['priority_name']) ?></td>
                        <td><?= htmlspecialchars($task['category_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>