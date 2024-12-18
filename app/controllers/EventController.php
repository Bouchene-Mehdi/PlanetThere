<?php
require_once __DIR__ . '/../models/Event.php';
class EventController {
    public function ShowEventSearch(){
        render('event/event-search');
    }
    public function ShowEventCreate1(){
        render('event/create-event-1');
    }
    public function ShowEventCreate2(){
        render('event/create-event-2');
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
        $data['image1'] = '';  // To store image1 path
        $data['image2'] = '';  // To store image2 path
    
        // Check if form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Initialize error session keys
            $_SESSION['errors'] = []; // Reset errors session for each form submission
    
            if(isset($_FILES['image1']) ) {
                $data['image1'] = $this->uploadFile($_FILES['image1']);
            }
            // Handle file uploads for images
            if(isset($_FILES['image2'])) {
                $data['image2'] = $this->uploadFile($_FILES['image2']);
            }
    
            // Sanitize input data for additional fields
            $maxParticipants = trim($_POST['maxParticipants']);
            $frequency = trim($_POST['frequency']);
            $category = trim($_POST['categories']);
            $finishDate = trim($_POST['finishdate']);
            $description = trim($_POST['description']);
            $category=null;
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
    
    
function uploadFile($file) {
    // Define allowed file types and max file size
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
    
    
    
    
    // Load view
}

    // public function create_1() {
    //     // Initialize data with empty values and error messages
    //     $data = [
    //         'eventname' => '',
    //         'eventdate' => '',
    //         'eventtime' => '',
    //         'locationname' => '',
    //         'locationaddress' => '',
    //         'locationcapacity' => '',
    //         'eventname_err' => '',
    //         'eventdate_err' => '',
    //         'eventtime_err' => '',
    //         'locationname_err' => '',
    //         'locationaddress_err' => '',
    //         'locationcapacity_err' => ''
    //     ];

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Sanitize POST data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data['eventname'] = trim($_POST['eventname']);
    //         $data['eventdate'] = trim($_POST['eventdate']);
    //         $data['eventtime'] = trim($_POST['eventtime']);
    //         $data['locationname'] = trim($_POST['locationname']);
    //         $data['locationaddress'] = trim($_POST['locationaddress']);
    //         $data['locationcapacity'] = trim($_POST['locationcapacity']);

    //         // Validate inputs
    //         if (empty($data['eventname'])) {
    //             $data['eventname_err'] = 'Event name is required.';
    //         }
    //         if (empty($data['eventdate'])) {
    //             $data['eventdate_err'] = 'Event date is required.';
    //         }
    //         if (empty($data['eventtime'])) {
    //             $data['eventtime_err'] = 'Event time is required.';
    //         }
    //         if (empty($data['locationname'])) {
    //             $data['locationname_err'] = 'Location name is required.';
    //         }
    //         if (empty($data['locationaddress'])) {
    //             $data['locationaddress_err'] = 'Location address is required.';
    //         }
    //         if (!is_numeric($data['locationcapacity']) || $data['locationcapacity'] < 0) {
    //             $data['locationcapacity_err'] = 'Location capacity must be a valid number.';
    //         }

    //         // Check for errors
    //         if (empty($data['eventname_err']) && empty($data['eventdate_err']) && empty($data['eventtime_err']) &&
    //             empty($data['locationname_err']) && empty($data['locationaddress_err']) && empty($data['locationcapacity_err'])) {
    //             // Store the data temporarily in the session
    //             $_SESSION['event_step1'] = [
    //                 'eventname' => $data['eventname'],
    //                 'eventdate' => $data['eventdate'],
    //                 'eventtime' => $data['eventtime'],
    //                 'locationname' => $data['locationname'],
    //                 'locationaddress' => $data['locationaddress'],
    //                 'locationcapacity' => $data['locationcapacity']
    //             ];

    //             // Redirect to the second step
    //             header("Location: /event/create-2");
    //             exit;
    //         }
    //     }

    //     // Render the first step form with validation errors
    //     $_SESSION['event_step1_errors'] = $data;
    //     header("Location: /event/create-1");
    // }

    // // Step 2: Create Event - Additional Information
    // public function create_2() {
    //     // Check if Step 1 data exists
    //     if (!isset($_SESSION['event_step1'])) {
    //         header("Location: /event/create-1");
    //         exit;
    //     }

    //     $data = [
    //         'pictures' => [],
    //         'maxParticipants' => '',
    //         'frequency' => '',
    //         'categories' => '',
    //         'finishdate' => '',
    //         'descryption' => '',
    //         'maxParticipants_err' => '',
    //         'frequency_err' => '',
    //         'categories_err' => '',
    //         'descryption_err' => ''
    //     ];

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Sanitize POST data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         // Assume file upload handling here
    //         $data['pictures'] = $_FILES['pictures'] ?? []; // Not processed in this example
    //         $data['maxParticipants'] = trim($_POST['maxParticipants']);
    //         $data['frequency'] = trim($_POST['frequency']);
    //         $data['categories'] = trim($_POST['categories']);
    //         $data['finishdate'] = trim($_POST['finishdate']);
    //         $data['descryption'] = trim($_POST['descryption']);

    //         // Validate inputs
    //         if (empty($data['maxParticipants']) || !is_numeric($data['maxParticipants']) || $data['maxParticipants'] < 0) {
    //             $data['maxParticipants_err'] = 'Max participants must be a valid number.';
    //         }
    //         if (!is_numeric($data['frequency']) || $data['frequency'] < 0) {
    //             $data['frequency_err'] = 'Frequency must be a valid number.';
    //         }
    //         if (empty($data['categories'])) {
    //             $data['categories_err'] = 'Category is required.';
    //         }
    //         if (empty($data['descryption'])) {
    //             $data['descryption_err'] = 'Description is required.';
    //         }

    //         // Check for errors
    //         if (empty($data['maxParticipants_err']) && empty($data['frequency_err']) && empty($data['categories_err']) && empty($data['descryption_err'])) {
    //             // Combine Step 1 and Step 2 data
    //             $step1Data = $_SESSION['event_step1'];
    //             $finalData = array_merge($step1Data, $data);

    //             // Save to the database
    //             if ($this->eventModel->createEvent($finalData)) {
    //                 // Clear session data
    //                 unset($_SESSION['event_step1']);

    //                 // Redirect to event list or success page
    //                 header("Location: /events");
    //                 exit;
    //             } else {
    //                 die("Something went wrong while saving the event.");
    //             }
    //         }
    //     }

    //     // Render the second step form with validation errors
    //     $_SESSION['event_step2_errors'] = $data;
    //     header("Location: /event/create-2");
    // }

//         public function register_1()
//     {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//             $data = [
//                 'eventName' => trim($_POST['eventName']),
//                 'frequency' => trim($_POST['frequency']),
//                 'maxParticipants' => trim($_POST['maxParticipants']),
//                 'description' => trim($_POST['description']),
//                 'userID' => $_SESSION['user_id'] // Assuming user session is managed
//             ];

//             $errors = [];

//             if (empty($data['eventName'])) $errors['eventName_err'] = 'Event name is required.';
//             if (empty($data['frequency'])) $errors['frequency_err'] = 'Frequency is required.';
//             if (empty($data['maxParticipants'])) $errors['maxParticipants_err'] = 'Max participants is required.';
//             if (empty($data['description'])) $errors['description_err'] = 'Description is required.';

//             if (empty($errors)) {
//                 $_SESSION['event_template'] = $data;
//                 header("Location: /event/form2");
//                 exit;
//             } else {
//                 $_SESSION['event_errors'] = $errors;
//                 header("Location: /event/form1");
//                 exit;
//             }
//         }

//         render('event/form1', []);
//     }

//     public function register_2()
//     {
//         if (!isset($_SESSION['event_template'])) {
//             header("Location: /event/form1");
//             exit;
//         }

//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//             $data = [
//                 'startDate' => trim($_POST['startDate']),
//                 'endDate' => trim($_POST['endDate']),
//                 'availablePlaces' => trim($_POST['availablePlaces']),
//                 'isActive' => isset($_POST['isActive']) ? 1 : 0
//             ];

//             $errors = [];

//             if (empty($data['startDate'])) $errors['startDate_err'] = 'Start date is required.';
//             if (empty($data['endDate'])) $errors['endDate_err'] = 'End date is required.';
//             if (empty($data['availablePlaces'])) $errors['availablePlaces_err'] = 'Available places are required.';

//             if (empty($errors)) {
//                 $templateData = $_SESSION['event_template'];

//                 $templateModel = new EventTemplate();
//                 $templateID = $templateModel->create($templateData);

//                 if ($templateID) {
//                     $data['templateID'] = $templateID;
//                     $instanceModel = new EventInstance();
//                     if ($instanceModel->create($data)) {
//                         unset($_SESSION['event_template']);
//                         header("Location: /event/success");
//                         exit;
//                     }
//                 }
//             } else {
//                 $_SESSION['event_errors'] = $errors;
//                 header("Location: /event/form2");
//                 exit;
//             }
//         }

//         render('event/form2', []);
//     }
// }
?>