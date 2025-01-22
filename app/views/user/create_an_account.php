<div class="blocked-container">
        <div class="blocked-message">
            <h1>You need an account</h1>
            <p>fortunately, you can create one by clicking on the button below</p>
            <a href="/signup-1" class="home-button">Lets go !</a>
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