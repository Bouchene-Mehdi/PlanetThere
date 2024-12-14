


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
                    <p class="phone-number">
                        <?php 
                        echo ($_SESSION['user_profile']['phonePublic'] ?? 1) 
                            ? htmlspecialchars($_SESSION['user_profile']['Phone'] ?? 'Not Available') 
                            : 'Phone number hidden';
                        ?>
                    </p>
                    <!-- Date of Birth -->
                    <p class="dob">
                        <?php 
                        echo ($_SESSION['user_profile']['dobPublic'] ?? 1) 
                            ? htmlspecialchars($_SESSION['user_profile']['DateOfBirth'] ?? 'Not Available') 
                            : 'Date of birth hidden';
                        ?>
                    </p>
                </div>
            </div>
            <div class="profile-actions">
                <button class="follow-btn">Follow</button>
                <button class="block-btn">Block</button>
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


