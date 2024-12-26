
    <div class="settings-page">
        <!-- Header -->
        <header class="settings-header">
            <h1>Settings</h1>
            <p>Adjust your preferences</p>
        </header>

        <!-- Settings Options -->
        <section class="settings-options">
            <!-- Language Selection -->
            <div class="settings-item">
                <label for="language-select">Choose your <span class="highlight">language</span>:</label>
                <select id="language-select" class="dropdown">
                    <option value="english">English</option>
                    <option value="french">French</option>
                </select>
            </div>

            <!-- Dark Mode Toggle -->
            <div class="settings-item">
                <label for="dark-mode-toggle">Enable <span class="highlight">Dark Mode</span>:</label>
                <div class="switch">
                    <input type="checkbox" id="dark-mode-toggle">
                    <div class="slider"></div>
                </div>
            </div>

            <!-- Privacy Toggle -->
            <div class="settings-item">
                <label for="privacy-toggle">Attended Event <span class="highlight">Privacy</span>:</label>
                <div class="switch">
                    <input type="checkbox" id="privacy-toggle">
                    <div class="slider"></div>
                </div>
            </div>

            <!-- Notification Settings Toggle -->
            <div class="settings-item">
                <label for="notifications-toggle"><span class="highlight">Notification</span> settings:</label>
                <div class="switch">
                    <input type="checkbox" id="notifications-toggle">
                    <div class="slider"></div>
                </div>
            </div>

            <!-- Password Change -->
            <section class="password-change">
                <h2>Change your <span class="highlight">password</span></h2>
                <form class="password-form">
                    <input type="password" placeholder="Enter your new password" required>
                    <input type="password" placeholder="Confirm your new password" required>
                    <button type="submit" class="save-button">Save Changes</button>
                </form>
            </section>
        </section>

        
    </div>


