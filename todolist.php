
<?php
    //disable this in production
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    //these two lines are only good for debugging/developing
?>

<!DOCTYPE html>
    <head>
        <title>To-do list</title>
        <script src="edit.js"></script>
        <script src="toggle.js"></script>
        <?php
            $mode = @($_GET["mode"] == "dark");
            if ($mode == "dark") {
                echo <<< EOL
                    <link rel="stylesheet" type="text/css" href="darkmode.css">
                EOL;
            } else {
                echo <<< EOL
                    <link rel="stylesheet" type="text/css" href="lightmode.css">  
                EOL;
            }
        ?>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>To-do list</li>
                </ul>
            </nav>
        </header>
        <main>
            <?php
                //very primitive login system
                $auth=@($_GET["auth"]);
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
                        echo "<!-- Database connection successful -->";
                    }
                    //form for making new to-do items
                    echo <<< EOL
                    <section>
                        <form action="todolist.php" style="display:inline-block;">
                            <input type="hidden" name="auth" value="$auth">
                            <input type="hidden" name="mode" value="dark">
                            <button>Dark Mode</button>
                        </form>
                        <form action="todolist.php" style="display:inline-block;">
                            <input type="hidden" name="auth" value="$auth">
                            <input type="hidden" name="mode" value="light">
                            <button>Light Mode</button>
                        </form><br><br>

                    <div style="display: block;">
                        <button onclick="toggleNewTask()" style="top: 0;"> Create New Task </button>
                        <form method="GET" action="create_new.php" id="new_task_form" style="display:none;">
                            <h2>Create new task</h2><br>
                            Priority:<br>
                            <input type="text" size="6" name="priority" id="priority"><br>
                            Task to create:<br>
                            <textarea name="task" rows="4" cols="30" id="task"></textarea><br>
                    EOL;
                    echo "<input type=\"hidden\" name=\"auth\" value=\"$auth\">";
                    echo <<< EOL
                        <input type="submit" value="Add task">
                        <button onclick="clearNew()" type="button">Clear</button> 
                        </form><br><br>
                    </div>
                    EOL;
                    //form for editing an existing item
                    echo <<< EOL
                    <div style="display: block;">
                        <button onclick="toggleEditTask()"> Edit existing Task </button><br>
                        <form method="GET" action="edit.php" id="edit_task_form" style="display:none;">
                            <h2>Edit existing task</h2><br>
                            Priority:<br>
                            <input type="text" size="6" name="priority_edit" id="priority_edit"><br>
                            <input type="text" size="6" name="item_id" id="item_id" style="display:none;">
                            Task to edit:<br>
                            <textarea name="task" rows="4" cols="30" id="todo_item"></textarea><br>
                    EOL;
                    echo "<input type=\"hidden\" name=\"auth\" value=\"$auth\">";
                    echo <<< EOL
                        <input type="submit" value="Edit task">
                        <button onclick="clearEdit()" type="button">Clear</button>
                        </form>
                    </div>
                    </section>
                    EOL;
                    //list of the to-do list items
                    echo "<h2>To-do list</h2>";
                    echo "<div>";
                    echo "<ul>";
                    //getting to-do list items from the database
                    if ($result = $conn->query("SELECT priority, todo_item, item_id FROM todolist ORDER BY priority")) {
                        while ($row = $result->fetch_assoc()) {
                            //I was having problem with the single and double quotes that were passed to a js function
                            $quote_problem = $row["todo_item"];
                            if (strpos($quote_problem, '&#039;') !== false) {
                                $quote_problem = str_replace ('&#039;', '\\&#039;', $quote_problem);
                            }
                            printf ("<li>%s %s [<a onclick=\"putIdInForm(%s, %s, '%s')\" href=\"#\">Edit</a>] [<a href=\"delete.php?id=%s&auth=%s\">Delete</a>]</li>\n",
                            $row["priority"], $row["todo_item"],
                            $row["priority"], $row["item_id"], $quote_problem,
                            $row["item_id"], $auth);
                        }
                        printf("There are %d items on your to-do list\n", $result->num_rows);
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
    <footer>
        Made by Alan | <a href="https://saintlouissoftware.com">Saint Louis Software</a> | <a href="https://github.com/0x416c616e">GitHub</a>
    </footer>
</html>