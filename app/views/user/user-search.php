<!-- User Search Page -->
<div class="user-search-page">
    <!-- Search Bar Section -->
    <div class="search-bar-container">
        <form action="/user/search" method="POST">
            <div class="search-bar">
                <input type="text" id="user-search-input" placeholder="Who are you looking for?" name="search_query" value="<?php echo htmlspecialchars($_SESSION['searchQuery'] ?? ''); ?>">
                <button class="search-button">
                    <img src="/assets/images/search-btn-icon.svg" alt="Search Icon">
                </button>
            </div>
        </form>
    </div>
    <!-- Search Bar Section -->

<!-- User Profiles Section -->
<section class="user-profiles">
    <?php if (!empty($_SESSION['users'])): ?>
        <?php foreach ($_SESSION['users'] as $user): ?>
            <div class="profile-card">
            <a href="/profile/<?php echo urlencode($user['username']); ?>">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2><?php echo htmlspecialchars($user['firstName'] . ' ' . $user['lastName']); ?></h2>
                    <p><?php echo htmlspecialchars($user['username']); ?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</section>

</div>

<?php
unset($_SESSION['searchQuery']);
unset($_SESSION['search_results']);
unset($_SESSION['users']);
?>