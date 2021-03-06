
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
        <script src="confirm_deletion.js"></script>
        <?php
            $mode = @($_GET["mode"]);
            if ($mode == "dark") {
                echo <<< EOL
                    <link rel="stylesheet" type="text/css" href="darkmode.css">
                EOL;
            } else {
                $mode = "light";
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
                    //including light mode and dark mode buttons
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
                            <input type="hidden" name="mode" value="$mode">
                            Task to create:<br>
                            <textarea name="task" rows="4" cols="30" id="task"></textarea><br>
                    EOL;
                    echo "<input type=\"hidden\" name=\"auth\" value=\"$auth\">";
                    echo <<< EOL
                        <input type="submit" value="Add task">
                        <button onclick="clearNew()" type="button">Clear</button> 
                        <button onclick="closeNewForm()" type="button">Close</button>
                        </form><br><br>
                    </div>
                    EOL;
                    //form for editing an existing item
                    echo <<< EOL
                    <div style="display: block;">
                        <button onclick="toggleEditTask()" style="display:none;"> Edit existing Task </button><br>
                        <form method="GET" action="edit.php" id="edit_task_form" style="display:none;">
                            <h2>Edit existing task</h2><br>
                            Priority:<br>
                            <input type="text" size="6" name="priority_edit" id="priority_edit"><br>
                            <input type="hidden" name="mode" value="$mode">
                            <input type="text" size="6" name="item_id" id="item_id" style="display:none;">
                            Task to edit:<br>
                            <textarea name="task" rows="4" cols="30" id="todo_item"></textarea><br>
                    EOL;
                    echo "<input type=\"hidden\" name=\"auth\" value=\"$auth\">";
                    echo <<< EOL
                        <input type="submit" value="Edit task">
                        <button onclick="clearEdit()" type="button">Clear</button>
                        <button onclick="closeEditForm()" type="button">Close</button>
                        </form>
                    </div>
                    </section>
                    EOL;
                    //today's priorities section and db stuff
                    $today = $conn->query("SELECT today_range FROM today WHERE today_id = 123 LIMIT 1");
                    $today_row = $today->fetch_assoc();
                    $today_var = $today_row["today_range"];
                    echo <<< EOL
                        <h2>Today's priorities:</h2>
                        <p>Do up to and including the following number:</p>
                        <form method="GET" action="today.php">
                            <input type="text" name="today_range" value="$today_var">
                            <input type="hidden" name="mode" value="$mode">
                            <input type="hidden" name="auth" value=$auth>
                            <input type="submit" value="Update">
                        </form>
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
                            //highlight if part of today's priorities
                            $highlight_style = "";
                            if ($row["priority"] <= intval($today_var)) {
                                $highlight_style = "class='highlight_priority'";
                            }
                            
                            printf ("<li><p style=\"display: inline;\" $highlight_style>%s %s </p>[<a onclick=\"putIdInForm(%s, %s, '%s'); makeSureEditVisible();\" href=\"#\">Edit</a>] [<a onclick=\"confirmDeletion(%s, '%s', '$mode', '$quote_problem')\" href=\"#\">Delete</a>]</li>\n",
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
        <footer>
            Made by Alan | <a href="https://saintlouissoftware.com">Saint Louis Software</a> | <a href="https://github.com/0x416c616e">GitHub</a>
        </footer>
    </body>
</html>