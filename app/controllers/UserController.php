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
    
    public function UserSignup_1(){
        render('user/signup-1');
    }
    public function UserSignup_2(){
        render('user/signup-2');
    }
    public function UserLogin(){
        render('user/login');
    }
}
?>