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
</body>
