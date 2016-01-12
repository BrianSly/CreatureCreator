<?php
namespace BattleChores\domain\creature;

use PDO;

class CreatureAttributeGateway
{
    protected $database;

    public function __construct(PDO $database)
    {
        $this->database = $database;
    }

    /**
     * @return array result of all attributes
     */
    public function selectAll()
    {
        $query = "
            SELECT
              attribute.id,
              attribute.name,
              attribute_type.name AS type_name
            FROM creature_attribute AS attribute
            LEFT JOIN creature_attribute_type AS attribute_type
              ON attribute.creature_attribute_type_id = attribute_type.id
        ";
        $stmt = $this->database->query($query);
        return $stmt->fetchAll();
    }

    /**
     * @param string $name Name of new creature attribute
     * @param int $attributeTypeId Primary key in creature_attribute_type table
     *
     * @return boolean True if insert succeeded otherwise false
     */
    public function insertNew($name, $attributeTypeId)
    {
        $query = "
            INSERT INTO creature_attribute (name, creature_attribute_type_id)
            VALUES (:name, :creature_attribute_type_id);
        ";
        $stmt = $this->database->prepare($query);
        $stmt->execute(array(':name' => $name, ':creature_attribute_type_id' => $attributeTypeId));
        return $stmt->errorInfo()[0] == "00000" ? true : false;
    }
}
