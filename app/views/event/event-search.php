<body>
<main class="event-search-page">
    <div class="event-search-container">
        <!-- Filters Section -->
        <aside class="filters">
        <form method="POST" action="/event/search">
                <div class="looking-for">
                    <label for="looking-for">What are you looking for?</label>
                    <input type="text" id="looking-for" name="search_query" placeholder="Search here..." value="<?php echo htmlspecialchars($_SESSION['searchQuery_event'] ?? ''); ?>">
                </div> 

                <div class="category">
                    <label for="event-category">Category</label>
                    <div class="category-dropdown" id="event-category-dropdown">
                        <span class="dropdown-title"><?= htmlspecialchars($selectedCategory) ?: 'Choose event category' ?></span>
                        <input type="hidden" name="event-category" id="event-category" value="<?= htmlspecialchars($selectedCategory) ?>" />
                        <ul class="dropdown-options hidden" id="event-category-options">
                            <li class="dropdown-option" data-value="">All Categories</li>
                            <?php 
                                foreach ($categories as $category) {
                                    $isSelected = ($category['CategoryName'] === $selectedCategory) ? 'selected' : '';
                                    echo "<li class='dropdown-option $isSelected'>" . htmlspecialchars($category['CategoryName']) . "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="location">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter location" value="<?php echo htmlspecialchars($_SESSION['searchQuery_location'] ?? ''); ?>">
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" checked>
                        Show online events
                    </label>
                    <label>
                        <input type="checkbox" id="show-full-events" name="show-full-events" <?= $_SESSION['show-full-events'] ? 'checked' : '' ?>>
                        Show full events
                    </label>
                </div>

                <div class="date-range">
                    <label for="from-date">From:</label>
                    <input type="date" id="from-date" name="from-date" value="<?= isset($fromDate) ? $fromDate : '' ?>">

                    <label for="to-date">To:</label>
                    <input type="date" id="to-date" name="to-date" value="<?= isset($toDate) ? $toDate : '' ?>">
                </div>

                <button type="submit" class="search-btn">Search</button>
            </form>
        </aside>

        <!-- Events Grid Section -->
        <section class="events-container">
            <div class="events-grid">
                <!-- PHP Loop for Event Cards -->
                <?php foreach ($events as $event): ?>
                    <a href="/event/<?php echo $event['EventID'] ?>" class="event-block">
                        <article class="event-card">
                            <img src="<?= $event['image1'] ?>" alt="Event Image" class="event-image">
                            <h3 class="event-title"><?= htmlspecialchars($event['EventName']) ?></h3>
                            <div class="event-details">
                                <div class="event-info">
                                    <time class="event-date"><?= date('l, F j, Y, g:ia', strtotime($event['StartDate'])) ?></time>
                                    <address class="event-location"><?= htmlspecialchars($event['LocationName']) ?></address>
                                </div>
                                <div class="event-attendance">
                                    <img src="/assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                                    <span class="attendance-count"><?=$event['attendanceCount'] ?>/<?= $event['MaxParticipants'] ?></span>
                                </div>
                            </div>
                        </article>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
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
<script>
document.addEventListener("DOMContentLoaded", () => {
    const eventCategoryInput = document.getElementById("event-category"); // Correct ID

    const dropdown = document.getElementById("event-category-dropdown");
    const options = document.getElementById("event-category-options");
    const categoryTitle = dropdown.querySelector(".dropdown-title");

    dropdown.addEventListener("click", () => {
        options.classList.toggle("hidden");
    });

    options.addEventListener("click", (event) => {
        if (event.target.classList.contains("dropdown-option")) {
            categoryTitle.textContent = event.target.textContent;
            categoryTitle.style.color = "#333";
            options.classList.add("hidden");

            // set the selected category in the input field
            eventCategoryInput.value = event.target.textContent.trim();
        }
        event.stopPropagation();
    });

    // close dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (!dropdown.contains(event.target) && !options.contains(event.target)) {
            options.classList.add("hidden");
        }
    });
});

</script>

<?php
unset($_SESSION['searchQuery_event']);
unset($_SESSION['searchQuery_location']);
?>