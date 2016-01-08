<?php
include 'config.php';
?>

<!DOCTYPE html
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creature Creator</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<?php
try{
	$database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
	print 'Unsuccesful Connection: ' . $e->getMessage();
	
}
?>

<fieldset>
	<H2>Creature Repository</H2>


<?php
include 'config.php';
?>

<!DOCTYPE html
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Creature Creator</title>
<link rel="stylesheet" href="css/normalize.min.css">
<link rel="stylesheet" href="css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
<script type="text/javascript" src="js/main.js"></script>
</head>
<body>
<?php
try{
$database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
print 'Unsuccesful Connection: ' . $e->getMessage();

}
?>

<fieldset>
<H2>Creature Repository</H2>
<div>
<h2>lines</h2>
<table>
<tr>
<td>Id</td>
<td>Name</td>
<td>Tier</td>
</tr>
<?php
$query = "
SELECT
id, name, tier, type, class, diet, disposition, hunting_style, social
FROM creature
order by class, name
";
unset($stmt);
$stmt = $database->query($query);
$lines = $stmt->fetchAll();
$lastClass = '';
foreach ($lines as $value) {
$class = $value['class'];
if($lastClass != $class) {
print '<tr><td colspan="3" style="border: solid">' . $class . '</td></tr>';
}
print "<tr>";
print "<td>" . $value['id'] . "</td>";
print "<td>" . utf8_encode($value['name']) . "</td>";
print "<td>" . $value['tier'] . "</td>";
print "</tr>";

$lastClass = $class;
}
?>
</table>
</div>
</fieldset>
</body>
</html>