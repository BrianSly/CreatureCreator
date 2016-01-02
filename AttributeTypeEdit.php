<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Attribute Type Edit</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <h1>Attribute Type Edit</h1>
<?php
include 'config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
    <div>
        <h2>Add new attribute type</h2>
        <form method="post" action="AttributeTypeAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of Attribute Types</h2>
        <ul>
        <?php
        $query = "
            SELECT name FROM creature_attribute_type
        ";
        $stmt = $database->query($query);
        $attributes = $stmt->fetchAll();
        foreach ($attributes as $attribute) {
            print "<li>" . $attribute['name'] . "</li>";
        }
        ?>
        </ul>
    </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/main.js"></script>
</body>
</html>
