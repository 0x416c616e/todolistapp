<?php

    //example usage:
    //edit.php?item_id=39&task=blah&auth=password


    //get stuff posted from the todolist.php script
    $item_id=$_GET["item_id"];
    $task=$_GET["task"];
    //to-do: validate input
    
    //connect to database    
    include("database_config.php");
    $edit_conn = new mysqli($servername, $username, $password, $databasename);
    
    //create edit query
    $edit_query = "UPDATE todolist SET todo_item = '";
    $edit_query .=  $task . "' WHERE item_id = " . $item_id;

    //edit the to-do list item
    $edit_conn->query($edit_query);
    $edit_conn->close();

    //redirect to todolist.php with auth
    $redirect = "Location: todolist.php?auth=$pass";
    header($redirect);
?>