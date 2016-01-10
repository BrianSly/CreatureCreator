<?php
use BattleChores\domain\creature\CreatureHuntingStyleGateway;

include '../config.php';
include '../php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Hunting Style Edit");
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <h1>Hunting Style Edit</h1>
    <?php
    include '../config.php';
    try{
        $database = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        print 'Connection failed: ' . $e->getMessage();
    }
    ?>
    <div>
        <h2>Add new creature hunting style</h2>
        <form method="post" action="CreatureHuntingStyleAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of creature hunting styles</h2>
        <ul>
            <?php
            $creatureHuntingStyleGateway = new CreatureHuntingStyleGateway($database);
            $attributes = $creatureHuntingStyleGateway->selectAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
