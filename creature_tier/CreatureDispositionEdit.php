<?php
use BattleChores\domain\creature\CreatureDispositionGateway;

include '../config.php';
include '../php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Creature Disposition Edit");

try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <h1>Disposition Edit</h1>
    <div>
        <h2>Add new creature disposition</h2>
        <form method="post" action="CreatureDispositionAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of creature dispositions</h2>
        <ul>
            <?php
            $creatureDispositionGateway = new CreatureDispositionGateway($database);
            $attributes = $creatureDispositionGateway->selectAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
