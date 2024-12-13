<?php
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
}
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