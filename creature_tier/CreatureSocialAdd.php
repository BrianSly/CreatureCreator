<?php
include '../config.php';
try{
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
    $query = "
        INSERT INTO creature_tier_social (name)
        VALUES (:name);
    ";
    $stmt = $database->prepare($query);
    $stmt->execute(array(':name' => $_POST['Name']));

    if($stmt->errorInfo()[0] == "00000") {
        print "Social type " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding social type " . $_POST['Name'];
    }
}
