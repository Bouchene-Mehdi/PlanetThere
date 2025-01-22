<body>
<div class="blocked-container">
        <div class="blocked-message">
            <h1>Unauthorized Access</h1>
            <p>You do not have access to this page </p>
            <a href="/" class="home-button">Go to Homepage</a>
        </div>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const currentTheme = localStorage.getItem('theme') || 'light';

        // If the theme is dark, apply the dark mode class to body
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
</script>
</body>