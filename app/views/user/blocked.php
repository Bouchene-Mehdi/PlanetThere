    <div class="blocked-container">
        <div class="blocked-message">
            <h1>Your account has been blocked</h1>
            <p>Unfortunately, your account has been blocked by this user </p>
            <a href="/" class="home-button">Go to Homepage</a>
        </div>
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