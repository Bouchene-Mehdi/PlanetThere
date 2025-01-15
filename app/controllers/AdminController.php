<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Faq.php';
require_once __DIR__ . '/../models/Tac.php';
class AdminController
{
    public function ShowEventList()
    {
        $evenModel = new Event();
        $events = $evenModel->getAllActiveEvents();
        render('admin/eventlist',[
            'events' => $events
        ],'admin/layout');
    }
    public function RemoveEvent($eventid){
        $eventModel = new Event();
        $eventModel->makeUnactive($eventid);
        header('Location: /AdminEvent');
    }
    public function ShowUserList()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']==0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $userModel = new User();
        $users = $userModel->getAllActiveUsers();
        render('admin/userlist',[
            'users' => $users
        ],'admin/layout');
    }
    public function BanUser($userid){
        $userModel = new User();
        $userModel->BanUser($userid);
        header('Location: /AdminUsers');
    }
    public function UnbanUser($userid){
        $userModel = new User();
        $userModel->UnbanUser($userid);
        header('Location: /AdminBanned');
    }
    public function ShowBanned(){
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']==0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $userModel = new User();
        $users = $userModel->getAllBannedUsers();
        render('admin/bannedusers',[
            'users' => $users
        ],'admin/layout');
    }
    public function ShowPropositions(){
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']==0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $evenModel = new Event();
        $events = $evenModel->getAllPropositions();
        render('admin/eventproposition',[
            'events' => $events
        ],'admin/layout');
    }
    public function makeActive($eventid){
        $eventModel = new Event();
        $eventModel->makeActive($eventid);
        header('Location: /AdminPropositions');
    }
    public function ShowDashboard(){
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']== 0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $data=[];
        $eventModel= new Event();
        $userModel= new User();
        $faqModel= new Faq();
        $data['eventCount']=$eventModel->ActiveEventCount();
        $data['userCount']=$userModel->UserCount();
        $data['bannedCount']=$userModel->BannedCount();
        $data['adminCount']=$userModel->AdminCount();
        $data['propositionCount']=$eventModel->PropositionCount();
        $data['faqCount']=$faqModel->FaqCount();
        render('admin/dashboard',[
            'data' => $data
        ],'admin/layout');
    }
    public function MoveToPropositions($eventid){
        $eventModel = new Event();
        $eventModel->makeUnactive($eventid);
        header('Location: /AdminEvent');
    }
    public function moveAccept($eventid){
        $eventModel = new Event();
        $eventModel->makeActive($eventid);
        header('Location: /AdminPropositions');
    }
    public function ShowFaq() {
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']==0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $faqModel = new Faq();
        $faqs = $faqModel->getAllFaqs();
        render('admin/faq', [
            'faqs' => $faqs
        ], 'admin/layout');
    }
    
    public function AddFaq() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $question = $_POST['question'];
            $answer = $_POST['answer'];
    
            $faqModel = new Faq();
            $faqModel->addFaq($question, $answer);
            header('Location: /AdminFaq');
        } else {
            render('admin/addfaq', [], 'admin/layout');
        }
    }
    public function DeleteFaq($faqID) {
        $faqModel = new Faq();
        $faqModel->deleteFaq($faqID);
        header('Location: /AdminFaq');
    }
    public function ShowTAC(){
        if (isset($_SESSION['user']) && $_SESSION['user']['IsAdmin']==0 ) {
            header('Location: /unauthorized');
            exit();
        }
        $tacModel = new Tac();
        $tacs = $tacModel->getAllTacs();
        render('admin/tac', [
            'tacs' => $tacs
        ], 'admin/layout');
    }
    public function AddTac(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $condition = $_POST['condition'];
            $detail = $_POST['detail'];
            $tacModel = new Tac();
            $tacModel->addTac($condition, $detail);
            header('Location: /AdminT');
        } else {
            render('admin/addtac', [], 'admin/layout');
        }

    }
    public function DeleteTac($tacID){
        $tacModel = new Tac();
        $tacModel->deleteTac($tacID);
        header('Location: /AdminT');
    }

}