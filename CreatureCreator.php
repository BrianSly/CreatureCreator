<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Creature Creator</title>
</head>
<body>
<?php
try{
    $database = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    print 'Connection failed: ' . $e->getMessage();
}
?>

<form method="post" action="CreateNewCreature.php">
    <fieldset>
        <legend>Creature Creator</legend>
        <h1>TIER</h1>
        <select name="Tier">
            <?php
            $tiers = ["0", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X"];
            foreach ($tiers as $tier) {
                print '<option value="' . $tier . '">' . $tier . '</option>';
            }
            ?>
        </select>
        <h1>STAT ATTRIBUTES</h1>
        <?php
            $query = "
                SELECT
                    A.name
                    ,A.short_name
                    ,B.rank
                    ,B.rank_name
                FROM creature_stats AS A
                LEFT JOIN creature_stat_levels AS B
                  ON A.id = B.stat_id
                ORDER BY name ASC, rank ASC
            ";
            $statement = $database->query($query);
        $results = $statement->fetchAll();
        $currentStatCategory = '';
        foreach ($results as $stat) {
            if ($currentStatCategory != $stat['name']) {
                if ($currentStatCategory != '') {
                    print '</select><br />';
                }
                print $stat['name'] . '<br /><select name="' . $stat['name'] . '">';
                $currentStatCategory = $stat['name'];
            }
            print '<option value = "' . $stat['rank'] . '">' . $stat['rank_name'] . '</option>';
        }
        print '</select><br />';
        ?>
        <br />

        <h1>SKILL ATTRIBUTES</h1>
        <ul>


            <li>Creature Class</li>
            <input type="radio" name="Class" value="Bird">Bird
            <input type="radio" name="Class" value="Mammal">Mammal
            <input type="radio" name="Class" value="Amphibian">Amphibian
            <input type="radio" name="Class" value="Reptile">Reptile
            <input type="radio" name="Class" value="Fish">Fish
            <input type="radio" name="Class" value="Insect">Insect
            <input type="radio" name="Class" value="Other">Other
            <br />
            <li>Creature Body</li>
            <input type="radio" name="Order" value="Felidae">Felidae
            <input type="radio" name="Order" value="Canidae">Canidae
            <input type="radio" name="Order" value="Vulpe">Vulpe
            <input type="radio" name="Order" value="Cervidae">Cervidae
            <input type="radio" name="Order" value="Mustelidae">Mustelidae
            <input type="radio" name="Order" value="Equine">Equine
            <input type="radio" name="Order" value="Serpentes">Serpentes
            <input type="radio" name="Order" value="Ursidae">Ursidae
            <input type="radio" name="Order" value="Lizards">Lizards
            <br />
            <input type="radio" name="Order" value="Marsupial">Marsupial
            <input type="radio" name="Order" value="Primates">Primates
            <input type="radio" name="Order" value="Rodents">Rodents
            <input type="radio" name="Order" value="Avian">Avian
            <input type="radio" name="Order" value="Flightless Avian">Flightless Avian
            <input type="radio" name="Order" value="Amphibians">Amphibians
            <input type="radio" name="Order" value="Ungulate">Ungulate
            <input type="radio" name="Order" value="Other">Other
            <br />
            <li>Appendages</li>
            <input type="radio" name="Appendages" value="Horn">Horn
            <input type="radio" name="Appendages" value="Horns">Horns
            <input type="radio" name="Appendages" value="Whiskers">Whiskers
            <input type="radio" name="Appendages" value="Antenna">Antenna
            <input type="radio" name="Appendages" value="Stalk">Stalk
            <input type="radio" name="Appendages" value="Shell">Shell
            <input type="radio" name="Appendages" value="Quills">Quills
            <br />
            <br />
            <br />
            <li>Mobility</li>
            <input type="radio" name="Mobility" value="Limbless">Limbless
            <input type="radio" name="Mobility" value="Legless">Legless
            <input type="radio" name="Mobility" value="Armless">Armless
            <input type="radio" name="Mobility" value="Biped">Biped
            <input type="radio" name="Mobility" value="Faculative  Biped">Faculative  Biped
            <input type="radio" name="Mobility" value="Quadraped">Quadraped
            <input type="radio" name="Mobility" value="Hexaped">Hexaped
            <input type="radio" name="Mobility" value="Octaped">Octaped
            <br />
            <br />
            <li>Limbs</li>
            <input type="radio" name="Limbs" value="Arms">Arms
            <input type="radio" name="Limbs" value="Legs">Legs
            <input type="radio" name="Limbs" value="Wings">Wings
            <input type="radio" name="Limbs" value="Tail">Tail
            <input type="radio" name="Limbs" value="Dorsal">Dorsal
            <input type="radio" name="Limbs" value="Flippers">Flippers
            <input type="radio" name="Limbs" value="Tentacles">Tentacles
            <br />
            <li>Additional Limbs</li>
            <input type="radio" name="Limbs2" value="Arms">Arms
            <input type="radio" name="Limbs2" value="Legs">Legs
            <input type="radio" name="Limbs2" value="Wings">Wings
            <input type="radio" name="Limbs2" value="Tail">Tail
            <input type="radio" name="Limbs2" value="Dorsal">Dorsal
            <input type="radio" name="Limbs2" value="Flippers">Flippers
            <input type="radio" name="Limbs2" value="Tentacles">Tentacles

            <br />
            <li>Additional Limbs</li>
            <input type="radio" name="Limbs3" value="Arms">Arms
            <input type="radio" name="Limbs3" value="Legs">Legs
            <input type="radio" name="Limbs3" value="Wings">Wings
            <input type="radio" name="Limbs3" value="Tail">Tail
            <input type="radio" name="Limbs3" value="Dorsal">Dorsal
            <input type="radio" name="Limbs3" value="Flippers">Flippers
            <input type="radio" name="Limbs3" value="Tentacles">Tentacles

            <br />
            <li>Additional Limbs</li>
            <input type="radio" name="Limbs4" value="Arms">Arms
            <input type="radio" name="Limbs4" value="Legs">Legs
            <input type="radio" name="Limbs4" value="Wings">Wings
            <input type="radio" name="Limbs4" value="Tail">Tail
            <input type="radio" name="Limbs4" value="Dorsal">Dorsal
            <input type="radio" name="Limbs4" value="Flippers">Flippers
            <input type="radio" name="Limbs4" value="Tentacles">Tentacles

            <br />
            <br />
            <li>Forelimbs</li>
            <input type="radio" name="Forelimbs" value="Hands">Hands
            <input type="radio" name="Forelimbs" value="Pincers">Pincers
            <input type="radio" name="Forelimbs" value="Hooves">Hooves
            <input type="radio" name="Forelimbs" value="Stinger">Stinger
            <input type="radio" name="Forelimbs" value="Paws">Paws
            <input type="radio" name="Forelimbs" value="Fins">Fins
            <input type="radio" name="Forelimbs" value="None">None
            <br />
            <li>Additional Forelimbs</li>
            <input type="radio" name="Forelimbs2" value="Hands">Hands
            <input type="radio" name="Forelimbs2" value="Pincers">Pincers
            <input type="radio" name="Forelimbs2" value="Hooves">Hooves
            <input type="radio" name="Forelimbs2" value="Stinger">Stinger
            <input type="radio" name="Forelimbs2" value="Paws">Paws
            <input type="radio" name="Forelimbs2" value="Fins">Fins
            <input type="radio" name="Forelimbs2" value="None">None
            <br />
            <li>Additional Forelimbs</li>
            <input type="radio" name="Forelimbs3" value="Hands">Hands
            <input type="radio" name="Forelimbs3" value="Pincers">Pincers
            <input type="radio" name="Forelimbs3" value="Hooves">Hooves
            <input type="radio" name="Forelimbs3" value="Stinger">Stinger
            <input type="radio" name="Forelimbs3" value="Paws">Paws
            <input type="radio" name="Forelimbs3" value="Fins">Fins
            <input type="radio" name="Forelimbs3" value="None">None
            <br />
            <li>Additional Forelimbs</li>
            <input type="radio" name="Forelimbs4" value="Hands">Hands
            <input type="radio" name="Forelimbs4" value="Pincers">Pincers
            <input type="radio" name="Forelimbs4" value="Hooves">Hooves
            <input type="radio" name="Forelimbs4" value="Stinger">Stinger
            <input type="radio" name="Forelimbs4" value="Paws">Paws
            <input type="radio" name="Forelimbs4" value="Fins">Fins
            <input type="radio" name="Forelimbs4" value="None">None
            <br />
            <br />
            <li>Digits</li>
            <input type="radio" name="Digits" value="Thumbs">Thumbs
            <input type="radio" name="Digits" value="Talons">Talons
            <input type="radio" name="Digits" value="Claws">Claws
            <input type="radio" name="Digits" value="Retractable Claws">Retractable Claws
            <input type="radio" name="Digits" value="Suction Cups">Suction Cups
            <br />
            <li>Additional Digits</li>
            <input type="radio" name="Digits2" value="Thumbs">Thumbs
            <input type="radio" name="Digits2" value="Talons">Talons
            <input type="radio" name="Digits2" value="Claws">Claws
            <input type="radio" name="Digits2" value="Retractable Claws">Retractable Claws
            <input type="radio" name="Digits2" value="Suction Cups">Suction Cups
            <br />
            <li>Additional Digits</li>
            <input type="radio" name="Digits3" value="Thumbs">Thumbs
            <input type="radio" name="Digits3" value="Talons">Talons
            <input type="radio" name="Digits3" value="Claws">Claws
            <input type="radio" name="Digits3" value="Retractable Claws">Retractable Claws
            <input type="radio" name="Digits3" value="Suction Cups">Suction Cups
            <br />
            <li>Additional Digits</li>
            <input type="radio" name="Digits4" value="Thumbs">Thumbs
            <input type="radio" name="Digits4" value="Talons">Talons
            <input type="radio" name="Digits4" value="Claws">Claws
            <input type="radio" name="Digits4" value="Retractable Claws">Retractable Claws
            <input type="radio" name="Digits4" value="Suction Cups">Suction Cups
            <br />
            <br />
            <br />
            <li>Diet</li>
            <input type="radio" name="Diet" value="Obligate Herbivour">Obligate Herbivour
            <input type="radio" name="Diet" value="Facultative Herbivore">Facultative Herbivore
            <input type="radio" name="Diet" value="Omniverous">Omniverous
            <input type="radio" name="Diet" value="Facultative Carnivore">Facultative Carnivore
            <input type="radio" name="Diet" value="Obligate Carnivore">Obligate Carnivore
            <li>Mouths</li>
            <input type="radio" name="Mouths" value="Lips">Lips
            <input type="radio" name="Mouths" value="Beak">Beak
            <input type="radio" name="Mouths" value="Trunk">Trunk
            <input type="radio" name="Mouths" value="Proboscis">Proboscis
            <input type="radio" name="Mouths" value="Mandibles">Mandibles
            <input type="radio" name="Mouths" value="Sponge">Sponge
            <input type="radio" name="Mouths" value="Jaw">Jaw
            <input type="radio" name="Mouths" value="Flexible Jaw">Flexible Jaw
            <br />
            <li>Specialized Teeth</li>
            <input type="radio" name="Teeth" value="Fangs">Fangs
            <input type="radio" name="Teeth" value="Incisors">Incisors
            <input type="radio" name="Teeth" value="Baleen">Baleen
            <input type="radio" name="Teeth" value="Tusks">Tusks
            <input type="radio" name="Teeth" value="None">None
            <br />
            <li>Hunting</li>
            <input type="radio" name="Hunting" value="Solitary Hunter">Solitary Hunter
            <input type="radio" name="Hunting" value="Ambush hunter">Ambush hunter
            <input type="radio" name="Hunting" value="Cursorial hunter">Cursorial hunter
            <input type="radio" name="Hunting" value="Opportunistic Hunter">Opportunistic Hunter
            <input type="radio" name="Hunting" value="Pack Hunter">Pack Hunter
            <br />
            <br />
            <br />
            <li>Socialization</li>
            <input type="radio" name="Social" value="Feral">Feral
            <input type="radio" name="Social" value="Solitary Animal">Solitary Animal
            <input type="radio" name="Social" value="Social Animal">Social Animal
            <input type="radio" name="Social" value="Domesticated">Domesticated
            <br />
            <li>Disposition</li>
            <input type="radio" name="Disposition" value="Fearful">Fearful
            <input type="radio" name="Disposition" value="Skittish">Skittish
            <input type="radio" name="Disposition" value="Untrusting">Untrusting
            <input type="radio" name="Disposition" value="Indifferent">Indifferent
            <input type="radio" name="Disposition" value="Bold">Bold
            <input type="radio" name="Disposition" value="Unfriendly">Unfriendly
            <input type="radio" name="Disposition" value="Hostile">Hostile
            <input type="radio" name="Disposition" value="Aggressive">Aggressive
            <br />
            <br />

        </ul>
	    	<textarea cols="120" rows="25">
	    	
	    	</textarea>
    </fieldset>


    <input type="submit" value="Create">
    <input type="reset" value="Restart">
</form>


</body>
</html>

