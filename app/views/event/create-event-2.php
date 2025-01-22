<body>
<main class="main">

<section class="event-creation-section">
	<form class="event-creation-form" method="POST" action="/event/create-2"  enctype="multipart/form-data" >
		
			
			<div class="legend-section">
				<h1 class="legend">Last <span style="color: #009688;">Steps</span>!</h1>
				
			</div>
			
           <!-- Error Handling Section -->
		   <?php if (isset($_SESSION['errors']['finishdate'])): ?>
                <div class="error-message">
                    <p class="error"><?php echo htmlspecialchars($_SESSION['errors']['finishdate']); ?></p>
                </div>
                <?php unset($_SESSION['errors']['finishdate']); ?> <!-- Clear after displaying -->
            <?php endif; ?>

			<div class="pictures-section">
				<p class="pictures-section-paragraph">Pictures</p>
				<div class="gallery">
					
						
						<input class="uppload-picture-box" name="image1" id="image1" type="file" accept="image/png, image/jpeg, image/webp, image/jpg"  >
					
						<input class="uppload-picture-box" name="image2" id="image2" type="file" accept="image/png, image/jpeg, image/webp, image/jpg"  >
				
				</div>
			</div>

			
				<div class="max-participants">
					<label class="form-label" for="maxParticipants">MAX PARTICIPANTS</label>
					<input max="2024-12-31" type="number" min="0" id="maxParticipants" name="maxParticipants" placeholder="eg 500" required>
				</div>
				
				<div class="frequency">
					
						
					<label class="form-label" for="frequency">FREQUENCY</label>
					<input type="number" min="0" id="frequency" name="frequency" placeholder="days gap (0 if once only)" required>
				</div>

				<div class="category">
					<label class="form-label" for="categories">CATEGORY</label>
					<select name="categories" id="categories" >
						<?php foreach ($categories as $category): ?>
							<option value="<?= $category['CategoryID']; ?>"><?= htmlspecialchars($category['CategoryName']); ?></option>
						<?php endforeach; ?>
					  </select>
				</div>

				<div class="event-date">
					<label class="form-label" for="repeatdate">REPEAT UNTIL ?</label>
					<input min="2024-12-16" type="date" id="repeatdate" name="finishdate" >
				</div>

				<div class="event-descryption">
					<label class="form-label" for="description">DESCRIPTION</label>
					<textarea  id="description" name="description" placeholder="Tell us about your event!" required></textarea>
				</div>



			<button class="sign-up-button" type="submit">Post the event!</button>
		
	</form>
	 
</section>

<section class="Join-us-section">
	<div class="join-us-section-text">
	<h2 class="join-us-today">Tell us your plans</h2>
	<p>Fill this simple form and for people to <br>come!</p>
	</div>
</section>

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

        // Add validation for "REPEAT UNTIL" date
        const form = document.querySelector('.event-creation-form');
        const eventStartDateInput = document.getElementById('eventstartdate');
        const eventEndDateInput = document.getElementById('eventenddate');
        const repeatDateInput = document.getElementById('repeatdate');

        form.addEventListener('submit', function (event) {
            const eventStartDate = new Date(eventStartDateInput.value);
            const repeatDate = new Date(repeatDateInput.value);

            if (repeatDate < eventStartDate || repeatDate < eventEndDate) {
                event.preventDefault(); // Prevent form submission
                alert('The repeat date cannot be before the event start date.');

            }
    });
</script>
</body>
