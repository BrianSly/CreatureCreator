<!DOCTYPE html>
<html>
<head>
    <title>Attribute Edit</title>
</head>
<body>
    <h1>Attribute Edit</h1>
<?php
include 'config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
    <div>
        <h2>Add new attribute</h2>
        <form method="post" action="AttributeAdd.php">
            <select name="Type">

            <?php
            $query = "
                SELECT id, name
                FROM creature_attribute_type
            ";
            unset($stmt);
            $stmt = $database->query($query);
            $results = $stmt->fetchAll();
            foreach($results as $type) {
                print '<option value= "' . $type['id'] . '">' . $type['name'] . '</option>';
            }
            ?>
            </select><br />
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>Attributes</h2>
        <table>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>attribute type</td>
            </tr>
        <?php
        $query = "
            SELECT
              creature_attribute.id,
              creature_attribute.name,
              creature_attribute_type.name as type_name
            FROM creature_attribute
            LEFT JOIN creature_attribute_type
              ON creature_attribute.creature_attribute_type_id = creature_attribute_type.id
        ";
        unset($stmt);
        $stmt = $database->query($query);
        $attributes = $stmt->fetchAll();

        foreach ($attributes as $attribute) {
            print "<tr>";
            print "<td>" . $attribute['id'] . "</td>";
            print "<td>" . $attribute['name'] . "</td>";
            print "<td>" . $attribute['type_name'] . "</td>";
            print "</tr>";
        }
        ?>
        </table>
    </div>
</body>
</html>