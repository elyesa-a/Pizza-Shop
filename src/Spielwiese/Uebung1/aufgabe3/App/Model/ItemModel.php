<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class ItemModel extends BaseModel
{
    /**
     * Read - Retrieve all records.
     *
     * @return array
     */
    public function getAll(): array {
        $sql = "SELECT * FROM items";

        $recordset = $this->db->query($sql);

        if (!$recordset) {
            throw new Exception("Abfrage fehlgeschlagen: " . $this->db->error);
        }

        $result = $recordset->fetch_all(MYSQLI_ASSOC);
        $recordset->free();

        return $result;
    }
}