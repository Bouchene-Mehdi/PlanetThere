
<main class="main">





<section class="event-creation-section">
	<form class="event-creation-form">
		
			
			<div class="legend-section">
				<h1 class="legend">Create an <span style="color: #009688;">Event</span>!</h1>
				
			</div>
			

			<div class="event-name-field">
				<label class="form-label" for="eventname">Event Name</label>
				<input type="text" id="eventname" name="eventname" placeholder="Enter the name of your Event" required>
			</div>

			
				<div class="event-date">
					<label class="form-label" for="eventdate">EVENT DATE</label>
					<input max="2024-12-31" type="date" id="eventdate" name="eventdate" placeholder="21/12/2024" required>
				</div>
				
				<div class="event-time">
					<label class="form-label" for="eventtime">EVENT TIME</label>
					<input type="time"  id="eventtime" name="eventtime" placeholder="eg 16:00" required>
				</div>

			


			<div class="location-name-field">
				<label class="form-label" for="locationname">Name of the Location</label>
				<input type="text" id="locationname" name="locationname" placeholder="Enter the name of the Location" required>
			</div>
			
			<div class="location-address-field">
				<label class="form-label" for="location-address">Address of the Location</label>
				<input type="text" id="locationaddress" name="locationaddress" placeholder="Enter the address of the Location" required>
			</div>

			<div class="Location-capasity-field">
				<label class="form-label" for="locationcapacity">Location Capacity</label>
				<input type="number" min="0" id="locationcapacity" name="locationcapacity" placeholder="Enter the capacity of the location, if you don’t know that enter “0”" required>
			</div>

			<button class="sign-up-button" type="submit">Continue</button>
		
	</form>
	 
</section>

<section class="Join-us-section">
	<div class="join-us-section-text">
	<h2 class="join-us-today">Tell us your plans</h2>
	<p>Fill this simple form and for people to <br>come!</p>
	</div>
</section>

</main>
