<?php
use BattleChores\domain\creature\CreatureSocialGateway;

include '../config.php';
include '../php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Creature Social Edit");
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <h1>Creature Social Type Edit</h1>
    <div>
        <h2>Add new creature social type </h2>
        <form method="post" action="CreatureSocialAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of Creature Social Types</h2>
        <ul>
            <?php
            $creatureSocialGateway = new CreatureSocialGateway($database);
            $attributes = $creatureSocialGateway->selectAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
