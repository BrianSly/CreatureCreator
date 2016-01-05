<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Class Edit</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<main>
    <h1>Class Edit</h1>
<?php
include 'config.php';
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
    <div>
        <h2>Add a new creature Class</h2>
 
            </select><br />
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>Classes</h2>
        <table cellspacing="10">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
			
			<h2>List of Creature Classes</h2>
      <?php 
        $query = "
            SELECT
              creature_class.id,
              creature_class.name
            FROM creature_class
              
        "; 
		     
		 
        unset($stmt);
        $stmt = $database->query($query);
        $classes = $stmt->fetchAll();

        foreach ($classes as $class) {
            print "<tr>";
            print "<td>" . $class['id'] . "</td>";
            print "<td>" . $class['name'] . "</td>";
            print "</tr>";
        }
        ?>
        </table>
    </div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/main.js"></script>
</main>
</body>
</html>
