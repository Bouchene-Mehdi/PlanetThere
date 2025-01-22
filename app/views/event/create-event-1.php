<body>
    <main class="main">
        <section class="event-creation-section">
            <form class="event-creation-form" method="POST" action="/event/create-1">

                <div class="legend-section">
                    <h1 class="legend">Create an <span style="color: #009688;">Event</span>!</h1>
                </div>

                <!-- Event Name -->
                <div class="event-name-field">
                    <label class="form-label" for="eventname">Event Name</label>
                    <input type="text" id="eventname" name="eventname" placeholder="Enter the name of your Event" required>
                </div>

                <!-- Event Start Date -->
                <div class="event-date">
                    <label class="form-label" for="eventstartdate">EVENT START DATE</label>
                    <input type="date" min="2024-12-18" id="eventstartdate" name="eventstartdate" placeholder="18/12/2024" required>
                </div>

                <!-- Event Start Time -->
                <div class="event-time">
                    <label class="form-label" for="eventstarttime">EVENT START TIME</label>
                    <input type="time" id="eventstarttime" name="eventstarttime" placeholder="eg 16:00" required>
                </div>

                <!-- Event End Date -->
                <div class="event-date">
                    <label class="form-label" for="eventenddate">EVENT END DATE</label>
                    <input type="date" min="2024-12-18" id="eventenddate" name="eventenddate" placeholder="18/12/2024" required>
                </div>

                <!-- Event End Time -->
                <div class="event-time">
                    <label class="form-label" for="eventendtime">EVENT END TIME</label>
                    <input type="time" id="eventendtime" name="eventendtime" placeholder="eg 16:00" required>
                </div>

                <!-- Location Name -->
                <div class="location-name-field">
                    <label class="form-label" for="locationname">Name of the Location</label>
                    <input type="text" id="locationname" name="locationname" placeholder="Enter the name of the Location" required>
                </div>

                <!-- Location Address -->
                <div class="location-address-field">
                    <label class="form-label" for="locationaddress">Address of the Location</label>
                    <input type="text" id="locationaddress" name="locationaddress" placeholder="Enter the address of the Location" required>
                </div>

                <!-- Location Capacity -->
                <div class="event-name-field">
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
