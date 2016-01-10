<?php
use BattleChores\domain\creature\CreatureSocialGateway;

include '../config.php';
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$errorCount = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the creature social type</p>";
    $errorCount++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The creature social type's name must be shorter than 50 characters</p>";
    $errorCount++;
}

if ($errorCount == 0) {
    $creatureSocialGateway = new CreatureSocialGateway($database);
    $insertSuccess = $creatureSocialGateway->insertNew($_POST['Name']);
    if ($insertSuccess) {
        print "Social type " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding social type " . $_POST['Name'];
    }
}
