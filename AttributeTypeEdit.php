<!DOCTYPE html>
<html>
<head>
    <title>Attribute Type Edit</title>
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
</body>
</html>
