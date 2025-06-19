<?php
class Koneksi {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cengkeh_db";
    public $conn;

    public function kondb() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}
?>
