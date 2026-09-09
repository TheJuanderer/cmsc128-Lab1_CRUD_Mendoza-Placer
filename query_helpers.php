
<?php 
    include 'DBConnector.php';

    //this returns an array of what you queried in SQL
    function query_ret($conn, $sql) {
        $result = $conn->query($sql);

        if ($result === false) {
            return false;
        }

        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        return $rows;
    }



    // function used for Creating, Updating and Deleting tasks
    function execute ($conn, $sql) {
        $conn->query($sql);
        return $result !== false;
    }

    function insert_task($conn, $title, $due_date, $priority_id, $category_id) {
        $sql = "INSERT INTO `Task` (`title`, `due_date`, `priority_id`, `category_id`)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("ssii", $title, $due_date, $priority_id, $category_id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    function get_task($conn, $task_id) {
        $sql = "SELECT * FROM `Task` WHERE `task_id` = ? AND `deleted_at` IS NULL";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return null;
        }

        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $task = $result->fetch_assoc();
        $stmt->close();

        return $task ?: null;
    }

    function update_task($conn, $task_id, $title, $due_date, $priority_id, $category_id) {
        $sql = "UPDATE `Task`
                SET `title` = ?, `due_date` = ?, `priority_id` = ?, `category_id` = ?
                WHERE `task_id` = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("ssiii", $title, $due_date, $priority_id, $category_id, $task_id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    // Soft delete: sets deleted_at instead of removing the row; restore_task() can undo it.
    function soft_delete_task($conn, $task_id) {
        $sql = "UPDATE `Task` SET `deleted_at` = NOW() WHERE `task_id` = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("i", $task_id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    function restore_task($conn, $task_id) {
        $sql = "UPDATE `Task` SET `deleted_at` = NULL WHERE `task_id` = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("i", $task_id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }

    function toggle_task_done($conn, $task_id) {
        $sql = "UPDATE `Task` SET `is_done` = NOT `is_done` WHERE `task_id` = ?";

        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param("i", $task_id);
        $ok = $stmt->execute();
        $stmt->close();

        return $ok;
    }


?>