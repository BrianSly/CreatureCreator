<?php
use BattleChores\domain\creature\CreatureHuntingStyleGateway;

include '../config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$errorCount = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the creature hunting style</p>";
    $errorCount++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The creature hunting style's name must be shorter than 50 characters</p>";
    $errorCount++;
}

if ($errorCount == 0) {
    $creatureHuntingStyleGateway = new CreatureHuntingStyleGateway($database);
    $insertSuccess = $creatureHuntingStyleGateway->insertNew($_POST['Name']);
    if($insertSuccess) {
        print "Hunting Style " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding hunting style " . $_POST['Name'];
    }
}
