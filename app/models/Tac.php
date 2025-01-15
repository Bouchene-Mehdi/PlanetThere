<?php

class Tac {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection(); // Assuming Database is a class for DB connection
    }

    public function getAllTacs() {
        // Query to fetch all TAC conditions
        $query = "SELECT * FROM tac ORDER BY tacID ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTac($condition, $detail) {
        // Insert a new TAC condition into the database
        $query = "INSERT INTO tac (conditionT, detail) VALUES (:condition, :detail)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':condition', $condition);
        $stmt->bindParam(':detail', $detail);
        $stmt->execute();
    }

    public function deleteTac($tacID) {
        // Delete a TAC condition by its ID
        $query = "DELETE FROM tac WHERE tacID = :tacID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':tacID', $tacID);
        $stmt->execute();
    }
}
