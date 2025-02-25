<body>
<div class="main-content">
    <!-- Title and Author Section -->
    <section class="event-header">
        <div class="event-name"><?= htmlspecialchars($event['EventName']); ?></div>
        <div class="event-author-header">
            <div class="event-author">
            <a href="/profile/<?php echo urlencode($manager['Username']); ?>">
                <img src="../<?php echo $manager['ProfileImage']?> " alt="Organizer" class="author-photo" />
            </a>
                <h2 class="author-by">BY <span class="author-name"><?= htmlspecialchars($manager['FirstName']) . ' '.htmlspecialchars($manager['LastName']) ;  ?></span></h2>
            </div>
            <div class="event-header-attendance">
                    <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
                    <span class="attendance-count"><?= $attendanceCount . '/' . $event['MaxParticipants']; ?></span>
                </div>
            <div class="event-header-extra">


                <?php if (isset($_SESSION['user']) && $_SESSION['user']['UserID'] == $manager['UserID']): ?>
                    <!-- Form to show "ATTENDANTS" if the user is the event manager -->
                    <form action="/event-attendees/<?php echo $event['EventID'] ?>" method="GET" class="follow-form">
                        <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                        <button type="submit" class="btn-finished">SEE ATTENDANTS</button>
                    </form>
                <?php else: ?>
                    <button class="btn-finished">EVENT FINISHED</button>
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
                         src="<?= htmlspecialchars($event['image1']); ?> "
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
    <?php if ($canReview): ?>
    <section class="feedback-section">
        <h1>Give us your <span class="highlight">Feedback!</span></h1>
        <form id="feedbackForm" action="/event/review/" method="POST" class="feedback-form">
            <div class="star-rating">
                <i class="fa fa-star" data-rating="1"></i>
                <i class="fa fa-star" data-rating="2"></i>
                <i class="fa fa-star" data-rating="3"></i>
                <i class="fa fa-star" data-rating="4"></i>
                <i class="fa fa-star" data-rating="5"></i>
            </div>
            <textarea
                    name="comment"
                    id="feedback"
                    class="feedback-input"
                    placeholder="Tell us what you think about the event..."
            ></textarea>
            <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['EventID']); ?>">
            <input type="hidden" name="rating" id="rating" value="0">
            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </section>
    <?php endif; ?>

    <section class="comments-section">
        <h2>Check what others <span class="highlight">Think!</span></h2>

        <?php foreach ($reviews as $review): ?>
            <!-- Comment Card -->
            <div class="comment-card">
                <div class="comment-header">
                    <div class="comment-content">
                        <!-- User Avatar -->
                        <a href="/profile/<?php echo urlencode($review['Username']); ?>">
                            <img src="<?= htmlspecialchars($review['UserProfileImage']); ?>" alt="User Avatar" class="user-avatar">
                        </a>
                        <div class="user-info">
                            <!-- User Name -->
                            <h3><?= htmlspecialchars($review['UserFirstName'] . ' ' . $review['UserLastName']); ?></h3>
                            <!-- Review Text -->
                            <p class="comment-text"><?= nl2br(htmlspecialchars($review['Comment'])); ?></p>
                        </div>
                    </div>
                    <span class="comment-date"><?= date('l, F j, Y, g:i A', strtotime($review['Date'])); ?></span>

                </div>

                <div class="comment-stars">
                    <?php
                    // Assuming $review['Rating'] contains the numeric rating (1-5)
                    for ($i = 1; $i <= 5; $i++):
                        $starClass = ($review['Score'] >= $i) ? 'fa-solid' : 'fa-regular';
                        ?>
                        <i class="fa <?= $starClass; ?> fa-star"></i>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </section>


    <section class="events-section">
        <h2 class="section-title">More <span class="highlight">Events</span></h2>
        <div class="events-container">
            <div class="events-grid">
                <?php foreach ($moreEvents as $displayEvent): ?>
                    <?php if ($displayEvent['EventID'] != $event['EventID']): ?>
                        <article class="event-card">
                            <a href="/event/<?php echo $displayEvent['EventID']; ?>">
                                <img src="<?php echo $displayEvent['image1']; ?>" alt="<?php echo htmlspecialchars($displayEvent['EventName']); ?>" class="event-image" />
                                <h3 class="event-title"><?php echo htmlspecialchars($displayEvent['EventName']); ?></h3>
                                <div class="event-details">
                                    <div class="event-info">
                                        <time class="event-date"><?php echo date("l, F j, Y g:i A", strtotime($displayEvent['StartDate'])); ?></time>
                                        <address class="event-location"><?php echo htmlspecialchars($displayEvent['LocationName']); ?></address>
                                    </div>
                                    <div class="event-attendance">
                                        <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon" />
                                        <span class="attendance-count"><?php echo $displayEvent['AttendeesCount']; ?>/<?php echo $displayEvent['MaxParticipants']; ?></span>
                                    </div>
                                </div>
                            </a></article>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
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

<script>
    const stars = document.querySelectorAll('.star-rating i');
    let ratingInput = document.getElementById('rating');

    stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            // Set the hidden input value for rating
            ratingInput.value = index + 1;

            // Update the stars' classes to reflect the selected rating
            stars.forEach((s, i) => {
                s.classList.toggle('fa-solid', i <= index); // Filled star
                s.classList.toggle('fa-regular', i > index); // Empty star
            });
        });
    });
</script>

<script>
    document.getElementById('feedbackForm').addEventListener('submit', function (event) {
        const rating = document.getElementById('rating').value; // Get the rating value
        const feedback = document.getElementById('feedback').value.trim(); // Get and trim the feedback text

        if (rating === "0") {
            alert('Please select a rating before submitting your review.');
            event.preventDefault(); // Prevent form submission
            return;
        }

        if (feedback === "") {
            alert('Please write a comment before submitting your review.');
            event.preventDefault(); // Prevent form submission
            return;
        }
    });
</script>

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