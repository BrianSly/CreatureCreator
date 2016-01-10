<?php
use BattleChores\domain\attribute\AttributeTypeGateway;

include 'config.php';
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$errorCount = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the attribute type</p>";
    $errorCount++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The attribute type's name must be shorter than 50 characters</p>";
    $errorCount++;
}

if ($errorCount == 0) {
    $attributeTypeGateway = new AttributeTypeGateway($database);
    $insertSuccess = $attributeTypeGateway->insertNew($_POST['Name']);
    if ($insertSuccess) {
        print "Attribute type " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding attribute type " . $_POST['Name'];
    }
}
