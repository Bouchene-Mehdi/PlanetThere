<?php
class Event {
    private $db;
    private $uploadDir = 'C:/xampp/htdocs/PlanetThere/public/uploads/events/';
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
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
    
        // Convert start and end dates to DateTime objects for easy manipulation
        $startDate = new DateTime($eventStartDateTime);
        $endDate = new DateTime($eventEndDateTime);
    
        // Handle the case where finishDate is null
        $finishDateObj = null;
        if (!empty($finishDate)) {
            $finishDateObj = new DateTime($finishDate);
        }
    
        // Loop to create multiple events if frequency is set and finishDate is not null
        $createdEvents = 0;
        while ($finishDateObj === null || $startDate <= $finishDateObj) {
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
                        CategoryID,
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
                        :category,
                        :finishDate, 
                        :description, 
                        :image1, 
                        :image2, 
                        :eventManagerID
                      )";
    
            // Prepare statement
            $stmt = $this->db->prepare($query);
    
            // Assign variables for binding (to ensure proper reference passing)
            $eventStartDateTimeStr = $startDate->format('Y-m-d H:i:s');
            $eventEndDateTimeStr = $endDate->format('Y-m-d H:i:s');
            $finishDateStr = $finishDateObj ? $finishDateObj->format('Y-m-d') : null;
    
            // Bind parameters for the current event
            $stmt->bindParam(':eventName', $eventName);
            $stmt->bindParam(':eventStartDateTime', $eventStartDateTimeStr);
            $stmt->bindParam(':eventEndDateTime', $eventEndDateTimeStr);
            $stmt->bindParam(':locationName', $locationName);
            $stmt->bindParam(':locationAddress', $locationAddress);
            $stmt->bindParam(':locationCapacity', $locationCapacity);
            $stmt->bindParam(':maxParticipants', $maxParticipants);
            $stmt->bindParam(':frequency', $frequency);
            $stmt->bindParam(':category', $category);
            $stmt->bindParam(':finishDate', $finishDateStr);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image1', $image1);
            $stmt->bindParam(':image2', $image2);
            $stmt->bindParam(':eventManagerID', $eventManagerID);
    
            // Execute the statement
            if ($stmt->execute()) {
                $createdEvents++; // Increment the event counter if successful
            } else {
                return false; // Return false if event creation failed
            }
    
            // Increment the start and end date by the frequency (in days)
            if ($frequency > 0) {
                $startDate->modify("+$frequency days");
                $endDate->modify("+$frequency days");
            } else {
                break; // No frequency means no recurrence
            }
        }
    
        return $createdEvents > 0; // Return true if at least one event was created
    }

    public function getEventByID($eventID) {
        $query = 'SELECT * FROM events WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function handleImageUpload($file){
        $maxSize= 1024 * 1024 * 20;
        $tempLocation= $file['tmp_name'];
        if($file['size'] > $maxSize){
            $_SESSION['page2_errors']['profile_picture_err'] = 'File size is too large';
            return false;
        }
        $fileExtension= pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename= uniqid('event_'). '.' . $fileExtension;

        if(!file_exists($this->uploadDir)){
            mkdir($this->uploadDir, 0777, true);
        }
        $filepath= $this->uploadDir . $filename;
        if (!is_writable($this->uploadDir)) {
            $_SESSION['page2_errors']['profile_picture_err']= "The directory is not writable!";
            return false;
        } 
        if(move_uploaded_file($tempLocation, $filepath)){
            $relativePath= '/uploads/events/' . $filename;
            return $relativePath;
        }else{
            $_SESSION['page2_errors']['profile_picture_err'] = 'Failed to upload file';
            return false;
        }
    }
    public function searchEvents($searchQuery, $fromDate = '', $toDate = '') {
        // Start building the SQL query
        $query = 'SELECT * FROM events WHERE EventName LIKE :searchQuery AND IsActive = 1';
        
        // Add date filters to the query if provided
        if ($fromDate != '') {
            $query .= ' AND StartDate >= :fromDate';
        }
        if ($toDate != '') {
            $query .= ' AND StartDate <= :toDate';
        }
        
        // Prepare the SQL statement
        $stmt = $this->db->prepare($query);
        
        // Bind parameters
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');
        if ($fromDate != '') {
            $stmt->bindValue(':fromDate', $fromDate);
        }
        if ($toDate != '') {
            $stmt->bindValue(':toDate', $toDate);
        }
        
        // Execute the query
        $stmt->execute();
        
        // Return the results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function IsRegistered($eventID, $userID) {
        $query = 'SELECT * FROM registrations WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function registerForEvent($eventID, $userID) {
        $query = 'INSERT INTO registrations (EventID, UserID) VALUES (:eventID, :userID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getRegisteredEvents($userID) {
        $query = 'SELECT * FROM events WHERE EventID IN (SELECT EventID FROM registrations WHERE UserID = :userID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getManagedEvents($userID) {
        $query = 'SELECT * FROM events WHERE EventManagerID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function unregisterForEvent($eventID, $userID) {
        $query = 'DELETE FROM registrations WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function getAttendanceCount($eventID) {
        $query = 'SELECT COUNT(*) as count FROM registrations WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];  // Return the count of registered users
    }
    public function getAttendees($eventID) {
        $query = 'SELECT * FROM users WHERE UserID IN (SELECT UserID FROM registrations WHERE EventID = :eventID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_5_UpcomingEvents() {
        $query = 'SELECT * FROM events WHERE StartDate > NOW() ORDER BY StartDate ASC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_5_PopularEvents() {
        $query = 'SELECT * FROM events WHERE StartDate > NOW() ORDER BY (SELECT COUNT(*) FROM registrations WHERE EventID = events.EventID) DESC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function get_5_StayFitEvents() {
        $query = 'SELECT * FROM events WHERE CategoryID = 2 AND StartDate > NOW() ORDER BY StartDate ASC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
