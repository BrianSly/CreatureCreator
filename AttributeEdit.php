<?php
use BattleChores\domain\creature\CreatureAttributeGateway;
use BattleChores\domain\creature\CreatureAttributeTypeGateway;

include 'config.php';
include 'php_classes/setup.php';
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Attribute Type Edit");
?>
<body>
<main>
    <h1>Attribute Edit</h1>
    <div>
        <h2>Add new attribute</h2>
        <form method="post" action="AttributeAdd.php">
            <select name="Type">
                <?php
                $creatureAttributeTypeGateway = new CreatureAttributeTypeGateway($database);
                $results = $creatureAttributeTypeGateway->selectAll();
                foreach ($results as $type) {
                    print '<option value="' . $type['id'] . '">' . $type['name'] . '</option>';
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
            $attributegateway = new CreatureAttributeGateway($database);
            $attributes = $attributegateway->selectAll();
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
</main>
</body>
</html>
