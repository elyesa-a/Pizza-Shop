<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class ItemModel extends BaseModel {
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

    /**
     * Create - Insert a new record into the database.
     *
     * @param string $name
     * @return bool Success status
     */
    public function create(string $name): bool {
        $name = $this->db->real_escape_string($name);
        $sql = "INSERT INTO items (name) VALUES ('$name')";

        $success = $this->db->query($sql);

        if (!$success) {
            throw new Exception("Einfügen fehlgeschlagen: " . $this->db->error);
        }

        return true;
    }

    /**
     * Read (Single) - Retrieve a specific record by its ID.
     *
     * @param int $id
     * @return array|null The record data or null if not found
     */
    public function getById(int $id): ?array {
        $id = (int)$id; // Sicherheit gegen Injection
        $sql = "SELECT * FROM items WHERE id = $id";

        $recordset = $this->db->query($sql);

        if (!$recordset) {
            throw new Exception("Abfrage fehlgeschlagen: " . $this->db->error);
        }

        $record = $recordset->fetch_assoc();
        $recordset->free();

        return $record ?: null;
    }

    /**
     * Update - Modify an existing record.
     *
     * @param int $id
     * @param string $name
     * @return bool Success status
     */
    public function update(int $id, string $name): bool {
        $id = (int)$id;
        $name = $this->db->real_escape_string($name);
        $sql = "UPDATE items SET name = '$name' WHERE id = $id";

        $success = $this->db->query($sql);

        if (!$success) {
            throw new Exception("Update fehlgeschlagen: " . $this->db->error);
        }

        return $this->db->affected_rows > 0;
    }

    /**
     * Delete - Remove a record from the database.
     *
     * @param int $id
     * @return bool Success status
     */
    public function delete(int $id): bool {
        $id = (int)$id;
        $sql = "DELETE FROM items WHERE id = $id";

        $success = $this->db->query($sql);

        if (!$success) {
            throw new Exception("Löschen fehlgeschlagen: " . $this->db->error);
        }

        return $this->db->affected_rows > 0;
    }
}