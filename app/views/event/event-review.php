<div class="main-content">
    <!-- Title and Author Section -->
    <section class="event-header">
        <div class="event-name"><?= htmlspecialchars($event['EventName']); ?></div>
        <div class="event-author-header">
            <div class="event-author">
                <img src="../<?php echo $user['ProfileImage']?> " alt="Organizer" class="author-photo" />
                <h2 class="author-by">BY <span class="author-name"><?= htmlspecialchars($user['FirstName']) . ' '.htmlspecialchars($user['LastName']) ;  ?></span></h2>
            </div>
            <div class="event-header-extra">
                <div class="event-header-attendance">
                    <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                    <span class="attendance-count"><?= $attendanceCount . '/' . $event['MaxParticipants']; ?></span>
                </div>
                <?php if ($_SESSION['user']['UserID'] == $user['UserID']): ?>
                    <!-- Form to show "ATTENDANTS" if the user is the event manager -->
                    <form action="/event-attendees/<?php echo $event['EventID'] ?>" method="GET" class="follow-form">
                        <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                        <button type="submit" class="btn-attend">SEE ATTENDANTS</button>
                    </form>
                <?php else: ?>
                    <?php if (isset($_SESSION['IsRegistered']) && $_SESSION['IsRegistered']): ?>
                        <!-- Form to Unregister (Unapply) -->
                        <form action="/event/unregister/<?php echo $event['EventID'] ?>" method="POST" class="follow-form">
                            <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                            <button type="submit" class="btn-attend">UNREGISTER</button>
                        </form>
                    <?php else: ?>
                        <!-- Form to Register (Apply) -->
                        <form action="/event/register/<?php echo $event['EventID'] ?>" method="POST" class="follow-form">
                            <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                            <button type="submit" class="btn-attend">APPLY&nbspHere</button>
                        </form>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Image Carousel -->
    <section class="event-carousel">
        <div class="carousel">
            <button class="carousel-control prev" onclick="prevImage()">&#9664;</button> <!-- Previous Button -->
            <div class="carousel-image-container">
                <?php if (!empty($event['image1']) && !empty($event['image2'])): ?>
                    <img id="carousel-image" class="carousel-image"
                         src="<?= htmlspecialchars($event['image1']); ?>"
                         alt="Event Image 1" />
                <?php endif; ?>
            </div>
            <button class="carousel-control next" onclick="nextImage()">&#9654;</button> <!-- Next Button -->
        </div>
    </section>


    <!-- Event Details Section -->
    <section class="event-text-details">
        <div class="event-description">
            <h3>Time and Date</h3>
            <p><?= date('l, F j, Y, g:i A', strtotime($event['StartDate'])); ?></p>
        </div>
        <div class="event-description">
            <h3>Location</h3>
            <p><?= htmlspecialchars($event['LocationName']) . ', ' . htmlspecialchars($event['LocationAddress']); ?></p>
        </div>
        <div class="event-description">
            <h3>Categories</h3>
            <p><?= htmlspecialchars($categories['CategoryName']); ?></p>
        </div>
        <!-- Description Section -->
        <div class="event-description">
            <h3>DESCRIPTION</h3>
            <p><?= nl2br(htmlspecialchars($event['Description'])); ?></p>
        </div>
    </section>

    <!-- Feedback Section -->
    <section class="feedback-section">
        <h1>Give us your <span class="highlight">Feedback!</span></h1>
        <div class="star-rating">
            <i class="fa fa-star" data-rating="1"></i>
            <i class="fa fa-star" data-rating="2"></i>
            <i class="fa fa-star" data-rating="3"></i>
            <i class="fa fa-star" data-rating="4"></i>
            <i class="fa fa-star" data-rating="5"></i>
        </div>
        <textarea
            class="feedback-input"
            placeholder="Tell us what you think about the event..."
        ></textarea>
        <button class="btn-submit" onclick="submitReview()">Submit</button>
    </section>

    <section class="comments-section">
        <h2>Check what others <span class="highlight">Think!</span></h2>

        <!-- Comment 1 -->
        <div class="comment-card">
            <div class="comment-header">
                <img src="../../public/assets/images/profile-image.JPG" alt="User Avatar" class="user-avatar">
                <div class="user-info">
                    <h3>JANE DOE</h3>
                    <p class="comment-text">AMAZING! I CODED MY WEBSITE IN 2 MINUTES</p>
                </div>
                <span class="comment-date">Friday, October 6, 8:30PM</span>
            </div>
            <div class="comment-stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
            </div>
        </div>

        <!-- Repeat the comment cards for more comments -->
        <div class="comment-card">
            <div class="comment-header">
                <img src="../../public/assets/images/profile-image.JPG" alt="User Avatar" class="user-avatar">
                <div class="user-info">
                    <h3>JANE DOE</h3>
                    <p class="comment-text">AMAZING! I CODED MY WEBSITE IN 2 MINUTES AMAZING!
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES
                        AMAZING! I CODED MY WEBSITE IN 2 MINUTES</p>
                </div>
                <span class="comment-date">Friday, October 6, 8:30PM</span>
            </div>
            <div class="comment-stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
                <i class="fa-regular fa-star"></i>
            </div>
        </div>
        <button class="load-more-btn">Load more...</button>
        <!-- Add more cards as needed -->
    </section>

    <section class="events-section">
        <h2 class="section-title">More <span class="highlight">Events</span></h2>
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
                            <img src="../../public/assets/images/attendance-icon.svg"
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
                            <img src="../../public/assets/images/attendance-icon.svg"
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
                            <img src="../../public/assets/images/attendance-icon.svg"
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
                            <img src="../../public/assets/images/attendance-icon.svg"
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

<script>
    // Array of images (populate this from PHP dynamically if needed)
    const images = [
        '<?= htmlspecialchars($event['image1']); ?>',
        '<?= htmlspecialchars($event['image2']); ?>'
    ];

    let currentIndex = 0; // Start with the first image
    const carouselImage = document.getElementById('carousel-image');

    function showImage(index) {
        // Update the src and alt attributes to switch images
        carouselImage.src = images[index];
        carouselImage.alt = 'Event Image ' + (index + 1);
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % images.length; // Loop to the next image
        showImage(currentIndex);
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop to the previous image
        showImage(currentIndex);
    }

    function submitReview() {
        const selectedRating = document.querySelectorAll('.fa-solid').length; // Count solid stars
        const comment = document.querySelector('.feedback-input').value.trim();

        if (selectedRating === 0) {
            alert("Please select a rating!");
            return;
        }

        if (comment === "") {
            alert("Please enter a comment!");
            return;
        }

        const eventID = <?= json_encode($event['EventID']); ?>;
        const userID = <?= json_encode($_SESSION['user']['UserID']); ?>;

        fetch("/submit-review.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({
                rating: selectedRating,
                comment: comment,
                eventID: eventID,
                userID: userID
            }),
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert("Thank you for your feedback!");
                    location.reload(); // Reload the page to update UI or show the success message
                } else {
                    alert("Failed to submit feedback: " + result.message);
                }
            })
            .catch(error => {
                console.error("Error submitting feedback:", error);
                alert("An error occurred. Please try again.");
            });
    }

</script>

<div class="spacer"></div>

</main>

<style>
    .spacer {
        height: 50px; /* Adjust the height as needed */
    }
</style>
<?php
unset($_SESSION['IsRegistered']);
?>