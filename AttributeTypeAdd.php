<?php
include 'config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}

$error = 0;
if (!isset($_POST['Name']) || strlen($_POST['Name']) < 1) {
    print "<p>Please specify a name for the attribute type</p>";
    $error++;
}
if (strlen($_POST['Name']) > 50) {
    print "<p>The attribute type's name must be shorter than 50 characters</p>";
    $error++;
}


if ($error == 0) {
    $query = "
        INSERT INTO creature_attribute_type (name)
        VALUES (:name);
    ";
    $stmt = $database->prepare($query);
    $stmt->execute(array(':name' => $_POST['Name']));

    if($stmt->errorInfo()[0] == "00000") {
        print "Attribute type " . $_POST['Name'] . " successfully added to the Database";
    } else {
        print "Error Adding attribute type " . $_POST['Name'];
    }
}
