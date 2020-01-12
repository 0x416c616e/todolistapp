<?php
    //this deletes to-do list items
    include("database_config.php");
    // Create database connection
    
    $conn = new mysqli($servername, $username, $password, $databasename);
    $item_id = $_GET["id"];
    $conn->query("DELETE FROM todolist WHERE item_id = $item_id");
    $redirect = "Location: todolist.php?auth=$pass";
    header($redirect);
?>