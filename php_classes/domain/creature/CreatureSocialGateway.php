<?php
namespace BattleChores\domain\creature;

use PDO;

class CreatureSocialGateway
{
    protected $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @return array result of all social types
     */
    public function selectAll()
    {
        $query = "
            SELECT id, name
            FROM creature_tier_social
        ";
        $stmt = $this->database->query($query);
        return $stmt->fetchAll();
    }

    /**
     * @param string $name Name for creature social type
     *
     * @return boolean True if insert succeeded otherwise false
     */
    public function insertNew($name)
    {
        $query = "
            INSERT INTO creature_tier_social (name)
            VALUES (:name);
        ";
        $stmt = $this->database->prepare($query);
        $stmt->execute(array(':name' => $name));
        return $stmt->errorInfo()[0] == "00000" ? true : false;
    }
}
