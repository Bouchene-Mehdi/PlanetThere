


<div class="content-container">
<div class="profile-section">
        <!-- Combined Header -->
        <header class="combined-header">
            <div class="profile-header">
                <!-- Profil e Picture -->
                <img src="../assets/images/profile-image.JPG" 
                     alt="Profile Picture" 
                     class="profile-picture">
                <div class="profile-text">
                    <!-- Username -->
                    <h1><?php echo htmlspecialchars($_SESSION['user_profile']['Username'] ?? 'Unknown'); ?></h1>
                    <!-- Full Name -->
                    <p class="name"><?php 
                        echo htmlspecialchars(
                            ($_SESSION['user_profile']['FirstName'] ?? 'Not Available') . ' ' . 
                            ($_SESSION['user_profile']['LastName'] ?? 'Not Available')
                        ); 
                    ?></p>
                    <!-- Email -->
                    <p class="email"><?php echo htmlspecialchars($_SESSION['user_profile']['Email'] ?? 'Not Available'); ?></p>
                    <!-- Phone -->
                    <!-- Phone -->
                    <p class="phone-number">
                        <?php 
                        // Show phone number only if phonePublic is 1
                        echo ($_SESSION['user_profile']['phonePublic'] ?? 1) 
                            ? htmlspecialchars($_SESSION['user_profile']['Phone'] ?? 'Not Available') 
                            : 'Phone number hidden';
                        ?>
                    </p>
                    <!-- Date of Birth -->
                    <p class="dob">
                        <style>
                            .dob {
                                color: #009688;
                                padding-left: 10px;
                            }
                        </style>
                        <?php 
                        // Show date of birth only if dobPublic is 1
                        echo ($_SESSION['user_profile']['dobPublic'] ?? 1) 
                            ? htmlspecialchars($_SESSION['user_profile']['DateOfBirth'] ?? 'Not Available') 
                            : 'Date of birth hidden';
                        ?>
                    </p>
                </div>
            </div>
            <div class="profile-actions">
                <?php if ($_SESSION['user']['Username'] !== $_SESSION['user_profile']['Username']): ?>

                    <!-- Follow / Unfollow Form -->
                    <form method="POST" action="/user/toggleFollow/<?php echo $_SESSION['user_profile']['UserID']; ?>" >
                    
                        <input type="hidden" name="user_to_follow" value="<?php echo $_SESSION['user_profile']['Username']; ?>">
                        <button type="submit" name="toggle_follow" class="follow-btn">
                            <?php 
                            // Display text based on isFollowing session variable
                            if (isset($_SESSION['isFollowing']) && $_SESSION['isFollowing']) {
                                echo 'Unfollow';  // User is following, so show 'Unfollow'
                            } else {
                                echo 'Follow';  // User is not following, so show 'Follow'
                            }
                            ?>
                        </button>
                    </form>
                    <form action="/user/toggleBlock/<?php echo $_SESSION['user_profile']['UserID']; ?>" method="POST">
                        <button type="submit" class="block-btn">
                            <?php 
                            if (isset($_SESSION['isBlocked']) && $_SESSION['isBlocked']) {
                                echo 'Unblock';
                            } else {
                                echo 'Block';
                            }
                            ?>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </header>
    </div>

    <!-- Events Section -->
    <section class="events-section">
        <h2 class="section-title">Managed <span class="highlight">Events</span></h2>
        <div class="events-container">
            <div class="events-grid">
                <!-- Event Card Template -->
                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <!-- More event cards can go here -->

            </div>

        </div>
        <button class="load-more-btn">Load more...</button>
    </section>


    <!-- Events Section -->
    <section class="events-section">
        <h2 class="section-title">Attended <span class="highlight">Events</span></h2>
        <div class="events-container">
            <div class="events-grid">
                <!-- Event Card Template -->
                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <article class="event-card">
                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc499bbedf0609ec93762b52772d6626357fbaeb3d229e969a33301555d08f3b"
                         alt="Language Exchange Picnic" class="event-image">
                    <h3 class="event-title">Language Exchange Picnic - Let's Practice Together</h3>
                    <div class="event-details">
                        <div class="event-info">
                            <time class="event-date">Friday, October 18, 6.00 PM</time>
                            <address class="event-location">Tuilieres Garden, Paris</address>
                        </div>
                        <div class="event-attendance">
                            <img src="../assets/images/attendance-icon.svg"
                                 alt="Attendees" class="attendance-icon">
                            <span class="attendance-count">18/20</span>
                        </div>
                    </div>
                </article>

                <!-- More event cards can go here -->

            </div>

        </div>
        <button class="load-more-btn">Load more...</button>
    </section>
</div>


