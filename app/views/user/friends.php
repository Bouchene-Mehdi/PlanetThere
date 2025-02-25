<body>
<div class="following-page">
    <!-- Page Header -->
    <header class="following-header">
        <h1>Friends</h1>
        <p>See your relations with others!</p>
        <div class="tabs">
            <span class="tab active" data-tab="following">Following [<span id="following-count"><?= count($followedList) ?></span>]</span>
            <span class="tab" data-tab="followers">Followers [<span id="followers-count"><?= count($followersList) ?></span>]</span>
            <span class="tab" data-tab="blocked">Blocked [<span id="blocked-count"><?= count($blockedList) ?></span>]</span>
        </div>
    </header>

    <!-- Lists -->
    <section class="friends-lists">

        <!-- Following List -->
        <div class="friends-list" id="following">
            <?php foreach ($followedList as $followed): ?>

                <a href="/profile/<?= urlencode($followed['Username']) ?>" class="profile-card">
                    <img src="<?php echo $followed['ProfileImage']; ?>" alt="Profile Picture" class="profile-pic">
                    <h2><?= htmlspecialchars($followed['Username']) ?></h2>
                    <p><?= htmlspecialchars($followed['FirstName'] . ' ' . $followed['LastName']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Followers List -->
        <div class="friends-list hidden" id="followers">
            <?php foreach ($followersList as $follower): ?>
                <a href="/profile/<?= urlencode($follower['Username']) ?>" class="profile-card">
                    <img src="<?php echo $follower['ProfileImage']; ?>" alt="Profile Picture" class="profile-pic">
                    <h2><?= htmlspecialchars($follower['Username']) ?></h2>
                    <p><?= htmlspecialchars($follower['FirstName'] . ' ' . $follower['LastName']) ?></p>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Blocked List -->
        <div class="friends-list hidden" id="blocked">
            <?php foreach ($blockedList as $blocked): ?>
                <a href="/profile/<?= urlencode($blocked['Username']) ?>" class="profile-card">
                    <img src="<?php echo $blocked['ProfileImage']; ?>" alt="Profile Picture" class="profile-pic">
                    <h2><?= htmlspecialchars($blocked['Username']) ?></h2>
                    <p><?= htmlspecialchars($blocked['FirstName'] . ' ' . $blocked['LastName']) ?></p>
            
                </a>
            <?php endforeach; ?>
        </div>
    </section>
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

<script>
    // JavaScript for Tabs and Dynamic Counts
    document.addEventListener('DOMContentLoaded', () => {
        const tabs = document.querySelectorAll('.tab');
        const lists = document.querySelectorAll('.friends-list');

        // Handle tab switching
        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and add to the clicked tab
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                // Hide all lists and show the selected one
                lists.forEach(list => list.classList.add('hidden'));
                document.getElementById(tab.dataset.tab).classList.remove('hidden');
            });
        });
    });
</script>
