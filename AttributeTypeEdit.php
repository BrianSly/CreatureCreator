<?php
use BattleChores\domain\creature\CreatureAttributeTypeGateway;

include 'config.php';
include 'php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
print $printHtml->head("Attribute Type Edit");
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <h1>Attribute Type Edit</h1>
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
            $attributeTypeGateway = new CreatureAttributeTypeGateway($database);
            $attributes = $attributeTypeGateway->selectAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
