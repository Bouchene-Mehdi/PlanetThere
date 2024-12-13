

<main class="main">





<section class="event-creation-section">
	<form class="event-creation-form">
		
			
			<div class="legend-section">
				<h1 class="legend">Last <span style="color: #009688;">Steps</span>!</h1>
				
			</div>
			

			<div class="pictures-section">
				<p class="pictures-section-paragraph">Pictures</p>
				<div class="gallery">
					
						
						<input class="uppload-picture-box" type="file" accept="image/png, image/jpeg, image/webp"  >
					
						<input class="uppload-picture-box" type="file" accept="image/png, image/jpeg, image/webp"  >
				
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
					<select name="categories" id="categories" required>
						<option value="" hidden>What categories fits your event?</option>
						<option value="Sport">Sport</option>
						<option value="Entertainment">Entertainment</option>
						<option value="Politics">Politics</option>
						<option value="Education">Education</option>
					  </select>
				</div>

				<div class="event-date">
					<label class="form-label" for="finishdate">PICK THE FINISH DATE</label>
					<input max="2024-12-31" type="date" id="finishdate" name="finishdate" >
				</div>

				<div class="event-descryption">
					<label class="form-label" for="descryption">DESCRIPTION</label>
					<textarea  id="descryption" name="descryption" placeholder="Tell us about your event!" required></textarea>
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
