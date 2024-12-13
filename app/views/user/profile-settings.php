<body>
    <div class="profile-settings">

        <!-- Combined Header -->
        <header class="combined-header">
            <div class="profile-header">
                <img src="assets/images/profile-image.JPG" alt="Profile Picture" class="profile-picture">
                <div>
                    <!-- Display FirstName and LastName from session -->
                    <h1><?php echo $_SESSION['user']['FirstName'] . " " . $_SESSION['user']['LastName']; ?></h1>
                    <p class="email"><?php echo $_SESSION['user']['Email']; ?></p>
                </div>
            </div>
            <div class="page-header">
                <h1>Personal Information</h1>
                <p class="page-subheader">Configure your privacy</p>
            </div>

            <div class="follows-header">
                <img src="assets/images/follows-icon.svg" alt="Follows" class="follows-icon">
                <div class="followers">
                    <span class="label">Followers</span>
                    <br>
                    <span class="value">123</span> <!-- Replace with actual data if needed -->
                </div>
                <div class="followers">
                    <span class="label">Following</span>
                    <br>
                    <span class="value">123</span> <!-- Replace with actual data if needed -->
                </div>
            </div>
        </header>
    
        <!-- Profile Form -->
        <form class="profile-form" method="POST" action="/user/profile-update"> <!-- Assuming 'profile-update.php' handles the POST request -->
            <!-- Username and Email -->
            <div class="form-row">
                <label for="username">Username</label>
                <!-- Display Username from session -->
                <input type="text" id="username" value="<?php echo $_SESSION['user']['Username']; ?>" readonly>
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <!-- Display Email from session -->
                    <input type="email" id="email" value="<?php echo $_SESSION['user']['Email']; ?>" readonly>
                </div>
            </div>
    
            <!-- Name and Surname -->
            <div class="form-row">
                <label for="name">First Name</label>
                <div class="input-wrapper">
                    <!-- Display FirstName from session -->
                    <input type="text" id="first_name" name="first_name" value="<?php echo $_SESSION['user']['FirstName']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <label for="surname">Last Name</label>
                <div class="input-wrapper">
                    <!-- Display LastName from session -->
                    <input type="text" id="last_name" name="last_name" value="<?php echo $_SESSION['user']['LastName']; ?>" required>
                </div>
            </div>
    
            <!-- Phone Number and Date of Birth -->
            <div class="form-row">
                <label for="phone">Phone number</label>
                <div class="input-wrapper">
                    <!-- Display Phone from session -->
                    <input type="tel" id="phone" name="phone" value="<?php echo $_SESSION['user']['Phone']; ?>" required>
                    <select name="phone_public">
                        <option value="Private" <?php echo $_SESSION['user']['phonePublic'] == 0 ? 'selected' : ''; ?>>Private</option>
                        <option value="Public" <?php echo $_SESSION['user']['phonePublic'] == 1 ? 'selected' : ''; ?>>Public</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <label for="dob">Date of Birth</label>
                <div class="input-wrapper">
                    <!-- Display DateOfBirth from session -->
                    <input type="date" id="dob" name="dob" value="<?php echo $_SESSION['user']['DateOfBirth']; ?>" readonly>
                    <select name="dob_public">
                        <option value="Private" <?php echo $_SESSION['user']['dobPublic'] == 0 ? 'selected' : ''; ?>>Private</option>
                        <option value="Public" <?php echo $_SESSION['user']['dobPublic'] == 1 ? 'selected' : ''; ?>>Public</option>
                    </select>
                </div>
            </div>
    
            <!-- Save Button -->
            <button type="submit" class="save-button">Save</button>
        </form>
    </div>    
</body>
