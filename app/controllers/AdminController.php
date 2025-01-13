<?php
require_once __DIR__ . '/../models/Event.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/User.php';
class AdminController
{
    public function ShowEventList()
    {
        render('admin/eventlist',[],'admin/layout');
    }
    public function ShowUserList()
    {
        render('admin/userlist',[],'admin/layout');
    }
    public function ShowBanned(){
        render('admin/bannedusers',[],'admin/layout');
    }
    public function ShowPropositions(){
        render('admin/eventproposition',[],'admin/layout');
    }
    public function ShowDashboard(){
        render('admin/dashboard',[],'admin/layout');
    }

}