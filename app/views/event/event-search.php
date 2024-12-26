<main class="event-search-page">
    <div class="event-search-container">
        <!-- Filters Section -->
        <aside class="filters">
        <form method="POST" action="/event/search"> <!-- Add action here to handle the form -->
                <div class="looking-for">
                    <label for="looking-for">What are you looking for?</label>
                    <input type="text" id="looking-for" name="search_query" placeholder="Search here..." value="<?php echo htmlspecialchars($_SESSION['searchQuery_event'] ?? ''); ?>">
                </div> 

                <div class="add-keyword">
                    <label for="add-keyword">Add Keyword</label>
                    <input type="text" id="add-keyword" placeholder="Enter keywords">

                    <div class="filter-tags">
                        <span>Music <button type="button">x</button></span>
                        <span>Young <button type="button">x</button></span>
                        <span>Outside <button type="button">x</button></span>
                    </div>
                </div>

                <div class="location">
                    <label for="location">Location</label>
                    <input type="text" id="location" placeholder="Enter location">
                </div>

                <div class="checkbox-group">
                    <label>
                        <input type="checkbox" checked>
                        Show online events
                    </label>
                    <label>
                        <input type="checkbox" checked>
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
<?php
unset($_SESSION['searchQuery_event']);
?>