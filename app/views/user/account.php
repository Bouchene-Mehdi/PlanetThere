<body>

    <div class="account-center">
        <!-- Header Section -->
        <header class="account-header">
            <h1>Welcome <?php echo $_SESSION['user']['FirstName'] . " " . $_SESSION['user']['LastName']; ?>!</h1>
            <p class="subheader">Account Center</p>
        </header>

        <!-- Account Options -->
        <div class="account-options">
            <!-- Personal Information Section -->
            <div class="option">
                <a href="/profile-settings" class="option-link">
                    <div class="icon-title">
                        <img src="assets/images/account-icon.svg" alt="Personal Information Icon" class="icon">
                        <div class="text">
                            <h2>Personal Information</h2>
                            <p>View and change your personal information</p>
                        </div>
                    </div>
                </a>
                <hr>
            </div>

            <!-- History of Events Section -->
            <div class="option">
                <a href="/event-history" class="option-link">
                    <div class="icon-title">
                        <img src="assets/images/book-icon.svg" alt="History of Events Icon" class="icon">
                        <div class="text">
                            <h2>History of Events</h2>
                            <p>View the history and upcoming events</p>
                        </div>
                    </div>
                </a>
                <hr>
            </div>

            <!-- Friends Section -->
            <div class="option">
                <a href="/friends" class="option-link">
                    <div class="icon-title">
                        <img src="assets/images/users-icon.svg" alt="Friends Icon" class="icon">
                        <div class="text">
                            <h2>Friends</h2>
                            <p>Check who you follow and who follows you</p>
                        </div>
                    </div>
                </a>
                <hr>
            </div>

            <!-- Settings Section -->
            <div class="option">
                <a href="/settings" class="option-link">
                    <div class="icon-title">
                        <img src="assets/images/settings-icon.svg" alt="Settings Icon" class="icon">
                        <div class="text">
                            <h2>Settings</h2>
                            <p>Adjust your preferences about the website functionalities</p>
                        </div>
                    </div>
                </a>
                <hr>
            </div>
            <!-- Settings Section -->
            <div class="option delete" >
                <a href="/log-out" class="option-link" id="logoutBtn">
                    <div class="icon-title">
                        <img src="/assets/images/log-out-icon.svg" alt="Log Out Icon" class="icon">
                        <div class="text">
                            <h2>Log out</h2>
                            <p>Log out of your account</p>
                        </div>
                    </div>
                </a>
                <hr>
            </div>
            <!-- Delete Account Section -->
            <div class="option delete">
                <a  class="option-link" id="delete">
                    <div class="icon-title">
                        <img src="assets/images/info-icon.svg" alt="Delete Account Icon" class="icon">
                        <div class="text">
                            <h2>Delete your account</h2>
                            <p>Make sure you want to delete your account before starting this procedure</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
 <script>
        document.getElementById('logoutBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default button action (navigation)
        
        // Show confirmation dialog
        const confirmation = confirm("Are you sure you want to log out?");
        
        if (confirmation) {
            // If confirmed, proceed with the logout
            window.location.href = '/log-out'; // Adjust to your logout route
        }
    });
    document.getElementById('delete').addEventListener('click', function(event) {
        event.preventDefault(); // Prevent the default button action (navigation)
        
        // Show confirmation dialog
        const confirmation = confirm("Are you sure you want to delete your account ?");
        
        if (confirmation) {
            // If confirmed, proceed with the logout
            window.location.href = '/delete-account'; // Adjust to your logout route
        }
    });
</script>
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