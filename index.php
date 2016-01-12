<?php
include 'config.php';
include 'php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Creature Creator");
?>
<body>
<main>
    <h1>Creature Creator Links</h1>
    <ul>
        <?php
        $pageNames = [
            "Creature Creator" => "CreatureCreator.php",
            "Creature Repository" => "CreatureRepository.php",
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
</main>
</body>
</html>
