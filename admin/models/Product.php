<?php

class Product
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    public function getAllProduct() {
        try {
            $sql = "SELECT * FROM `categories`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
}