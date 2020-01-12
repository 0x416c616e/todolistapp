
<?php
    //disable this in production
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //these two lines are only good for debugging/developing
?>

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
                echo <<< EOL
                <form method="POST" action="create_new.php">
                    Priority:<br>
                    <input type="text" size="2" name="priority"><br>
                    Task:<br>
                    <textarea name="task" rows="4" cols="30"></textarea><br>
                EOL;
                echo "<input type=\"hidden\" name=\"auth\" value=\"$auth\">";
                echo <<< EOL
                <input type="submit" value="Add task">
                </form>
                EOL;
                //list of the to-do list items
                echo "<div>";
                echo "<ul>";
                //getting to-do list items from the database
                if ($result = $conn->query("SELECT priority, todo_item, item_id FROM todolist ORDER BY priority")) {
                    printf("%d items on your to-do list\n", $result->num_rows);
                    while ($row = $result->fetch_assoc()) {
                        printf ("<li>%s %s [<a href=\"\">Edit</a>] [<a href=\"delete.php?id=%s&auth=%s\">Delete</a>]</li>\n", $row["priority"], $row["todo_item"], $row["item_id"], $auth);
                    }
                    $result->close();
                }
                //close the database
                $conn->close();
                echo "</ul>";
                echo "</div>";
            } else {
                //what gets displayed if user is not properly authenticated
                echo "<h1>Authentication required</h1>";
            }
        ?>
    </main>
    </body>
    <footer>Made by Alan</footer>
</html>