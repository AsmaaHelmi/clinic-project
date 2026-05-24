<?php
class Database {
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $db   = 'clinic';

    protected $conn;

    public function __construct() {
        $this->conn = mysqli_connect(
            $this->host,
            $this->user,
            $this->pass,
            $this->db
        );

        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}
?>