<?php
class Database
{
    // specify your own database credentials
    private $host = "68.178.217.6";
    private $db_name = "bluphone";
    private $username = "bluphone";
    private $password = "Blu123phone#";
    public $conn;

    // get the database connection
    public function getConnection()
    {

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}


?>