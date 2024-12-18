<?php
class PagesController 
{
    public function index()
    {
        $database= Database::getInstance();
        $conn=$database->getConnection();
        render('home/index');
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

    public function kavi($id)
    {
        echo "im here ". $id;
    }
}   