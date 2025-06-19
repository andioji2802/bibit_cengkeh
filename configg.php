<?php
class Koneksi {
    private $host = "localhost";
    private $username = "root";  // Sesuaikan dengan username database kamu
    private $password = "";      // Sesuaikan dengan password database kamu
    private $database = "cengkeh_db";  // Nama database yang benar
    private $conn;

    public function kondb() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}
?>
