<?php
$routes=[
    'GET' => [
        '/' => 'PagesController@index',
        '/about' => 'PagesController@about',
        '/faq' => 'PagesController@faq',
        '/tac' => 'PagesController@TAC',
        '/event-history' => 'UserController@UserEventHistory',
        '/profile-settings' => 'UserController@UserProfileSettings',
        '/signup-1' => 'UserController@UserSignup_1',
        '/signup-2' => 'UserController@UserSignup_2',
        '/login' => 'UserController@UserLogin',
        '/account' => 'UserController@UserAccount',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/dashboard' => 'AdminController@dashboard',
        '/admin' => 'AdminController@admin',
    ],

    'POST' => [
        '/register' => 'UserController@register',
        '/login' => 'UserController@loginUser',
        '/logout' => 'UserController@logout',
    ]
];
?>