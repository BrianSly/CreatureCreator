<?php
include 'config.php';
if (!isset($_POST["Name"]) || strlen($_POST["Name"]) < 1) {
	print "<p>You need to set a name</p>";
	exit();
} elseif (strlen($_POST["Name"]) > 50) {
	print "<p>Please choose a name under 50 characters</p>";
	exit();
}

try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
$query = "
	INSERT INTO creature_tiers
	(name, creature_type_id, tier)
	VALUES (:name, :id, :tier)
";
$stmt = $database->prepare($query);		
$stmt->bindParam(':name', $_POST['Name']);
$stmt->bindParam(':id', $_POST['Order']);	
$stmt->bindParam(':tier', $_POST['Tier']);			
$stmt->execute();


if($stmt->errorInfo()[0] == "00000") {
	print "Creature " . $_POST['Name'] . " Successfully added to the Database";
} else {
	print "Error Adding Creature " . $_POST['Name'];
}
	
	