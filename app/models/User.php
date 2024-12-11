<?php
class User {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Function to verify if a user exists by email or username
    public function verify($email, $username) {
        // Prepare the query to check if the email or username exists
        $query = 'SELECT * FROM users WHERE email = :email OR username = :username LIMIT 1';
        
        $stmt = $this->db->prepare($query);
        
        // Bind the parameters to the query
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':username', $username);
        
        // Execute the statement
        $stmt->execute();

        // If the query returns a row, the user exists
        if ($stmt->rowCount() > 0) {
            return true; // User exists
        }

        return false; // User does not exi  st
    }
    public function verifyEmail($email) {
        $query = 'SELECT * FROM users WHERE email = :email LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        // Fetch user data, if exists
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? $user : null; // If user exists, return data; otherwise, return null
    }

    // Verify if the password is correct
    public function checkPassword($userPassword, $inputPassword) {
        return password_verify($inputPassword, $userPassword); // Compare hashed password with input password
    }
    // Function to register a new user
    public function register($data) {
        // Prepare the query to insert a new user into the database
        $query = 'INSERT INTO users (username, email, PasswordHash , FirstName, LastName, Phone, DateofBirth) 
                  VALUES (:username, :email, :password, :first_name, :last_name, :phone, :dob)';
        
        $stmt = $this->db->prepare($query);
        
        // Bind parameters to the query
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', password_hash($data['password'], PASSWORD_DEFAULT)); // Hash password
        $stmt->bindParam(':first_name', $data['first_name']);
        $stmt->bindParam(':last_name', $data['last_name']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':dob', $data['dob']);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // User registered successfully
        }

        return false; // Registration failed
    }
    public function login($email, $password) {
        // Check if the username exists
        $user = $this->verifyEmail($email);

        if ($user) {
            // If username exists, check if the password matches
            if ($this->checkPassword($user['PasswordHash'], $password)) {
                return $user; // Successful login, return user data 
            
            } else {
                error_log("This is an error in password");

                return null; // Incorrect password
            }
        }
                error_log("This is an error in email");

        
        return null; // Username not found
    }
    public function savePasswordResetToken($userId, $token) {
        $query = 'UPDATE users SET reset_token = :token, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE UserID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    public function getUserIdByResetToken($token) {
        $query = 'SELECT UserID FROM users WHERE reset_token = :token AND token_expiry > NOW() LIMIT 1';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    
    public function updatePassword($userId, $hashedPassword) {
        $query = 'UPDATE users SET PasswordHash = :password WHERE UserID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
    public function invalidateResetToken($userId) {
        $query = 'UPDATE users SET reset_token = NULL, token_expiry = NULL WHERE UserID = :id';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $userId);
        return $stmt->execute();
    }
    
}