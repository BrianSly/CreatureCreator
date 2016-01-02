<?php
include 'config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$errorCount = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the attribute</p>";
    $errorCount++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The attribute's name must be shorter than 50 characters</p>";
    $errorCount++;
}


if ($errorCount == 0) {
    $query = "
        INSERT INTO creature_attribute (name, creature_attribute_type_id)
        VALUES (:name, :creature_attribute_type_id);
    ";
    $stmt = $database->prepare($query);
    $stmt->execute(array(':name' => $_POST['Name'], ':creature_attribute_type_id' => $_POST['Type']));

    if($stmt->errorInfo()[0] == "00000") {
        print "<p>Attribute " . $_POST['Name'] . " successfully added to the Database</p>";
    } else {
        print "<p>Error Adding attribute " . $_POST['Name'] . "</p>";
    }
}
