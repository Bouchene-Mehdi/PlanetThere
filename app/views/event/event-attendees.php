<body>
    <div class="attendees-page">
        <!-- Page Header -->
        <header class="attendees-header">
            <h1>Event Attendee List</h1>
        </header>

        <!-- Attendee List -->
        <section class="attendees-list">
            <?php foreach ($attendees as $attendee): ?>
                <div class="profile-card">
                    <img src="../<?= htmlspecialchars($attendee['ProfileImage']); ?>" alt="Profile Picture" class="profile-pic">
                    <h2><?= htmlspecialchars($attendee['Username']); ?></h2>
                    <p><?= htmlspecialchars($attendee['FirstName']) . ' ' .htmlspecialchars($attendee['LastName']); ?></p>
                    <form action="/event/removeAttendee" method="POST">
                        <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                        <input type="hidden" name="user_id" value="<?= $attendee['UserID']; ?>">
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</body>
