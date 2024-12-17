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
    public function deleteAccountByUsername($username) {
        // Assume you have a database connection (using PDO here for security)
        $db = Database::getInstance(); // Assuming you have a Database class for DB connection
        $query = "DELETE FROM users WHERE username = :username"; // Adjust the table name and field names if necessary

        // Prepare and execute the query
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute and return true if successful, false otherwise
        return $stmt->execute();
    }
    public function getUserByUsername($username) {
        // SQL query to fetch user data by Username
        $query = "SELECT 
                    UserID, Username, FirstName, LastName, Phone, DateOfBirth, Email, IsAdmin, IsBanned, 
                    phonePublic, dobPublic 
                  FROM users 
                  WHERE Username = :username LIMIT 1";
    
        try {
            // Prepare the SQL statement
            $stmt = $this->db->prepare($query);
    
            // Bind the :username parameter to the input value
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the user data as an associative array
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            // Return the user data if found, otherwise return false
            return $user ?: false;
        } catch (PDOException $e) {
            // Log any database errors
            error_log("Database error in getUserByUsername: " . $e->getMessage());
            return false;
        }
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
    public function updateProfile($username, $firstName, $lastName, $phone, $phoneVisibility, $dobVisibility) {
        // Sanitize input (ensure we are getting valid visibility values)
        $phoneVisibility = ($phoneVisibility === 'Public') ? 1 : 0;
        $dobVisibility = ($dobVisibility === 'Public') ? 1 : 0;

        // Database connection (using PDO)

        // SQL query to update user information and privacy settings in one go
        $sql = "UPDATE users 
                SET FirstName = :firstName, 
                    LastName = :lastName, 
                    Phone = :phone, 
                    phonePublic = :phonePublic, 
                    dobPublic = :dobPublic
                WHERE Username = :username";

        // Prepare the SQL statement
        $stmt = $this->db->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':phonePublic', $phoneVisibility, PDO::PARAM_INT);
        $stmt->bindParam(':dobPublic', $dobVisibility, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            return true;  // Return true if the update is successful
        }
        return false;  // Return false if the update fails
    }
    public function searchUsers($query = '') {
        if (empty($query)) {
            // If no query, return all users
            $sql = "SELECT username, firstName, lastName FROM users";
            $stmt = $this->db->prepare($sql);
        } else {
            // Search by username, firstName, or lastName
            $sql = "SELECT username, firstName, lastName
                    FROM users 
                    WHERE username LIKE :query 
                       OR firstName LIKE :query 
                       OR lastName LIKE :query";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function isFollowing($follower_id, $followed_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
        $stmt->bindParam(':follower_id', $follower_id);
        $stmt->bindParam(':followed_id', $followed_id);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Follow a user
    public function followUser($follower_id, $followed_id) {
        if (!$this->isFollowing($follower_id, $followed_id)) {
            $stmt = $this->db->prepare("INSERT INTO follows (follower_id, followed_id) VALUES (:follower_id, :followed_id)");
            $stmt->bindParam(':follower_id', $follower_id);
            $stmt->bindParam(':followed_id', $followed_id);
            return $stmt->execute();
        }
        return false;
    }

    // Unfollow a user
    public function unfollowUser($follower_id, $followed_id) {
        if ($this->isFollowing($follower_id, $followed_id)) {
            $stmt = $this->db->prepare("DELETE FROM follows WHERE follower_id = :follower_id AND followed_id = :followed_id");
            $stmt->bindParam(':follower_id', $follower_id);
            $stmt->bindParam(':followed_id', $followed_id);
            return $stmt->execute();
        }
        return false;
    }
    // Get the accounts the user follows
    public function getFollowed($userId) {
        $query = "SELECT u.UserID, u.Username, u.FirstName, u.LastName 
                FROM users u
                JOIN follows f ON u.UserID = f.followed_id 
                WHERE f.follower_id = :userId";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get the accounts following the user
    public function getFollowers($userId) {
        $query = "SELECT u.UserID, u.Username, u.FirstName, u.LastName 
                FROM users u
                JOIN follows f ON u.UserID = f.follower_id 
                WHERE f.followed_id = :userId";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get the accounts blocked by the user
    public function getBlocked($userId) {
        $query = "SELECT u.UserID, u.Username, u.FirstName, u.LastName 
                FROM users u
                JOIN blocks b ON u.UserID = b.blocked_id 
                WHERE b.blocker_id = :userId";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':userId', $userId, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    // BLOCK METHODS
    // Check if a user has blocked another user
    public function isBlocked($blocker_id, $blocked_id) {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM blocks WHERE blocker_id = :blocker_id AND blocked_id = :blocked_id");
        $stmt->bindParam(':blocker_id', $blocker_id);
        $stmt->bindParam(':blocked_id', $blocked_id);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Block a user
    public function blockUser($blocker_id, $blocked_id) {
        if (!$this->isBlocked($blocker_id, $blocked_id)) {
            $stmt = $this->db->prepare("INSERT INTO blocks (blocker_id, blocked_id) VALUES (:blocker_id, :blocked_id)");
            $stmt->bindParam(':blocker_id', $blocker_id);
            $stmt->bindParam(':blocked_id', $blocked_id);
            return $stmt->execute();
        }
        return false;
    }

    // Unblock a user
    public function unblockUser($blocker_id, $blocked_id) {
        if ($this->isBlocked($blocker_id, $blocked_id)) {
            $stmt = $this->db->prepare("DELETE FROM blocks WHERE blocker_id = :blocker_id AND blocked_id = :blocked_id");
            $stmt->bindParam(':blocker_id', $blocker_id);
            $stmt->bindParam(':blocked_id', $blocked_id);
            return $stmt->execute();
        }
        return false;
    }


    //SETTINGS METHODS
    public function getSettingsByUser($user_id) {
        $query = "SELECT * FROM settings WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSettings($user_id, $language, $dark_mode, $privacy, $notifications) {
        $query = "UPDATE settings SET language = :language, dark_mode = :dark_mode, privacy = :privacy, notifications = :notifications WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':language', $language);
        $stmt->bindParam(':dark_mode', $dark_mode);
        $stmt->bindParam(':privacy', $privacy);
        $stmt->bindParam(':notifications', $notifications);
        $stmt->execute();
    }
}