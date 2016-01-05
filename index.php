<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Creature Creator</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    <h1>Creature Creator Links</h1>
    <ul>
    <?php
    $pageNames = [
        "Creature Creator" => "CreatureCreator.php",
		"Class" => "ClassEdit.php",
		"Attribute" => "AttributeEdit.php",
        "Attribute Type" => "AttributeTypeEdit.php",
        "Creature Diet" => "creature_tier/CreatureDietEdit.php",
        "Creature Disposition" => "creature_tier/CreatureDispositionEdit.php",
        "Creature Hunting Style" => "creature_tier/CreatureHuntingStyleEdit.php",
        "Creature Social" => "creature_tier/CreatureSocialEdit.php"
		
    ];
    foreach ($pageNames as $pageName => $pageURL) {
        print '<li><a href="' . $pageURL . '">' . $pageName . '</a></li>';
    }
    ?>
    </ul>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
