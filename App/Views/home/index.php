<!DOCTYPE html>
<html>
    <head>
        <title>Home controller</title>
    </head>
    <body>


        <h1>This is the index file</h1>

        <p>Hello <?php echo htmlspecialchars($name) ?></p>

        <ul>
            <?php foreach ($colours as $colour) { ?>
            <li><?php echo htmlspecialchars($colour) ?></li>
            <?php } ?>
        </ul>
    </body>
</html>
