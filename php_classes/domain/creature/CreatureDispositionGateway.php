<?php
namespace BattleChores\domain\creature;

use PDO;

class CreatureDispositionGateway
{
    protected $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @return array result of all dispositions
     */
    public function selectAll()
    {
        $query = "
            SELECT id, name
            FROM creature_tier_disposition
        ";
        $stmt = $this->database->query($query);
        return $stmt->fetchAll();
    }

    /**
     * @param string $name Name for creature disposition
     *
     * @return boolean True if insert succeeded otherwise false
     */
    public function insertNew($name)
    {
        $query = "
            INSERT INTO creature_tier_disposition (name)
            VALUES (:name);
        ";
        $stmt = $this->database->prepare($query);
        $stmt->execute(array(':name' => $name));
        return $stmt->errorInfo()[0] == "00000" ? true : false;
    }
}
