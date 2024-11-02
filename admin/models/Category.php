<?php

class Category
{
    public $conn;
    // ket noi CSDL
    public function __construct() {
        $this->conn = connectDB();
    }

    // danh sach danh muc
    public function getAllCategory() {
        try {
            $sql = "SELECT * FROM `categories`";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }
    // them du lieu vao CSDL
    public function postData($category_name, $category_status) {
        try {
            $sql = "INSERT INTO `categories`(`category_name`, `status`) VALUES (:category_name, :status)";

            $stmt = $this->conn->prepare($sql);

            // gan gia tri vao cac tham so
            $stmt->bindParam(':category_name', $category_name);
            $stmt->bindParam(':status', $category_status);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // lay thong tin chi tiet
    public function getDetailData($id) {
        try {
            $sql = "SELECT * FROM `categories` WHERE category_id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // xoa du lieu trong CSDL
    public function deleteData($id) {
        try {
            $sql = "DELETE FROM `categories` WHERE category_id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }
    }

    // huy ket noi CSDL
    public function __destruct() {
        $this->conn = null;
    }
}
