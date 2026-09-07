<?php

$servername = "localhost";
$username = "root"; //default username
$password = ""; //default password
$dbname = "todo_db"; //name of the database we are using

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully <br/>";
?>