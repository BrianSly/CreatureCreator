<?php
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
    $query = "
        INSERT INTO creature_tier_hunting_style (name)
        VALUES (:name);
    ";
    $stmt = $database->prepare($query);
    $stmt->execute(array(':name' => $_POST['Name']));

    if($stmt->errorInfo()[0] == "00000") {
        print "Hunting Style " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding hunting style " . $_POST['Name'];
    }
}
