<!DOCTYPE html>
    <head>
        <title>To-do list</title>
    </head>
    <body>
    <header>To-do list</header>
    <main>
        <?php
            $auth=$_GET["auth"];
            if ($auth=="password") {
                echo "<a href=\"\">Create new</a>";
                echo "<ul>";
                //next should be in a while-database-has-next loop:
                    echo "<li>1 do something <a href=\"\">Edit</a> <a href=\"\">Delete</a></li>";
                echo "</ul>";
            } else {
                echo "<h1>Authentication required</h1>";
            }
        ?>
    </main>
    </body>
    <footer>Footer goes here</footer>
</html>