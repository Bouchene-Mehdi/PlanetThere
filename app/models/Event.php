<?php
class Event {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Create a new Event Template
    public function createTemplate($data) {
        $query = 'INSERT INTO event_templates (frequency, description, max_participants, event_name, user_id) 
                  VALUES (:frequency, :description, :max_participants, :event_name, :user_id)';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':frequency', $data['frequency']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':max_participants', $data['maxParticipants']);
        $stmt->bindParam(':event_name', $data['eventName']);
        $stmt->bindParam(':user_id', $data['userId']);

        return $stmt->execute();
    }

    // Create a new Event Instance
    public function createInstance($data) {
        $query = 'INSERT INTO event_instances (start_date, end_date, available_places, is_active, template_id) 
                  VALUES (:start_date, :end_date, :available_places, :is_active, :template_id)';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':start_date', $data['startDate']);
        $stmt->bindParam(':end_date', $data['endDate']);
        $stmt->bindParam(':available_places', $data['availablePlaces']);
        $stmt->bindParam(':is_active', $data['isActive'], PDO::PARAM_BOOL);
        $stmt->bindParam(':template_id', $data['templateId']);

        return $stmt->execute();
    }

    // Get all Event Templates
    public function getAllTemplates() {
        $query = 'SELECT * FROM event_templates';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all Event Instances
    public function getAllInstances() {
        $query = 'SELECT * FROM event_instances';
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get Event Template by ID
    public function getTemplateById($id) {
        $query = 'SELECT * FROM event_templates WHERE template_id = :id LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get Event Instance by ID
    public function getInstanceById($id) {
        $query = 'SELECT * FROM event_instances WHERE event_id = :id LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Event Template
    public function updateTemplate($id, $data) {
        $query = 'UPDATE event_templates 
                  SET frequency = :frequency, description = :description, max_participants = :max_participants, event_name = :event_name 
                  WHERE template_id = :id';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':frequency', $data['frequency']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':max_participants', $data['maxParticipants']);
        $stmt->bindParam(':event_name', $data['eventName']);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Update Event Instance
    public function updateInstance($id, $data) {
        $query = 'UPDATE event_instances 
                  SET start_date = :start_date, end_date = :end_date, available_places = :available_places, is_active = :is_active 
                  WHERE event_id = :id';
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':start_date', $data['startDate']);
        $stmt->bindParam(':end_date', $data['endDate']);
        $stmt->bindParam(':available_places', $data['availablePlaces']);
        $stmt->bindParam(':is_active', $data['isActive'], PDO::PARAM_BOOL);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Delete Event Template
    public function deleteTemplate($id) {
        $query = 'DELETE FROM event_templates WHERE template_id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Delete Event Instance
    public function deleteInstance($id) {
        $query = 'DELETE FROM event_instances WHERE event_id = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
