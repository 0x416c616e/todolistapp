<?php
    //get query string parameters
    $today_range = $_GET["today_range"];
    $mode = $_GET["mode"];
    $auth = $_GET["auth"];

    //open database connection
    include("database_config.php");
    $today_conn = new mysqli($servername, $username, $password, $databasename);

    //build query
    $today_query = "UPDATE today SET today_range = '";
    $today_query .= $today_range . "' WHERE today_id = 123";

    //run query and close
    $today_conn->query($today_query);
    $today_conn->close();

    //redirect back to todo list
    $redirect = "Location: todolist.php?auth=$pass&mode=$mode";
    header($redirect);
?>