
    <div class="following-page">
        <!-- Page Header -->
        <header class="following-header">
            <h1>Friends</h1>
            <p>See your relations with others!</p>
            <div class="tabs">
                <span class="tab active" data-tab="following">Following [<span id="following-count"></span>]</span>
                <span class="tab" data-tab="followers">Followers [<span id="followers-count"></span>]</span>
                <span class="tab" data-tab="blocked">Blocked [<span id="blocked-count"></span>]</span>
            </div>
        </header>

        <!-- Lists -->
        <section class="friends-lists">
            <!-- Following List -->
            <div class="friends-list" id="following">
                <div class="profile-card">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2>HannahMontana</h2>
                    <p>Miley Cyrus</p>
                    <button class="unfollow-btn">UNFOLLOW</button>
                </div>
                <div class="profile-card">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2>PrivateHannah</h2>
                    <p>Miley Cyrus</p>
                    <button class="unfollow-btn">UNFOLLOW</button>
                </div>
            </div>

            <!-- Followers List -->
            <div class="friends-list hidden" id="followers">
                <div class="profile-card">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2>FriendlyHannah</h2>
                    <p>Miley Cyrus</p>
                    <button class="follow-btn">FOLLOW</button>
                </div>
                <div class="profile-card">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2>NameHannah</h2>
                    <p>Miley Cyrus</p>
                    <button class="follow-btn">FOLLOW</button>
                </div>
            </div>

            <!-- Blocked List -->
            <div class="friends-list hidden" id="blocked">
                <div class="profile-card">
                    <img src="/assets/images/profile-image.JPG" alt="Profile Picture" class="profile-pic">
                    <h2>BlockedUser</h2>
                    <button class="unblock-btn">UNBLOCK</button>
                </div>
            </div>
        </section>
    </div>


    <script>

        // JavaScript for Tabs and Dynamic Counts
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.tab');
            const lists = document.querySelectorAll('.friends-list');

            // Dynamically calculate the count of items in each list
            document.getElementById('following-count').textContent = document.querySelectorAll('#following .profile-card').length;
            document.getElementById('followers-count').textContent = document.querySelectorAll('#followers .profile-card').length;
            document.getElementById('blocked-count').textContent = document.querySelectorAll('#blocked .profile-card').length;

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
</body>
