
include 'DBConnector.php';

<?php 

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
    }


?>