<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
class PagesController 
{
    public function index()
    {
        $database= Database::getInstance();
        $conn=$database->getConnection();

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
        render('home/index',
        [
            'upcomingEvents' => $upcomaingEvents,
            'popularEvents' => $popularEvents,
            'stayfitEvents' => $stayfitEvents
        ]);
    }
    public function about()
    {
        render('about/index');
    }
    public function faq()
    {
        render('faq/index');
    }
    public function TAC()
    {
        render('TAC/index');
    }


}   