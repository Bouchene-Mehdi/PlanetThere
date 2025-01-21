    <!--Index.php-->
    <main class="homepage">

        <!-- Notification Banner -->
        <div id="event-notification">
            <span id="notification-text"></span>
            <button id="close-notification" style="margin-left: 20px; background-color: transparent; border: none; color: #721c24; font-weight: bold; cursor: pointer;">X</button>
        </div>
        <!-- Hero Section -->
        <section class="hero-section">
            <h2 class="hero-title">
                THE PLANET IS YOURS <br />
                PLAN IT FREE <br />
                PLAN IT THERE
            </h2>
            <!-- Search Section -->
            <section class="search-section">

                <form class="search-form" method="POST" action="/event/search">

                    <div class="search-field">
                        <label for="event-category" class="search-label">Category</label>
                            <div class="search-specific" id="event-category-dropdown">
                            <span class="dropdown-title">Choose event category</span>
                            <img src="assets/images/dropdown-icon.svg" alt="Dropdown" class="dropdown-icon" />
                            <input type="hidden" name="event-category" id="event-category" />

                            <ul class="dropdown-options hidden" id="event-category-options">
                                <?php
                                    foreach ($categories as $category) {
                                        echo "<li class='dropdown-option'>" . htmlspecialchars($category['CategoryName']) . "</li>";
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="search-field">
                        <label for="from" class="search-label">From</label>
                        <input type="date" id="from-date" name="from-date" value="<?= isset($fromDate) ? $fromDate : '' ?>">

                    </div>

                    <div class="search-field">
                        <label for="to" class="search-label">To</label>

                            <input type="date" id="to-date" name="to-date" value="<?= isset($toDate) ? $toDate : '' ?>">

                    </div>

                    <button type="submit" class="search-btn" href="#">
                        <img src="assets/images/search-btn-icon.svg" alt="Search" class="search-btn-icon" />
                    </button>
                </form>
            </section>
        </section>

        <!-- Upcoming Events Section -->
        <section class="events-section">
            <h2 class="section-title">
                Upcoming <span class="highlight">Events</span>
            </h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($upcomingEvents as $event): ?>
                        <article class="event-card">
                            <a href="/event/<?php echo $event['EventID']; ?>">
                                <img src="<?php echo $event['image1']; ?>" alt="<?php echo htmlspecialchars($event['EventName']); ?>" class="event-image" />
                                <h3 class="event-title"><?php echo htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?php echo date("l, F j, Y g:i A", strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?php echo htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon" />
                                        <span class="attendance-count"><?php echo $event['AttendeesCount']; ?>/<?php echo $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php if (!empty($followersEvents)): ?>
            <section class="events-section">
            <h2 class="section-title">
                People <span class="highlight">You Follow</span>
            </h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($followersEvents as $event): ?>
                        <article class="event-card">
                            <a href="/event/<?php echo $event['EventID']; ?>">
                                <img src="<?php echo $event['image1']; ?>" alt="<?php echo htmlspecialchars($event['EventName']); ?>" class="event-image" />
                                <h3 class="event-title"><?php echo htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?php echo date("l, F j, Y g:i A", strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?php echo htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon" />
                                        <span class="attendance-count"><?php echo $event['AttendeesCount']; ?>/<?php echo $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php endif; ?>
        <section class="create-event-section">
            <div class="create-event-container">
                <div class="create-event-image">
                    <img
                        src="assets/images/create-event-img.png"
                        alt="Create your own event"
                        class="create-event-img"
                    />
                </div>
                <div class="create-event-content">
                    <div class="create-event-text">
                        <h2 class="create-event-title">
                            Couldn't find anything for you?
                        </h2>
                        <p class="create-event-subtitle">Create your own event</p>
                        <a class="create-event-btn" href="/create-event1">
                            <span class="create-event-btn-text">Create Events</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Popular Now Section -->
        <section class="events-section">
            <h2 class="section-title">
                Popular <span class="highlight">Now</span>
            </h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($popularEvents as $event): ?>
                        <article class="event-card">
                            <a href="/event/<?php echo $event['EventID']; ?>">
                                <img src="<?php echo $event['image1']; ?>" alt="<?php echo htmlspecialchars($event['EventName']); ?>" class="event-image" />
                                <h3 class="event-title"><?php echo htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?php echo date("l, F j, Y g:i A", strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?php echo htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon" />
                                        <span class="attendance-count"><?php echo $event['AttendeesCount']; ?>/<?php echo $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>

        </section>

        <!-- Stay Fit Section -->
        <section class="events-section">
            <h2 class="section-title">
                Stay <span class="highlight">Fit</span>
            </h2>
            <div class="events-container">
                <div class="events-grid">
                    <?php foreach ($stayfitEvents as $event): ?>
                        <article class="event-card">
                            <a href="/event/<?php echo $event['EventID']; ?>">
                                <img src="<?php echo $event['image1']; ?>" alt="<?php echo htmlspecialchars($event['EventName']); ?>" class="event-image" />
                                <h3 class="event-title"><?php echo htmlspecialchars($event['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?php echo date("l, F j, Y g:i A", strtotime($event['StartDate'])); ?></time>
                                        <address class="event-location"><?php echo htmlspecialchars($event['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon" />
                                        <span class="attendance-count"><?php echo $event['AttendeesCount']; ?>/<?php echo $event['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <div class="spacer"></div>


    </main>

    <style>
        .spacer {
            height: 50px; /* Adjust the height as needed */
        }
    </style>

    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const dropdown = document.getElementById("event-category-dropdown");
        const options = document.getElementById("event-category-options");
        const categoryTitle = dropdown.querySelector(".dropdown-title");
        const eventCategoryInput = document.getElementById("event-category");

        // Toggle dropdown visibility
        dropdown.addEventListener("click", () => {
            options.classList.toggle("hidden");
        });

        // Handle option selection
        options.addEventListener("click", (event) => {
            if (event.target.classList.contains("dropdown-option")) {
                // Set the category title and hidden input value
                categoryTitle.textContent = event.target.textContent;
                categoryTitle.style.color = "#333";  // Change color after selection
                eventCategoryInput.value = event.target.textContent;  // Update hidden input
                options.classList.add("hidden");  // Close dropdown
            }
            event.stopPropagation(); // Prevent event bubbling
        });

        // Close dropdown if clicked outside
        document.addEventListener("click", (event) => {
            if (!dropdown.contains(event.target) && !options.contains(event.target)) {
                options.classList.add("hidden");
            }
        });
    });

    </script>


    <?php if (isset($registeredEvents) && !empty($registeredEvents)): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let events = <?= json_encode($registeredEvents) ?>;
                let eventNames = events.map(event => "&quot;" + event.EventName + "&quot; on " + new Date(event.StartDate).toLocaleDateString()).join("<br/>");

                // Display the event names in the notification banner
                let notificationBanner = document.getElementById('event-notification');
                let notificationText = document.getElementById('notification-text');
                notificationText.innerHTML = "You have the following events in the next 2 days.<br/>Go to your History of Events to browse them:<br/>" + eventNames;
                notificationBanner.style.display = 'block';

                // Add close functionality
                let closeButton = document.getElementById('close-notification');
                closeButton.addEventListener('click', function() {
                    notificationBanner.style.display = 'none';
                });
            });
        </script>
    <?php endif; ?>


