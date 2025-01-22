<body>
<div class="content-container">
<div class="profile-section">
        <!-- Combined Header -->
        <header class="combined-header">
            <div class="profile-header">
                <!-- Profile Picture -->
                <img src="../<?php echo $_SESSION['user_profile']['ProfileImage']; ?>" 
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
                        <?php 
                        // Show date of birth only if dobPublic is 1
                        echo ($_SESSION['user_profile']['dobPublic'] ?? 1) 
                            ? htmlspecialchars($_SESSION['user_profile']['DateOfBirth'] ?? 'Not Available') 
                            : 'Date of birth hidden';
                        ?>
                    </p>
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
            </div>

        </header>
    </div>
    <?php if (!empty($managedEvents)): ?>

    <!-- Events Section -->
    <section class="events-section">
    <h2 class="section-title">Managed <span class="highlight">Events</span></h2>
    <div class="events-container">
        <div class="events-grid">
            <?php foreach ($managedEvents as $event): ?>
                <article class="event-card">
                    <a href="/event/<?php echo $event['EventID']; ?>">
                        <img src="<?= htmlspecialchars($event['image1'] ?? 'default-image.jpg') ?>"
                             alt="<?= htmlspecialchars($event['EventName']) ?>"
                             class="event-image">
                        <h3 class="event-title"><?= htmlspecialchars($event['EventName']) ?></h3>
                        <div class="event-details">
                            <div class="event-info">
                                <time class="event-date"><?= htmlspecialchars($event['StartDate']) ?> - <?= htmlspecialchars($event['EndDate']) ?></time>
                                <address class="event-location"><?= htmlspecialchars($event['LocationName']) ?>, <?= htmlspecialchars($event['LocationAddress']) ?></address>
                            </div>
                            <div class="event-attendance">
                                <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                                <span class="attendance-count"><?= htmlspecialchars($event['AttendeesCount']) ?>/<?= htmlspecialchars($event['MaxParticipants']) ?></span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif ?>

<?php if (!empty($registeredEvents)): ?>
    <div class="spacer"></div>
<section class="events-section">
    <h2 class="section-title">Registered <span class="highlight">Events</span></h2>
    <div class="events-container">
        <div class="events-grid">
            <?php foreach ($registeredEvents as $event): ?>
                <article class="event-card">
                    <a href="/event/<?php echo $event['EventID']; ?>">
                        <img src="<?= htmlspecialchars($event['image2'] ?? 'default-image.jpg') ?>"
                             alt="<?= htmlspecialchars($event['EventName']) ?>"
                             class="event-image">
                        <h3 class="event-title"><?= htmlspecialchars($event['EventName']) ?></h3>
                        <div class="event-details">
                            <div class="event-info">
                                <time class="event-date"><?= htmlspecialchars($event['StartDate']) ?> - <?= htmlspecialchars($event['EndDate']) ?></time>
                                <address class="event-location"><?= htmlspecialchars($event['LocationName']) ?>, <?= htmlspecialchars($event['LocationAddress']) ?></address>
                            </div>
                            <div class="event-attendance">
                                <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                                <span class="attendance-count"><?= htmlspecialchars($event['AttendeesCount']) ?>/<?= htmlspecialchars($event['MaxParticipants']) ?></span>
                            </div>
                        </div>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif ?>

    <div class="spacer"></div>

</main>


</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentTheme = localStorage.getItem('theme') || 'light';

        // If the theme is dark, apply the dark mode class to body
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
</script>
</body>
<style>
    .spacer {
        height: 50px; /* Adjust the height as needed */
    }
</style>



