<main class="homepage">
    <!-- Hero Section -->
    <section class="hero-section">
        <h2 class="hero-title">
            THE PLANET IS YOURS <br />
            PLAN IT FREE <br />
            PLAN IT THERE
        </h2>

        <!-- Search Section -->
        <section class="search-section">
            <form class="search-form">
                    
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
    // Focus on the input fields automatically when the page loads
    const fromDateInput = document.getElementById("from-date");
    const toDateInput = document.getElementById("to-date");
    const eventCategoryInput = document.getElementById("event-category");

    if (fromDateInput) {
        fromDateInput.focus();
    }
    if (toDateInput) {
        toDateInput.focus();
    }

    if (eventCategoryInput) {
        eventCategoryInput.focus();
    }

    // if 


    const dropdown = document.getElementById("event-category-dropdown");
    const options = document.getElementById("event-category-options");
    const categoryTitle = dropdown.querySelector(".dropdown-title");

    // Toggle dropdown visibility
    dropdown.addEventListener("click", () => {
        options.classList.toggle("hidden");
    });

    // Handle option selection
    options.addEventListener("click", (event) => {
        if (event.target.classList.contains("dropdown-option")) {
            categoryTitle.textContent = event.target.textContent;
            categoryTitle.style.color = "#333";
            options.classList.add("hidden");
        }
        event.stopPropagation(); 
    });

    // Close dropdown if clicked outside
    document.addEventListener("click", (event) => {
        if (!dropdown.contains(event.target) && !options.contains(event.target)) {
            options.classList.add("hidden");
        }
    });
});
</script>


