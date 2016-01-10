<?php
include 'config.php';
include 'php_classes/setup.php';

$printHtml = new \BattleChores\PrintHtml();
echo $printHtml->head("Creature Creator");

try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
<body>
<main>
    <form method="post" action="CreateNewCreature.php">
        <fieldset>
            <legend>Creature Creator</legend>
            <fieldset>
                <label for="Name">Name</label>
                <input type="text" name="Name">
            </fieldset>

            <fieldset>
                <label for="Tier">Tier</label>
                <select name="Tier">
                    <?php
                    $tiers = [
                        0 => "0",
                        1 => "I",
                        2 => "II",
                        3 => "III",
                        4 => "IV",
                        5 => "V",
                        6 => "VI",
                        7 => "VII",
                        8 => "VIII",
                        9 => "IX",
                        10 => "X",
                        100 => "Legendary"];
                    foreach ($tiers as $tierValue => $name) {
                        print '<option value="' . $tierValue . '">' . $name . '</option>';
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset>
                <legend>Stat Attributes</legend>
                <?php
                $query = "
                        SELECT
                            A.name
                            ,A.short_name
                            ,B.id
                            ,B.rank
                            ,B.rank_name
                        FROM creature_stats AS A
                        LEFT JOIN creature_stat_levels AS B
                          ON A.id = B.stat_id
                        ORDER BY name ASC, rank ASC
                    ";
                $stmt = $database->query($query);
                $results = $stmt->fetchAll();
                $currentStatCategory = '';
                print "<ul>";
                foreach ($results as $stat) {
                    if ($currentStatCategory != $stat['name']) {
                        if ($currentStatCategory != '') {
                            print '</select></li>';
                        }
                        print '<li><label for="' . $stat['name'] . '">' . $stat['name'] . '</label>';
                        print '<select name="' . $stat['name'] . '">';
                        $currentStatCategory = $stat['name'];
                    }
                    print '<option value = "' . $stat['id'] . '">' . $stat['rank_name'] . ' - ' . $stat['rank'] . '</option>';
                }
                print '</select></ul>';
                ?>
            </fieldset>
            <!--        <h1>SKILL ATTRIBUTES</h1>-->
            <!--            <li>Creature Class</li>-->
            <!--            <input type="radio" name="Class" value="Bird">Bird-->
            <!--            <input type="radio" name="Class" value="Mammal">Mammal-->
            <!--            <input type="radio" name="Class" value="Amphibian">Amphibian-->
            <!--            <input type="radio" name="Class" value="Reptile">Reptile-->
            <!--            <input type="radio" name="Class" value="Fish">Fish-->
            <!--            <input type="radio" name="Class" value="Insect">Insect-->
            <!--            <input type="radio" name="Class" value="Other">Other-->

            <fieldset>
                <legend>Type</legend>
                <?php
                $query = "
                        SELECT
                          name, id
                        FROM creature_type
                        ORDER BY name ASC
                    ";
                unset($stmt);
                $stmt = $database->query($query);
                $results = $stmt->fetchAll();
                print "<ul>";
                foreach ($results as $attribute) {
                    print '<li><input type="radio" name="Order" value="' . $attribute['id'] . '">' . $attribute['name'] . '</input></li>';
                }
                print '</ul>';
                ?>
            </fieldset>
            <fieldset>
                <legend>Attributes</legend>
                    <?php
                    $query = "
                        SELECT
                            creature_attribute.id,
                            creature_attribute.name,
                            creature_attribute_type.name as type_name
                        FROM creature_attribute
                        LEFT JOIN creature_attribute_type
                          ON creature_attribute.creature_attribute_type_id = creature_attribute_type.id
                    ";
                    unset($stmt);
                    $stmt = $database->query($query);
                    $results = $stmt->fetchAll();
                    $currentAttributeType = '';
                    foreach ($results as $attribute) {
                        $isNewAttributeType = $currentAttributeType != $attribute['type_name'];
                        $isFirstAttributeType = $currentAttributeType == '';
                        $currentAttributeType = $attribute['type_name'];
                        if ($isNewAttributeType && !$isFirstAttributeType) {
                            print "</ul></fieldset>";
                        }
                        if ($isNewAttributeType) {
                            print "<fieldset><ul>";
                            print '<legend>' . $currentAttributeType . '</legend>';
                        }
                        print '<li><label for="attribute-' . $attribute['id'] . '">' . $attribute['name'] . '<input type="number" inputmode="numeric" name="attribute-' . $attribute['id'] . '"></li>';
                    }
                    print '</ul></fieldset>';
                    ?>

                    <fieldset>
                        <legend>Mobility</legend>
                        <input type="radio" name="Mobility" value="Limbless">Limbless
                        <input type="radio" name="Mobility" value="Legless">Legless
                        <input type="radio" name="Mobility" value="Armless">Armless
                        <input type="radio" name="Mobility" value="Biped">Biped
                        <input type="radio" name="Mobility" value="Faculative Biped">Faculative Biped
                        <input type="radio" name="Mobility" value="Quadraped">Quadraped
                        <input type="radio" name="Mobility" value="Hexaped">Hexaped
                        <input type="radio" name="Mobility" value="Octaped">Octaped
                    </fieldset>

                    <li>Diet</li>
                    <?php
                        $query = "
                            SELECT id, name FROM creature_tier_diet
                        ";
                        unset($stmt);
                        $stmt = $database->query($query);
                        $diets = $stmt->fetchAll();
                        foreach($diets as $dietType) {
                            print '<input type="radio" name="Diet" value="' . $dietType['id'] . '">' . $dietType['name'] . '</input>';
                        }
                    ?>
                    <li>Hunting</li>
                    <?php
                    $query = "
                        SELECT id, name FROM creature_tier_hunting_style
                    ";
                    unset($stmt);
                    $stmt = $database->query($query);
                    $huntingStyles = $stmt->fetchAll();
                    foreach($huntingStyles as $huntingStyle) {
                        print '<input type="radio" name="Hunting" value="' . $huntingStyle['id'] . '">' . $huntingStyle['name'] . '</input>';
                    }
                    ?>

                    <li>Socialization</li>
                    <?php
                    $query = "
                        SELECT id, name FROM creature_tier_social
                    ";
                    unset($stmt);
                    $stmt = $database->query($query);
                    $socialTypes = $stmt->fetchAll();
                    foreach($socialTypes as $socialType) {
                        print '<input type="radio" name="Social" value="' . $socialType['id'] . '">' . $socialType['name'] . '</input>';
                    }
                    ?>

                    <li>Disposition</li>
                    <?php
                    $query = "
                            SELECT id, name FROM creature_tier_disposition
                        ";
                    unset($stmt);
                    $stmt = $database->query($query);
                    $dispositions = $stmt->fetchAll();
                    foreach($dispositions as $disposition) {
                        print '<input type="radio" name="Disposition" value="' . $disposition['id'] . '">' . $disposition['name'] . '</input>';
                    }
                    ?>
                </fieldset>
            </fieldset>
            <fieldest>
                <textarea ></textarea>
            </fieldest>

            <fieldset>
                <input type="submit" value="Create">
                <input type="reset" value="Restart">
            </fieldset>
        </fieldset>
    </form>
</main>
</body>
</html>
