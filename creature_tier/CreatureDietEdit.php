<?php
use BattleChores\domain\creature\CreatureDietGateway;

include '../config.php';
include '../php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Creature Diet Edit");
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <h1>Diet Edit</h1>
    <div>
        <h2>Add new creature diet</h2>
        <form method="post" action="CreatureDietAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of creature diets</h2>
        <ul>
            <?php
            $creatureDietGateway = new CreatureDietGateway($database);
            $attributes = $creatureDietGateway->selectAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
