
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




        <!-- More event cards can go here -->

      </div>

    </div>
  </section>
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
