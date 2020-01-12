<?php
    //get stuff posted from the todolist.php script
    //when the user submits a new task to put in db
    $priority=$_GET["priority"];
    $task=$_GET["task"];
    //to-do: validate input
    
    //put into database    
    include("database_config.php");
    $new_conn = new mysqli($servername, $username, $password, $databasename);
    $create_query = "INSERT INTO todolist (priority, todo_item) VALUES (";
    $create_query .=  $priority . ", '" . $task . "')";
    $new_conn->query($create_query);
    $new_conn->close();

    //redirect to todolist.php with auth
    $redirect = "Location: todolist.php?auth=$pass";
    header($redirect);
?>