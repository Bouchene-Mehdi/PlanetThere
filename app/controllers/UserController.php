<?php
require_once __DIR__ . '/../models/User.php';
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
    public function ShowSignup_1_form(){
        render('user/signup-1');
    }
    public function ShowSignup_2_form(){
        render('user/signup-2');
    }
    public function register_1() {
        // Initialize data with empty values and error messages
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirm_password' => '',
            'username_err' => '',
            'email_err' => '',
            'password_err' => '',
            'confirm_password_err' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['username'] = trim($_POST['username']);
            $data['email'] = trim($_POST['email']);
            $data['password'] = trim($_POST['password']);
            $data['confirm_password'] = trim($_POST['confirm_password']);

            // Validate username
            if (empty($data['username'])) {
                $data['username_err'] = 'Username is required.';
            }

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Email is required.';
            }

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Password is required.';
            }

            // Validate confirm password
            if ($data['password'] !== $data['confirm_password']) {
                $data['confirm_password_err'] = 'Passwords do not match.';
            }

            // Check if there are no errors
            if (empty($data['username_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                // Save data temporarily in session
                $_SESSION['page1_data'] = [
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'password' => $data['password'] // Storing password temporarily (hashed later)
                ];
                // Redirect to the second signup page
                
                header("Location: /signup-2");
                exit;
            }
        }
        $_SESSION['signup_errors'] = $data;
        // Render the first signup form with validation errors
        header("Location: /signup-1");
    }

    public function register_2() {
        // Check if page 1 data exists
        if (!isset($_SESSION['page1_data'])) {
            header("Location: /signup/page1");
            exit;
        }

        $data = [
            'first_name' => '',
            'last_name' => '',
            'phone' => '',
            'dob' => '',
            'first_name_err' => '',
            'last_name_err' => '',
            'phone_err' => '',
            'dob_err' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['first_name'] = trim($_POST['first_name']);
            $data['last_name'] = trim($_POST['last_name']);
            $data['phone'] = trim($_POST['phone']);
            $data['dob'] = trim($_POST['dob']);

            // Validate first name
            if (empty($data['first_name'])) {
                $data['first_name_err'] = 'First name is required.';
            }

            // Validate last name
            if (empty($data['last_name'])) {
                $data['last_name_err'] = 'Last name is required.';
            }

            // Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Phone number is required.';
            }

            // Validate date of birth
            if (empty($data['dob'])) {
                $data['dob_err'] = 'Date of birth is required.';
            }

            // If no errors, proceed to registration
            if (empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['phone_err']) && empty($data['dob_err'])) {
                // Combine page 1 and page 2 data
                $page1Data = $_SESSION['page1_data'];
                $finalData = array_merge($page1Data, $data);

                //Simulate user registration (replace this with actual logic)
                $userModel = new User();
                if ($userModel->register($finalData)) {
                    unset($_SESSION['page1_data']);
                    echo "Registration successful! and added to db";
                    exit;
                } else {
                    die("Something went wrong.");
                }

                //Temporary message for demonstration
                echo "Registration successful!";
                var_dump($finalData);

                unset($_SESSION['page1_data']); // Clear session
                exit;
            }
        }
        // Render the second signup form with validation errors
        $_SESSION['page2_errors'] = $data;
        header("Location: /signup-2");
    }
    public function login() {
        // Handle POST request for login
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get login data from the POST request
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
            ];

            // Validate inputs
            if (empty($data['email'])) {
                $_SESSION['login_errors']['email_err'] = 'Please enter your email.';
            }
            if (empty($data['password'])) {
                $_SESSION['login_errors']['password_err'] = 'Please enter your password.';
            }

            // If no errors, proceed with login
            if (empty($_SESSION['login_errors'])) {
                $userModel = new User();
                $user = $userModel->login($data['email'], $data['password']); // Verify credentials

                if (!$user) {
                    $_SESSION['login_errors']['login_err'] = 'Invalid email or password.';
                } else {
                    // Store user in session (successful login)
                    $_SESSION['user'] = $user;
                    echo "Login successful!";
                    // Redirect after successful login
                    header('Location: /');
                    exit();
                }
            }
            header('Location: /login');
            exit();
        }
    }
    // Show the login form   
    public function ShowLogin(){
        render('user/login');
    }
    
    
}
?>