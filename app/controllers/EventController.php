<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
class EventController {

    public function ShowEventCreate1(){
        render('event/create-event-1');
    }
    public function ShowEventCreate2(){    
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();

        // Pass the categories to the view
        render('event/create-event-2', ['categories' => $categories]);
    }

    public function ShowEventDetails($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Fetch the event details by ID
        $event = $eventModel->getEventById($EventID);

        $categoryModel = new Category();
        $categories = $categoryModel->getCategryById($event['CategoryID']);
        $userModel = new User();
        $moreEvents = $eventModel->get_5_UpcomingEvents();


        foreach ($moreEvents as $key => $displayEvent){
            $moreEvents[$key]['AttendeesCount'] = $eventModel->getAttendanceCount($displayEvent['EventID']);
        }
        // Vérifier si un username est passé en paramètre

        $manager=$userModel->getUserById($event['EventManagerID']);
        $IsInWaitlist = $eventModel->IsInWaitlist($EventID, $_SESSION['user']['UserID']);
        $IsRegistered = $eventModel->IsRegistered($EventID, $_SESSION['user']['UserID']);

        
        $isFull = $eventModel->IsEventFull($event);


            // Utiliser le username fourni
    
        // Fetch the attendance count for the event
        $attendanceCount = $eventModel->getAttendanceCount($EventID);


        // Determine if event is finished
        $currentDate = new DateTime();
        $endDate = new DateTime($event['EndDate']);


        if ($endDate > $currentDate) {
            // Render the view with event details

            render('event/event-details', [
                'event' => $event,
                'attendanceCount' => $attendanceCount,
                'manager'=>$manager,
                'categories'=>$categories,
                'moreEvents'=>$moreEvents,
                'IsRegistered'=>$IsRegistered,
                'IsInWaitlist'=>$IsInWaitlist,
            ]);
        } else {
            $reviews = $eventModel->getEventReviews($EventID);


            //Flag to check if the user has left a review
            // that is: was registered for the event and didn't leave a review yet
            $canReview = $eventModel->IsRegistered($EventID, $_SESSION['user']['UserID']);


            foreach ($reviews as &$review) {
                // Fetch user details by UserID
                $reviewUser = $userModel->GetUserById($review['UserID']);
                $review['UserProfileImage'] = $reviewUser['ProfileImage'];
                $review['UserFirstName'] = $reviewUser['FirstName'];
                $review['UserLastName'] = $reviewUser['LastName'];
                if ($reviewUser['UserID'] === $_SESSION['user']['UserID']) {
                    $canReview = true;
                }
            }
            render('event/event-review',
            [
                'event' => $event,
                'attendanceCount' => $attendanceCount,
                'manager'=>$manager,
                'categories'=>$categories,
                'reviews'=>$reviews,
                'moreEvents'=>$moreEvents,
                'canReview'=>$canReview,
                'isRegistered'=>$IsRegistered,
                'isWaitlisted'=>$IsInWaitlist,
            ]);
        }
    }
    public function IsEventFull($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Fetch the event details by ID
        $event = $eventModel->getEventById($EventID);
        
        // Check if the event is full
        $isFull = $eventModel->IsEventFull($event);
        // Return the result as JSON
        return $isFull;
    }
    // EventController.php (Create Event Step 1)
    public function createEventStep1() {
        // Initialize data
        $data = [
            'eventname' => '',
            'eventstartdate' => '',  // Updated for start date
            'eventstarttime' => '',  // Updated for start time
            'eventenddate' => '',    // Added for end date
            'eventendtime' => '',    // Added for end time
            'locationname' => '',
            'locationaddress' => '',
            'locationcapacity' => ''
        ];
    
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize input data
            $data['eventname'] = trim($_POST['eventname']);
            $data['eventstartdate'] = trim($_POST['eventstartdate']); // For start date
            $data['eventstarttime'] = trim($_POST['eventstarttime']); // For start time
            $data['eventenddate'] = trim($_POST['eventenddate']);     // For end date
            $data['eventendtime'] = trim($_POST['eventendtime']);     // For end time
            $data['locationname'] = trim($_POST['locationname']);
            $data['locationaddress'] = trim($_POST['locationaddress']);
            $data['locationcapacity'] = trim($_POST['locationcapacity']);
        
            // Store the event data and redirect to step 2
            $_SESSION['event_data'] = $data;
            header('Location: /create-event2');
            exit();
        }
    }
    public function createEventStep2() {
        // Check if session data exists from Step 1

        if (!isset($_SESSION['event_data'])) {
            header('Location: /create-event1');  // Redirect back to step 1 if no data found
            exit();
        }
    
        // Initialize data from session
        $data = $_SESSION['event_data'];

        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Initialize error session keys
            $_SESSION['errors'] = []; // Reset errors session for each form submission
    

    
            // Sanitize input data for additional fields
            $maxParticipants = trim($_POST['maxParticipants']);
            $frequency = trim($_POST['frequency']);
            $category = trim($_POST['categories']);
            $finishDate = trim($_POST['finishdate']);
            $description = trim($_POST['description']);
            
            // Validation logic
            if ($frequency > 0 && empty($finishDate)) {
                $_SESSION['errors']['finishdate'] = 'Finish date is required if frequency is greater than 0.';
            }
    
            // If there are any errors, redirect back to the form
            if (!empty($_SESSION['errors'])) {
                header('Location: /create-event2');
                exit();
            }
    
            // Merge date and time for start and end datetime
            $eventStartDateTime = $data['eventstartdate'] . ' ' . $data['eventstarttime'];  // Combine start date and time
            $eventEndDateTime = $data['eventenddate'] . ' ' . $data['eventendtime'];        // Combine end date and time

    
            // Store the event data into the database
            $event = new Event();
            if(isset($_FILES['image1']) && $_FILES['image1']['error'] === 0){
                $imagePath=$event->handleImageUpload($_FILES['image1']);
                if($imagePath){
                    $data['image1']=$imagePath;
                }else{
                    header("Location: /create-event2");
                    exit;
                }
            }else{
                $data['image1'] ='assets/images/insert-image.png';
            }
            if(isset($_FILES['image2']) && $_FILES['image2']['error'] === 0){
                $imagePath=$event->handleImageUpload($_FILES['image2']);
                if($imagePath){
                    $data['image2']=$imagePath;
                }else{
                    header("Location: /create-event2");
                    exit;
                }
            }else{
                $data['image2'] ='assets/images/insert-image.png';
            }
            $event->createEvent(
                $data['eventname'],
                $eventStartDateTime,  // Send the combined start datetime
                $eventEndDateTime,    // Send the combined end datetime
                $data['locationname'],
                $data['locationaddress'],
                $data['locationcapacity'],
                $maxParticipants,
                $frequency,
                $category,
                $finishDate,
                $description,
                $data['image1'],
                $data['image2']
            );
    
            if ($event) {
                unset($_SESSION['event_data']);
                header('Location: /');  // Redirect to the event listing page
                exit();
            } else {
                
                header('Location: /create-event2');
                exit();
            }
        }
    }
    

    public function submitEventReview() {
        // Check if the user is logged in
        if (!isset($_SESSION['user'])) {
            header('Location: /login');  // Redirect to login page if user is not logged in
            exit();
        }

        // Check if the review form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Collect review data from POST request
            $rating = $_POST['rating'] ?? null;
            $comment = $_POST['comment'] ?? '';
            $EventID = $_POST['event_id'] ?? null;

            // Validate the inputs
            if (empty($rating) || empty($comment)) {
                $_SESSION['errors']['review'] = 'Please provide both a rating and a comment.';
                header('Location: /event/' . $EventID . '/review');  // Redirect back to the event review page
                exit();
            }

            // Ensure rating is valid (e.g., between 1 and 5)
            if ($rating < 1 || $rating > 5) {
                $_SESSION['errors']['rating'] = 'Rating must be between 1 and 5.';
                header('Location: /event/' . $EventID . '/review');
                exit();
            }

            // Initialize the Event model (or a separate Review model if you have one)
            $eventModel = new Event();

            // Save the review to the database
            $userID = $_SESSION['user']['UserID'];  // Assuming user ID is stored in the session
            $eventModel->submitEventReview( $userID,$EventID, $comment,  $rating);

            // Redirect back to the event details page, where the review will be displayed
            header('Location: /event/' . $EventID);
            exit();
        }
    }

    public function RegisterForEvent($EventID){
        // Initialize the event model
        if (isset($_POST['quantity']) && is_numeric($_POST['quantity']) && $_POST['quantity'] > 0) {
            $quantity = (int)$_POST['quantity'];  // Get the number of tickets from POST
            
            // Initialize the event model
            $eventModel = new Event();
            
            // Register the user for the event with the specified quantity
            $eventModel->registerForEvent($EventID, $_SESSION['user']['UserID'], $quantity);
        
            // Register the user for the event
            
            // Redirect back to the event details page
            header('Location: /event/' . $EventID);
        }
        exit();
    }


    
    public function UnregisterForEvent($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Unregister the user from the event
        $eventModel->unregisterForEvent($EventID, $_SESSION['user']['UserID']);
        if($eventModel->HasWaitlist($EventID)){
            $eventModel->MoveFromWaitlist($EventID);
        }
        //q :i want to get the earliest waitlist user and register him?

        
        // Get the earliest user from the waitlist


        // Redirect back to the event details page
        header('Location: /event/' . $EventID);
        exit();
    }   
    public function WaitlistForEvent($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Add the user to the waitlist for the event
        $eventModel->addToWaitlist($EventID, $_SESSION['user']['UserID']);
        
        // Redirect back to the event details page
        header('Location: /event/' . $EventID);
        exit();
    }
    public function EditEvent($eventID) {
        $eventModel = new Event();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];

            if ($action === 'save') {
                // Handle Edit Event
                $location = $_POST['location'];
                $description = $_POST['description'];

                // Split location into name and address
                [$locationName, $locationAddress] = array_map('trim', explode(',', $location, 2));

                $success = $eventModel->editEvent($eventID, $locationName, $locationAddress, $description);

                if ($success) {
                    $_SESSION['success_message'] = "Event updated successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to update event. Please try again.";
                }

                header("Location: /event/$eventID"); // Redirect to event details
                exit();

            } elseif ($action === 'delete') {
                // Handle Delete Event
                $success = $eventModel->deleteEvent($eventID);

                if ($success) {
                    header("Location: /event-search"); // Redirect to the list of events
                } else {
                    $_SESSION['error_message'] = "Failed to delete event. Please try again.";
                    header("Location: /event/$eventID"); // Redirect to event details
                }

                exit();
            }
        }
    }
    public function UnwaitlistForEvent($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Remove the user from the waitlist for the event
        $eventModel->removeFromWaitlist($EventID, $_SESSION['user']['UserID']);
        
        // Redirect back to the event details page
        header('Location: /event/' . $EventID);
        exit();
    }
    public function ShowEventAttendees($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Fetch the event details by ID
        $event = $eventModel->getEventById($EventID);
        
        // Fetch the attendees for the event
        $attendees = $eventModel->getAttendeesAccounts($EventID);
        //q:i want to add how many registrations for each attendee with $attendees
        foreach ($attendees as &$attendee) {
            $attendee['registrationCount'] = $eventModel->getAttendanceCountUser($EventID,$attendee['UserID']);
        }
        // Render the view with event details and attendees
        render('event/event-attendees', [
            'event' => $event,
            'attendees' => $attendees
        ]);
    }
    public function ShowEventWaitlist($EventID){
        // Initialize the event model
        $eventModel = new Event();
        
        // Fetch the event details by ID
        $event = $eventModel->getEventById($EventID);
        
        // Fetch the attendees for the event
        $waitlisters = $eventModel->getWaitlistAccounts($EventID);
        //q:i want to add how many registrations for each attendee with $attendees
        foreach ($waitlisters as $waitlister) {
            $waitlister['registrationCount'] = $eventModel->getAttendanceCountUser($EventID,$waitlister['UserID']);
        }
        // Render the view with event details and attendees
        render('event/event-waitlist', [
            'event' => $event,
            'waitlisters' => $waitlisters
        ]);
    }
    public function RemoveAttendee(){
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Initialize the event model
            $eventModel = new Event();
            
            // Remove the attendee from the event
            $eventModel->unregisterForEvent($_POST['event_id'], $_POST['user_id']);
            
            // Redirect back to the event attendees page
            header('Location: /event-attendees/' . $_POST['event_id']);
            exit();
        }

    }
    public function RemoveWaitlister(){
        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Initialize the event model
            $eventModel = new Event();
            
            // Remove the waitlister from the event
            $eventModel->removeFromWaitlist($_POST['event_id'], $_POST['user_id']);
            
            // Redirect back to the event waitlist page
            header('Location: /event-waitlist/' . $_POST['event_id']);
            exit();
        }
    }
    

    
        
    function uploadFile($file) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
            $maxFileSize = 5 * 1024 * 1024; // 5 MB
        
            // Check if the file is valid
            if ($file['error'] === UPLOAD_ERR_OK) {
                $fileType = $file['type'];
                $fileSize = $file['size'];
        
                if (!in_array($fileType, $allowedTypes)) {
                    echo 'Invalid file type.';
                    return null;
                }
                if ($fileSize > $maxFileSize) {
                    echo 'File size exceeds the limit.';
                    return null;
                }
        
                // Generate unique file name and move the uploaded file
                $fileName = uniqid('event_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
                $uploadDir = 'uploads/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
        
                $filePath = $uploadDir . $fileName;
                move_uploaded_file($file['tmp_name'], $filePath);
        
                return $filePath;
            }
        
            return null;
        }
    public function ShowEventSearch() {
        // Set the search query if not already set
        if (!isset($_SESSION['searchQuery_event'])) {
            $_SESSION['searchQuery_event'] = '';
        }
    
        // Retrieve "From" and "To" dates from session or POST data
        $fromDate = isset($_SESSION['from-date']) ? $_SESSION['from-date'] : '';
        $toDate = isset($_SESSION['to-date']) ? $_SESSION['to-date'] : '';

        // Retrieve the category from the session
        $selectedCategory = isset($_SESSION['event-category']) ? $_SESSION['event-category'] : '';
        
        // Initialize the model
        $eventModel = new Event();
        
        // Fetch events based on the search query and date range
        $events = $eventModel->searchEvents($_SESSION['searchQuery_event'], $fromDate, $toDate, $selectedCategory);
        
        foreach ($events as &$event) {
            // Add attendance count to the event
            $event['attendanceCount'] = $eventModel->getAttendanceCount($event['EventID']);
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
    
        // Render the view with event data and filter values
        render('event/event-search', [
            'categories' => $categories,
            'events' => $events,
            'searchQuery_event' => $_SESSION['searchQuery_event'],
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'selectedCategory' => $selectedCategory
        ]);
    }  
    public function postEventSearch() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            // Store the search query and date filters in the session
            $searchQuery = $_POST['search_query'] ?? '';
            $_SESSION['searchQuery_event'] = trim($searchQuery);
            
            // Store the "From" and "To" dates in the session
            $fromDate = $_POST['from-date'] ?? '';
            $toDate = $_POST['to-date'] ?? '';

            
            $_SESSION['from-date'] = $fromDate;
            $_SESSION['to-date'] = $toDate;

            // Store the selected category in the session
            $_SESSION['event-category'] = trim($_POST['event-category'] ?? '');
            
            // Redirect back to the search page
            header('Location: /event-search');
            exit();
        }
    }
}


?>