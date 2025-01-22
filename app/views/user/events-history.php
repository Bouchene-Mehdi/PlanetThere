<body>
    <main class="events-history">
        <!-- Page Header -->
        <header class="page-header">
            <h1 class="page-title">History of Events</h1>
            <p class="page-subtitle">Take a look into the past!</p>
        </header>

        <!-- Your Registered Events -->
        <section class="events-section">
            <h2 class="section-title">Your Registered <span class="highlight">Events</span></h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($registeredEvents as $event): ?>
                        <a href="/event/<?= $event['EventID']; ?>" class="event-block">
                            <article class="event-card">
                                <img src="<?= $event['image1'] ?: 'assets/images/default-event.jpg'; ?>"
                                    alt="<?= htmlspecialchars($event['EventName']); ?>" class="event-image">
                                <h3 class="event-title"><?= htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?= date('l, F j, g:i A', strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?= htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                                        <span class="attendance-count"><?= $event['AttendeesCount'] - $event['AvailablePlaces']; ?>/<?= $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Events You Created -->
        <section class="events-section">
            <h2 class="section-title">Events you <span class="highlight">Created</span></h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($managedEvents as $event): ?>
                        <a href="/event/<?= $event['EventID']; ?>" class="event-block">
                            <article class="event-card">
                                <img src="<?= $event['image1'] ?: 'assets/images/default-event.jpg'; ?>"
                                    alt="<?= htmlspecialchars($event['EventName']); ?>" class="event-image">
                                <h3 class="event-title"><?= htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?= date('l, F j, g:i A', strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?= htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                                        <span class="attendance-count"><?= $event['AttendeesCount'] - $event['AvailablePlaces']; ?>/<?= $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </article>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>
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
