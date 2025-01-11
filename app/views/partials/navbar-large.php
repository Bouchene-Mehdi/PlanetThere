<header class="nav-bar">
    <a href="/">
        <img src="/assets/images/logo.png" alt="Planet There Logo" class="logo">
    </a>
    
    <a href="/" class="brand-logo">
        <img src="/assets/images/logo-text.svg" alt="Brand Logo">
    </a>

    <div class="hamburger">
        <img src="/assets/images/hamburger-icon.svg" alt="Hamburger Icon" class="hamburger-icon">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <nav class="nav-menu">
        <ul class="nav-links">
            <li class="nav-link-bar"><a href="/" class="nav-link">Home</a></li>
            <li class="nav-link-bar"><a href="/event-search" class="nav-link">Events</a></li>
            <li class="nav-link-bar"><a href="/user-search" class="nav-link">People</a></li>
            <li class="nav-link-bar"><a href="/create-event1" class="nav-link">Create an Event</a></li>
            <li class="nav-link-bar"><a href="/about" class="nav-link">About us</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li class="nav-link-bar">
                    <div class="nav-link-account">
                        <a href="/account" class="nav-link">
                            <span class="account-text">Account</span>
                            <img src="<?php echo $_SESSION['user']['ProfileImage']; ?>" alt="Profile" class="profile-image">
                        </a>
                        
                    </div>
                </li>
                
            <?php else: ?>
                <li class="nav-link-bar"><a href="/login" class="nav-link">Login</a></li>
                <li class="nav-link-bar"><button onclick="window.location.href='/signup-1'" class="signup-btn">Sign Up</button></li>
            <?php endif; ?>
        </ul>


    </nav>
</header>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');
        const navLinks = document.querySelectorAll('.nav-link');
        console.log("Loaded");

        // menu is made visible when hamburger icon is clicked
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('active');
            navMenu.classList.toggle('active');
        });

        navMenu.forEach(link => {
            link.addEventListener('click', () => {
                hamburger.classList.remove('active');
                navMenu.classList.remove('active');
            });
        });
    });
</script>
