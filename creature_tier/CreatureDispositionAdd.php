<?php
use BattleChores\domain\creature\CreatureDietGateway;

include '../config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$errorCount = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the creature disposition</p>";
    $errorCount++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The creature disposition's name must be shorter than 50 characters</p>";
    $errorCount++;
}

if ($errorCount == 0) {
    $creatureDietGateway = new CreatureDietGateway($database);
    $insertSuccess = $creatureDietGateway->insertNew($_POST['Name']);
    if($insertSuccess) {
        print "Disposition " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding disposition " . $_POST['Name'];
    }
}
