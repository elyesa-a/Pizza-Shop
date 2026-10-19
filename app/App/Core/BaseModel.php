<?php
declare(strict_types=1);

abstract class BaseModel
{
    protected readonly MySQLi $db;

    /**
     * Constructor: Initializes the database connection.
     *
     * Reads host, user, password and database name from environment variables.
     *
     * @throws Exception if the database connection fails
     */
    public function __construct()
    {   
        // Zugangsdaten kommen aus der Umgebung (docker-compose.yml), mit Standardwerten für die lokale Entwicklung
        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'public';
        $password = getenv('DB_PASSWORD') ?: 'public';
        $database = getenv('DB_NAME') ?: 'pizzaservice';

        $this->db = new MySQLi($host, $user, $password, $database);

        if ($this->db->connect_error) {
            throw new Exception('DB connection failed: ' . $this->db->connect_error);
        }

        if (!$this->db->set_charset('utf8mb4')) {
            throw new Exception('Error setting charset: ' . $this->db->error);
        }
    }

    /**
     * Destructor: Closes the database connection when the object is destroyed.
     */
    public function __destruct()
    {
        if (isset($this->db)) {
            $this->db->close();
        }
    }
}

