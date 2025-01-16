<?php
require_once __DIR__ . '/../app/core/Router.php';
$router= new Route();

// GET routes
$router->get('/', 'PagesController@index');
$router->get('/about', 'PagesController@about');
$router->get('/faq', 'PagesController@faq');
$router->get('/tac', 'PagesController@TAC');
$router->get('/event-history', 'UserController@UserEventHistory');
$router->get('/profile-settings', 'UserController@UserProfileSettings');
$router->get('/signup-1', 'UserController@ShowSignup_1_form');
$router->get('/signup-2', 'UserController@ShowSignup_2_form');
$router->get('/forgot-1', 'UserController@ShowForgot_1');
$router->get('/forgot-2', 'UserController@ShowForgot_2');
$router->get('/login', 'UserController@ShowLogin');
$router->get('/profile', 'UserController@ShowProfile');
$router->get('/profile/{username}', 'UserController@showUserProfileByUsername');
$router->get('/log-out', 'UserController@logout');
$router->get('/blocked','UserController@ShowBlockScreen');
$router->get('/unauthorized','UserController@ShowUnauthorizedScreen');
$router->get('/delete-account', 'UserController@deleteAccount');
$router->get('/account', 'UserController@UserAccount');
$router->get('/user-search', 'UserController@ShowUserSearch');
$router->get('/settings', 'UserController@ShowUserSettings');
$router->get('/friends', 'UserController@ShowFriends');
$router->get('/user/register', 'UserController@showRegisterForm');
$router->get('/user/login', 'UserController@showLoginForm');
$router->get('/createAcc', 'UserController@ShowCreateAcc');
$router->get('/event-search', 'EventController@ShowEventSearch');
$router->get('/create-event1', 'EventController@ShowEventCreate1');
$router->get('/create-event2', 'EventController@ShowEventCreate2');
$router->get('/event/{eventID}', 'EventController@ShowEventDetails');
$router->get('/event-attendees/{eventID}', 'EventController@ShowEventAttendees');
$router->get('/event-waitlist/{eventID}', 'EventController@ShowEventWaitlist');
$router->get('/AdminEvent', 'AdminController@ShowEventList');
$router->get('/AdminUsers', 'AdminController@ShowUserList');
$router->get('/AdminBanned', 'AdminController@ShowBanned');
$router->get('/AdminPropositions', 'AdminController@ShowPropositions');
$router->get('/Dashboard', 'AdminController@ShowDashboard');
$router->get('/AdminFaq', 'AdminController@ShowFaq');
$router->get('/AdminT', 'AdminController@ShowTAC');
// POST routes
$router->post('/user/register-1', 'UserController@register_1');
$router->post('/user/register-2', 'UserController@register_2');
$router->post('/login', 'UserController@login');
$router->post('/logout', 'UserController@logout');
$router->post('/user/forgot-password-1', 'UserController@forgotPasswordStep1');
$router->post('/user/forgot-password-2', 'UserController@forgotPasswordStep2');
$router->post('/user/profile-update', 'UserController@updateProfile');
$router->post('/user/search', 'UserController@postUserSearch');
$router->post('/user/toggleFollow/{targetUserId}', 'UserController@toggleFollow');
$router->post('/user/toggleBlock/{targetUserId}', 'UserController@toggleBlock');
$router->post('/event/create-1', 'EventController@createEventStep1');
$router->post('/event/create-2', 'EventController@createEventStep2');
$router->post('/event/search', 'EventController@postEventSearch');
$router->post('/event/register/{eventID}', 'EventController@RegisterForEvent');
$router->post('/event/waitlist/{eventID}', 'EventController@WaitlistForEvent');
$router->post('/event/edit/{eventID}', 'EventController @EditEvent');
$router->post('/event/unwaitlist/{eventID}', 'EventController@UnwaitlistForEvent');
$router->post('/event/unregister/{eventID}', 'EventController@UnregisterForEvent');
$router->post('/event/removeAttendee', 'EventController@RemoveAttendee');
$router->post('/event/delete/{eventID}', 'EventController@DeleteEvent');
$router->post('/event/removeWaitlister', 'EventController@RemoveWaitlister');
$router->post('/event/review', 'EventController@submitEventReview');
$router->post('/home/index.php', 'PagesController@postEventSearch');
$router->post('/ban/{userid}', 'AdminController@BanUser');
$router->post('/unban/{userid}', 'AdminController@UnbanUser');
$router->post('/moveToProp/{eventid}', 'AdminController@MoveToPropositions');
$router->post('/acceptProposition/{eventid}', 'AdminController@makeActive');
$router->post('/AdminFaq/Add', 'AdminController@AddFaq');
$router->post('/AdminFaq/Delete/{faqID}', 'AdminController@DeleteFaq');
$router->post('/AdminT/Add', 'AdminController@AddTac');
$router->post('/AdminT/Delete/{tacID}', 'AdminController@DeleteTac');



?>