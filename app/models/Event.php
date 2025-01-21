<?php
class Event {
    private $db;
    private $uploadDir = 'uploads/events/';
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
                        EventManagerID,
                        IsActive
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
                        :eventManagerID,
                        :isActive
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
            $stmt->bindValue(':isActive', 0);

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
    public function searchEvents($searchQuery, $fromDate = '', $toDate = '', $selectedCategory = '', $location='', $showFullEvents = true) {
        // building up the sql query
        $query = 'SELECT e.* 
                  FROM events e 
                  INNER JOIN categories c ON e.CategoryID = c.CategoryID
                  WHERE e.EventName LIKE :searchQuery AND e.IsActive = 1';

        if ($selectedCategory == 'All Categories') {
            $selectedCategory = '';
        }
    
        // adding the date and category filters
        if (!empty($fromDate)) {
            $query .= ' AND e.StartDate >= :fromDate';
        }
        if (!empty($toDate)) {
            $query .= ' AND e.StartDate <= :toDate';
        }
        if (!empty($selectedCategory)) {
            $query .= ' AND c.CategoryName = :category';
        }
        if (!empty($location)) {
            $query .= ' AND e.LocationAddress LIKE :location';
        }

        $stmt = $this->db->prepare($query);
    
        // Always bind search query
        $stmt->bindValue(':searchQuery', '%' . $searchQuery . '%');

        // Bind other parameters if they are set
        if (!empty($location)) {
            $stmt->bindValue(':location', '%' . $location . '%');
        }
        if (!empty($fromDate)) {
            $stmt->bindValue(':fromDate', $fromDate);
        }
        if (!empty($toDate)) {
            $stmt->bindValue(':toDate', $toDate);
        }
        if (!empty($selectedCategory)) {
            $stmt->bindValue(':category', $selectedCategory);
        }

        $stmt->execute();
        if ($showFullEvents == false){
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $filteredEvents = [];
            foreach ($events as $event) {
                if (!$this->IsEventFull($event['EventID'])) {
                    $filteredEvents[] = $event;
                }
            }
            return $filteredEvents;
        }
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
    public function IsInWaitlist($eventID,$userID){
        $query = 'SELECT * FROM waitlisting WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function registerForEvent($eventID, $userID, $quantity) {
        // Insert the registration into the database
        $query = 'INSERT INTO registrations (EventID, UserID, Quantity, RegistrationDate) 
                  VALUES (:eventID, :userID, :quantity, NOW())';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
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
    public function addToWaitlist($eventID, $userID) {
        $query = 'INSERT INTO waitlisting (EventID, UserID) VALUES (:eventID, :userID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function removeFromWaitlist($eventID, $userID){
        $query = 'DELETE FROM waitlisting WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function HasWaitlist($eventID){
        $query = 'SELECT * FROM waitlisting WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
    public function MoveFromWaitlist($eventID){
        //take the user from the waitlisting with the earliest waitlisting date in and add it to the registrations
        $query = 'SELECT * FROM waitlisting WHERE EventID = :eventID ORDER BY WaitlistingDate ASC LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $userID = $result['UserID'];
        $query = 'INSERT INTO registrations (EventID, UserID) VALUES (:eventID, :userID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $query = 'DELETE FROM waitlisting WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        return $stmt->execute();

    }
    public function IsEventFull($eventID) {
        // Get the attendance count
        $attendanceCount = $this->getAttendanceCount($eventID);

        // Query to get the maximum participants for the event
        $query = 'SELECT MaxParticipants FROM events WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        $maxParticipants = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ensure $maxParticipants is valid and contains the expected key
        if ($maxParticipants && isset($maxParticipants['MaxParticipants'])) {
            return $attendanceCount >= $maxParticipants['MaxParticipants'];
        }

        // If event doesn't exist or is invalid, return false
        return false;
    }
    public function getAttendanceCount($eventID) {
        $query = 'SELECT SUM(Quantity) as count FROM registrations WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Ensure $result is valid and contains the count
        return ($result && isset($result['count'])) ? (int)$result['count'] : 0;
    }

    public function getAttendeesAccounts($eventID) {
        $query = 'SELECT * FROM users WHERE UserID IN (SELECT UserID FROM registrations WHERE EventID = :eventID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getWaitlistAccounts($eventID){
        $query = 'SELECT * FROM users WHERE UserID IN (SELECT UserID FROM waitlisting WHERE EventID = :eventID)';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAttendanceCountUser($eventID,$userID){
        //q:look for the quantity registration of user with that id
        $query = 'SELECT Quantity FROM registrations WHERE EventID = :eventID AND UserID = :userID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result && isset($result['Quantity'])) ? (int)$result['Quantity'] : 0;
    }
    public function get_5_UpcomingEvents() {
        $query = 'SELECT * FROM events WHERE StartDate > NOW() AND IsActive = 1 ORDER BY StartDate ASC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_5_FollowersEvents() {
        $query = 'SELECT e.* 
                  FROM events e
                  INNER JOIN registrations r ON e.EventID = r.EventID
                  INNER JOIN follows f ON r.UserID = f.followed_id 
                  WHERE f.follower_id  = :userID
                  AND e.IsActive = 1
                  ORDER BY e.StartDate ASC
                  LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userID', $_SESSION['user']['UserID'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_5_PopularEvents() {
        $query = 'SELECT * FROM events WHERE StartDate > NOW() AND IsActive = 1 ORDER BY (SELECT COUNT(*) FROM registrations WHERE EventID = events.EventID) DESC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_5_StayFitEvents() {
        $query = 'SELECT * FROM events WHERE IsActive = 1 AND CategoryID = 2 AND StartDate > NOW() ORDER BY StartDate ASC LIMIT 5';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getEventReviews($eventID){
        $query = 'SELECT * FROM reviews WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array('eventID' => $eventID));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function submitEventReview($userID, $eventID, $comment, $score) {
        $query = 'INSERT INTO reviews (
                     Score,
                     Comment,
                     EventID,
                     UserID)
                     VALUES (
                     :score,
                     :comment,
                     :eventID,
                     :userID    
                     )';
        $stmt = $this->db->prepare($query);

        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':score', $score, PDO::PARAM_INT); // Assuming score is an integer
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR); // Assuming comment is a string
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT); // Assuming eventID is an integer
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT); // Assuming userID is an integer

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Successfully inserted the review
        } else {
            // Log or handle the error
            error_log('Failed to insert event review: ' . implode(', ', $stmt->errorInfo()));
            return false; // Insertion failed
        }
    }
    public function editEvent($eventID, $locationName, $locationAddress, $description) {
        $query = "UPDATE events 
                  SET LocationName = :locationName, 
                      LocationAddress = :locationAddress, 
                      Description = :description 
                  WHERE EventID = :eventID";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':locationName', $locationName);
        $stmt->bindParam(':locationAddress', $locationAddress);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);

        // Execute the statement and return a boolean based on success or failure
        return $stmt->execute() ? true : false;
    }


    /**
     * Delete Event: Remove the event by ID
     */
    public function deleteEvent($eventID) {
        $query = "DELETE FROM events WHERE EventID = :eventID";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function getAllActiveEvents() {
        $query = 'SELECT * FROM events WHERE IsActive = 1';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function PropositionCount(){
        $query = 'SELECT COUNT(*) FROM events WHERE IsActive = 0';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function ActiveEventCount(){
        $query = 'SELECT COUNT(*) FROM events WHERE IsActive = 1';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getAllPropositions() {
        $query = 'SELECT * FROM events WHERE IsActive = 0';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function makeActive($eventID) {
        $query = 'UPDATE events SET IsActive = 1 WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function makeUnactive($eventID) {
        $query = 'UPDATE events SET IsActive = 0 WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function removeEvent($eventID){
        $query = 'DELETE FROM events WHERE EventID = :eventID';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
        return $stmt->execute();
    }

}
?>