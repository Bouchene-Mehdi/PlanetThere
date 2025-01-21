<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Faq.php';
require_once __DIR__ . '/../models/Tac.php';
class PagesController 
{
    public function index()
    {
        $database= Database::getInstance();
        $conn=$database->getConnection();
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $followersEvents = [];
        $registeredEvents = [];
        $eventModel = new Event();
        $upcomaingEvents = $eventModel->get_5_UpcomingEvents();
        $popularEvents = $eventModel->get_5_PopularEvents();
        $stayfitEvents = $eventModel->get_5_StayFitEvents();
        // i want to add the occupied places to the event
        foreach ($upcomaingEvents as $key => $event) {
            $upcomaingEvents[$key]['AttendeesCount'] = $eventModel->getAttendanceCount($event['EventID']);
        }
        foreach ($popularEvents as $key => $event) {
            $popularEvents[$key]['AttendeesCount'] = $eventModel->getAttendanceCount($event['EventID']);
        }
        foreach ($stayfitEvents as $key => $event) {
            $stayfitEvents[$key]['AttendeesCount'] = $eventModel->getAttendanceCount($event['EventID']);
        }
        if(isset($_SESSION['user'])){
            $followersEvents = $eventModel->get_5_FollowersEvents();
            foreach ($followersEvents as $key => $event) {
                $followersEvents[$key]['AttendeesCount'] = $eventModel->getAttendanceCount($event['EventID']);
            }
            $registeredEvents = $eventModel -> getUpcomingEventsForUser($_SESSION['user']['UserID']);
        }


        render('home/index',
        [
            'upcomingEvents' => $upcomaingEvents,
            'popularEvents' => $popularEvents,
            'stayfitEvents' => $stayfitEvents,
            'categories' => $categories,
            'followersEvents' => $followersEvents,
            'registeredEvents' => $registeredEvents

        ]);
    }
    public function about()
    {
        render('about/index');
    }
    public function faq()
    {
        $faqModel = new Faq();
        $faqs = $faqModel->getAllFaqs();
        render('faq/index',['faqs' => $faqs]);
    }
    public function TAC()
    {
        $tacModel = new Tac();
        $tacs = $tacModel->getAllTacs();
        render('TAC/index',['tacs' => $tacs]);
    }

    public function postEventSearch()
    {
        $database = Database::getInstance();
        $conn = $database->getConnection();
        $categoryModel = new Category();
        $categories = $categoryModel->getAllCategories();
        $eventModel = new Event();

        // Fetch search parameters from POST request
        $searchQuery = '';  // You can extend this if you want to include a search query field
        $selectedCategory = $_POST['event-category'] ?? '';
        $fromDate = $_POST['from-date'] ?? '';
        $toDate = $_POST['to-date'] ?? '';
        print_r($selectedCategory);
        print_r($fromDate);
        print_r($toDate);

        // Get events based on the filters
        $events = $eventModel->searchEvents($searchQuery, $selectedCategory, $fromDate, $toDate);

        // Render the search results page with the events and search parameters
        render('event/event-search', [
            'events' => $events,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
        ]);
    }


}   