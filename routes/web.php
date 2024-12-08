<?php
$routes=[
    'GET' => [
        '/' => 'PagesController@index',
        '/about' => 'PagesController@about',
        '/faq' => 'PagesController@faq',
        '/tac' => 'PagesController@TAC',
        '/event-history' => 'UserController@UserEventHistory',
        '/profile-settings' => 'UserController@UserProfileSettings',
        '/account' => 'UserController@UserAccount',
        '/contact' => 'HomeController@contact',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/dashboard' => 'AdminController@dashboard',
        '/admin' => 'AdminController@admin',
        '/signup' => 'UserController@signup',
    ],

    'POST' => [
        '/register' => 'UserController@register',
        '/login' => 'UserController@loginUser',
        '/logout' => 'UserController@logout',
    ]
];
?>