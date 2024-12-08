<?php
class UserController 
{

    public function signup(){
        $data=[
            'title'=>'Register'
        ];
        echo " routing is wokring";
    }
 
    public function UserAccount(){
        render('user/account');
    }

    public function UserEventHistory(){
        render('user/events-history');
    }
    public function UserProfileSettings(){
        render('user/profile-settings'); 
    }
    
}
?>