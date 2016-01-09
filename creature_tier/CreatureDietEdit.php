<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Attribute Type Edit</title>
    <link rel="stylesheet" href="../css/normalize.min.css">
    <link rel="stylesheet" href="../css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
</head>
<body>
<main>
    <h1>Diet Edit</h1>
    <?php
    include '../config.php';
    try{
        $database = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        print 'Connection failed: ' . $e->getMessage();
    }
    ?>
    <div>
        <h2>Add new creature diet</h2>
        <form method="post" action="CreatureDietAdd.php">
            <input type="text" name="Name">
            <input type="submit" value="Create">
            <input type="reset" value="Restart">
        </form>
    </div>
    <div>
        <h2>List of creature diets</h2>
        <ul>
            <?php
            $query = "
            SELECT name FROM creature_tier_diet
        ";
            $stmt = $database->query($query);
            $attributes = $stmt->fetchAll();
            foreach ($attributes as $attribute) {
                print "<li>" . $attribute['name'] . "</li>";
            }
            ?>
        </ul>
    </div>
</main>
</body>
</html>
