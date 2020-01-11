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
                echo "hello";
            } else {
                echo "<h1>Authentication required</h1>";
            }
        ?>
    </main>
    </body>
    <footer>Footer goes here</footer>
</html>