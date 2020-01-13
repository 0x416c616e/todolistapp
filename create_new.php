<?php
    //get stuff posted from the todolist.php script
    //when the user submits a new task to put in db
    $priority = htmlentities($_GET["priority"], ENT_QUOTES);
    $task = htmlentities($_GET["task"], ENT_QUOTES);
    $mode = $_GET["mode"];
    //to-do: validate input
    
    //put into database    
    include("database_config.php");
    $new_conn = new mysqli($servername, $username, $password, $databasename);
    $create_query = "INSERT INTO todolist (priority, todo_item) VALUES (";
    $create_query .=  $priority . ", '" . $task . "')";
    $new_conn->query($create_query);
    $new_conn->close();

    //redirect to todolist.php with auth
    $redirect = "Location: todolist.php?auth=$pass&mode=$mode";
    header($redirect);
?>