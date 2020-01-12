<!DOCTYPE html>
    <head>
        <title>To-do list</title>
    </head>
    <body>
    <header>To-do list</header>
    <main>
        <?php
            //very primitive login system
            $auth=$_GET["auth"];
            if ($auth=="password") {
                //database login info
                include("database_config.php");
                // Create database connection
                $conn = new mysqli($servername, $username, $password, $databasename);
                // Check database connection
                if ($conn->connect_error) {
                    //exit if error with connecting
                    die("MySQL connection error");
                } else {
                    echo "<br>Database connection successful<br>";
                }
                //link for making new to-do items
                echo "<a href=\"\">Create new</a>";
                //list of the to-do list items
                echo "<ul>";
                //getting to-do list items from the database
                if ($result = $conn->query("SELECT todo_item FROM todolist")) {
                    printf("Select returned %d rows.\n", $result->num_rows);
                    /* free result set */
                    $result->close();
                }
                //next should be in a while-database-has-next loop:
                    echo "<li>1 do something <a href=\"\">Edit</a> <a href=\"\">Delete</a></li>";


                
                //close the database
                $mysqli->close();
                echo "</ul>";
            } else {
                //what gets displayed if user is not properly authenticated
                echo "<h1>Authentication required</h1>";
            }
        ?>
    </main>
    </body>
    <footer>Made by Alan</footer>
</html>