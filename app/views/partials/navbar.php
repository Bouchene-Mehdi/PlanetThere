<header class="nav-bar">
    <a href="/">
        <img src="/assets/images/logo.png" alt="Planet There Logo" class="logo">
    </a>
    
    <a href="/" class="brand-logo">
        <img src="/assets/images/logo-text.svg" alt="Brand Logo">
    </a>

    <nav class="nav-menu">
        <ul class="nav-links">
            <li><a href="/" class="nav-link">Home</a></li>
            <li><a href="/event-search" class="nav-link">Events</a></li>
            <li><a href="/user-search" class="nav-link">People</a></li>
            <li><a href="/create-event1" class="nav-link">Create an Event</a></li>
            <li><a href="/about" class="nav-link">About us</a></li>
        </ul>

        <?php if (isset($_SESSION['user'])): ?>
            <!-- Logged-in user navbar -->
            <a href="/account" class="profile-link">
                <img src="/assets/images/profile-image.jpg" alt="Profile" class="profile-image">
            </a>
        <?php else: ?>
            <!-- Logged-out user navbar -->
            <a href="/login" class="nav-link">Login</a>
            <button onclick="window.location.href='/signup-1'" class="signup-btn">Sign Up</button>
        <?php endif; ?>
    </nav>
</header>
