  
  <div class="main-content">
    <!-- Title and Author Section -->
    <section class="event-header">
      <div class="event-name"><?= htmlspecialchars($event['EventName']); ?></div>
      <div class="event-author-header">
        <div class="event-author" id="author">
          <img src="../<?php echo $manager['ProfileImage']?> " alt="Organizer" class="author-photo" />
          <h2 class="author-by">BY <span class="author-name"><?= htmlspecialchars($manager['FirstName']) . ' '.htmlspecialchars($manager['LastName']); ?></span></h2>
        </div>
        <div class="event-header-attendance">
            <img src="../assets/images/attendance-icon.svg" alt="Attendees" class="attendance-icon">
            <span class="attendance-count"><?= $attendanceCount . '/' . $event['MaxParticipants']; ?></span>
          </div>
        <div class="event-header-extra">
  
          <?php if ($_SESSION['user']['UserID'] == $manager['UserID']): ?>
            <form action="/event-attendees/<?php echo $event['EventID'] ?>" method="GET" class="follow-form">
              <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
              <button type="submit" class="btn-apply">SEE ATTENDANTS</button>
            </form>
            <form action="/event-waitlist/<?php echo $event['EventID'] ?>" method="GET" class="follow-form">
              <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
              <button type="submit" class="btn-apply">SEE WAITLIST</button>
            </form>
          <?php else: ?>
            <?php if ($IsRegistered): ?>
              <form action="/event/unregister/<?php echo $event['EventID'] ?>" method="POST" class="follow-form"  onsubmit="return confirmUnregister()">
                <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                <button type="submit" class="btn-attend"  >DELETE REGISTRATION</button>
              </form>
              
            <?php else: ?>
              <?php if($attendanceCount < $event['MaxParticipants']): ?>

                <form action="/event/register/<?php echo $event['EventID'] ?>" method="POST" class="apply-form"  onsubmit="return confirmRegister()">
                  <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">
                  <div class="ticket-quantity">
                    <label for="ticket-quantity" class="tickets">Number of tickets : </label>
                    <button type="button" class="quantity-btn" id="decrease-btn">-</button>
                    <input type="number" id="ticket-quantity" name="quantity" value="1" min="1" max="<?= $event['MaxParticipants']-$attendanceCount?>" readonly>
                    <button type="button" class="quantity-btn" id="increase-btn">+</button>
                  </div>                
                <button type="submit" class="btn-apply" >APPLY&nbspHere</button>
                </form>
              <?php else: ?>
                <?php if($IsInWaitlist): ?>
                  <form action="/event/waitlist/<?php echo $event['EventID'] ?>" method="POST" class="apply-form"  onsubmit="return confirmRegister()">
                    <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">       
                    <button type="submit" class="btn-attend" >LEAVE WAITLIST</button>
                 </form> 

                <?php else: ?>
                  <form action="/event/waitlist/<?php echo $event['EventID'] ?>" method="POST" class="apply-form"  onsubmit="return confirmRegister()">
                  <input type="hidden" name="event_id" value="<?= $event['EventID']; ?>">       
                  <button type="submit" class="btn-attend" >JOIN WAITLIST</button>
                </form>      
                <?php endif; ?>
        
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <!-- Image Carousel -->
    <section class="event-carousel">
      <div class="carousel">
        <button class="carousel-control prev" id="prev-btn">&#9664;</button>
        <div class="carousel-image-container">
          <?php if (!empty($event['image1']) && !empty($event['image2'])): ?>
            <img id="carousel-image" class="carousel-image" 
                src="<?= htmlspecialchars($event['image1']); ?>" 
                alt="Event Image 1" />
          <?php endif; ?>
        </div>
        <button class="carousel-control next" id="next-btn">&#9654;</button>
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
      <div class="event-description">
        <h3>DESCRIPTION</h3>
        <p><?= nl2br(htmlspecialchars($event['Description'])); ?></p>
      </div>
    </section>

    <!-- More Events Section -->
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
                </a>
              </article>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  </div>
<script>
    function confirmRegister() {
      return confirm("Are you sure you want to register for this event?");
    }

    // Confirmation for Unregister action
    function confirmUnregister() {
      return confirm("Are you sure you want to unregister from this event?");
    }

    // Carousel Functionality
    const images = [
      '<?= htmlspecialchars($event['image1']); ?>',
      '<?= htmlspecialchars($event['image2']); ?>'
    ];

    let currentIndex = 0;
    const carouselImage = document.getElementById('carousel-image');

    function showImage(index) {
      carouselImage.src = images[index];
      carouselImage.alt = 'Event Image ' + (index + 1);
    }

    document.getElementById('next-btn').addEventListener('click', function () {
      currentIndex = (currentIndex + 1) % images.length;
      showImage(currentIndex);
    });

    document.getElementById('prev-btn').addEventListener('click', function () {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      showImage(currentIndex);
    });
    let ticketQuantity = 1;
    const maxQuantity = <?= $event['MaxParticipants']-$attendanceCount; ?>;  // Maximum tickets allowed

    // Get the input field and buttons
    const quantityInput = document.getElementById('ticket-quantity');
    const increaseButton = document.getElementById('increase-btn');
    const decreaseButton = document.getElementById('decrease-btn');

    // Increase quantity
    increaseButton.addEventListener('click', function () {
      if (ticketQuantity < maxQuantity) {
        ticketQuantity++;
        quantityInput.value = ticketQuantity;
      }
    });

    // Decrease quantity
    decreaseButton.addEventListener('click', function () {
      if (ticketQuantity > 1) {
        ticketQuantity--;
        quantityInput.value = ticketQuantity;
      }
    });
</script>



<style>
  .spacer {
    height: 50px;
  }
</style>
