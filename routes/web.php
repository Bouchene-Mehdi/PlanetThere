<?php
$routes=[
    'GET' => [
        '/' => 'PagesController@index',
        '/about' => 'PagesController@about',
        '/faq' => 'PagesController@faq',
        '/tac' => 'PagesController@TAC',
        '/event-history' => 'UserController@UserEventHistory',
        '/profile-settings' => 'UserController@UserProfileSettings',
        '/signup-1' => 'UserController@ShowSignup_1_form',
        '/signup-2' => 'UserController@ShowSignup_2_form',
        '/forgot-1' => 'UserController@ShowForgot_1',
        '/forgot-2' => 'UserController@ShowForgot_2',
        '/login' => 'UserController@ShowLogin',
        '/account' => 'UserController@UserAccount',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/dashboard' => 'AdminController@dashboard',
        '/admin' => 'AdminController@admin',
    ],

    'POST' => [
        '/user/register-1' => 'UserController@register_1',
        '/user/register-2' => 'UserController@register_2',
        '/login' => 'UserController@login',
        '/logout' => 'UserController@logout',
        '/user/forgot-password-1' => 'UserController@forgotPasswordStep1',
        '/user/forgot-password-2' => 'UserController@forgotPasswordStep2',
    ]
];
?>