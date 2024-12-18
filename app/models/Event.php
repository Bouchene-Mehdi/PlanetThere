<?php
class Event {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Method to create an event
    public function createEvent(
        $eventName, 
        $eventStartDateTime, 
        $eventEndDateTime, 
        $locationName, 
        $locationAddress, 
        $locationCapacity, 
        $maxParticipants, 
        $frequency, 
        $category, 
        $finishDate, 
        $description, 
        $image1, 
        $image2
    ) {
        // Check if EventManagerID is available in the session
        if (!isset($_SESSION['user']['UserID'])) {
            throw new Exception("User not logged in or invalid session data.");
        }

        $eventManagerID = $_SESSION['user']['UserID'];

        // Prepare the SQL query
        $query = "INSERT INTO events (
                    EventName, 
                    StartDate, 
                    EndDate, 
                    LocationName, 
                    LocationAddress, 
                    LocationCapacity, 
                    MaxParticipants, 
                    Frequency, 
                    RepeatUntil, 
                    Description, 
                    Image1, 
                    Image2, 
                    EventManagerID  
                  ) VALUES (
                    :eventName, 
                    :eventStartDateTime, 
                    :eventEndDateTime, 
                    :locationName, 
                    :locationAddress, 
                    :locationCapacity, 
                    :maxParticipants, 
                    :frequency, 
                    :finishDate, 
                    :description, 
                    :image1, 
                    :image2, 
                    :eventManagerID
                  )";

        // Prepare statement
        $stmt = $this->db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':eventName', $eventName);
        $stmt->bindParam(':eventStartDateTime', $eventStartDateTime); // Bound to datetime value
        $stmt->bindParam(':eventEndDateTime', $eventEndDateTime);     // Bound to datetime value
        $stmt->bindParam(':locationName', $locationName);
        $stmt->bindParam(':locationAddress', $locationAddress);
        $stmt->bindParam(':locationCapacity', $locationCapacity);
        $stmt->bindParam(':maxParticipants', $maxParticipants);
        $stmt->bindParam(':frequency', $frequency);
        $stmt->bindParam(':finishDate', $finishDate);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image1', $image1);
        $stmt->bindParam(':image2', $image2);
        $stmt->bindParam(':eventManagerID', $eventManagerID);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Event created successfully
        } else {
            return false; // Event creation failed
        }
    }
}
