
<body>
    <div class="attendees-page">
        <!-- Page Header -->
        <header class="attendees-header">
            <h1>Event Waitlist</h1>
        </header>

        <!-- Attendee List -->
        <section class="attendees-list">
            <?php foreach ($waitlisters as $waitlister): ?>
                <div class="profile-card">
                    <img src="../<?= htmlspecialchars($waitlister['ProfileImage']); ?>" alt="Profile Picture" class="profile-pic">
                    <h2><?= htmlspecialchars($waitlister['Username']); ?></h2>
                    <p><?= htmlspecialchars($waitlister['FirstName']) . ' ' .htmlspecialchars($waitlister['LastName']); ?></p>
                    <form action="/event/removeWaitlister" method="POST">
                        <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                        <input type="hidden" name="user_id" value="<?= $waitlister['UserID']; ?>">
    
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const logo = document.getElementById('logo'); // Access the logo image
            

            // If the theme is dark, apply the dark mode class to body
            if (currentTheme === 'dark') {
                document.body.classList.add('dark-mode');
                logo.src = '/assets/images/logo-text-white.svg';
                
            } else {
                document.body.classList.remove('dark-mode');
                logo.src = 'assets/images/logo-text.svg';
                

            }
        });
    </script>
</body>
