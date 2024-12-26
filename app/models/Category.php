<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Method to fetch all categories
    public function getAllCategories() {
        // Prepare the SQL query
        $query = "SELECT CategoryID, CategoryName FROM categories";

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Execute the statement
        $stmt->execute();

        // Fetch all rows as an associative array
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return the categories array
        return $categories;
    }
    public function getCategryById($CategoryID){
        $query = "SELECT CategoryID, CategoryName FROM categories WHERE CategoryID = :CategoryID";

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind the parameter
        $stmt->bindValue(':CategoryID', $CategoryID);

        // Execute the statement
        $stmt->execute();

        // Fetch the category as an associative array
        $category = $stmt->fetch(PDO::FETCH_ASSOC);

        // Return the category
        return $category;
    }
}
