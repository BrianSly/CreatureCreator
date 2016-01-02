<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Creature Creator</title>
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<?php
try {
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>
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
                            print '<legend>' . $currentAttributeType . 's</legend>';
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
                    <input type="radio" name="Diet" value="Obligate Herbivour">Obligate Herbivour
                    <input type="radio" name="Diet" value="Facultative Herbivore">Facultative Herbivore
                    <input type="radio" name="Diet" value="Omniverous">Omniverous
                    <input type="radio" name="Diet" value="Facultative Carnivore">Facultative Carnivore
                    <input type="radio" name="Diet" value="Obligate Carnivore">Obligate Carnivore

                    <li>Hunting</li>
                    <input type="radio" name="Hunting" value="Solitary Hunter">Solitary Hunter
                    <input type="radio" name="Hunting" value="Ambush hunter">Ambush hunter
                    <input type="radio" name="Hunting" value="Cursorial hunter">Cursorial hunter
                    <input type="radio" name="Hunting" value="Opportunistic Hunter">Opportunistic Hunter
                    <input type="radio" name="Hunting" value="Pack Hunter">Pack Hunter

                    <li>Socialization</li>
                    <input type="radio" name="Social" value="Feral">Feral
                    <input type="radio" name="Social" value="Solitary Animal">Solitary Animal
                    <input type="radio" name="Social" value="Social Animal">Social Animal
                    <input type="radio" name="Social" value="Domesticated">Domesticated

                    <li>Disposition</li>
                    <input type="radio" name="Disposition" value="Fearful">Fearful
                    <input type="radio" name="Disposition" value="Skittish">Skittish
                    <input type="radio" name="Disposition" value="Untrusting">Untrusting
                    <input type="radio" name="Disposition" value="Indifferent">Indifferent
                    <input type="radio" name="Disposition" value="Bold">Bold
                    <input type="radio" name="Disposition" value="Unfriendly">Unfriendly
                    <input type="radio" name="Disposition" value="Hostile">Hostile
                    <input type="radio" name="Disposition" value="Aggressive">Aggressive

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

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="js/main.js"></script>
</body>
</html>

