<?php

class Faq {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    // Retrieve all FAQs
    public function getAllFaqs() {
        $query = "SELECT * FROM faq";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Add a new FAQ
    public function addFaq($question, $answer) {
        $query = "INSERT INTO faq (Question, Answer) VALUES (:question, :answer)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
        return $stmt->execute();
    }
    public function FaqCount(){
        $query = "SELECT COUNT(*) FROM faq";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }



    // Delete an FAQ
    public function deleteFaq($faqID) {
        $query = "DELETE FROM faq WHERE FaqID = :faqID";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':faqID', $faqID);
        return $stmt->execute();
    }
}
