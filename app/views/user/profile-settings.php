
<body>
    <div class="profile-settings">

        <!-- Combined Header -->
        <header class="combined-header">
            <div class="profile-header">
                <img src="assets/images/profile-image.JPG" alt="Profile Picture" class="profile-picture">
                <div>
                    <h1>Jean Michel</h1>
                    <p class="email">jeanmichel@gmail.com</p>
                </div>
            </div>
            <div class="page-header">
                <h1>Personal Information</h1>
                <p class="page-subheader">Configure your privacy</p>
            </div>

            <div class="follows-header">
                <img src="assets/images/follows-icon.svg" alt="Follows" class="follows-icon">
                <div class="followers">
                    <span class="label">Followers</span>
                    <br>
                    <span class="value">123</span>
                </div>
                <div class="followers">
                    <span class="label">Following</span>
                    <br>
                    <span class="value">123</span>
                </div>
            </div>
        </header>
    
        <!-- Profile Form -->
        <form class="profile-form">
            <!-- Username and Email -->
            <div class="form-row">
                <label for="username">Username</label>
                <input type="text" id="username" value="Billiejean12" readonly>
            </div>
            <div class="form-row">
                <label for="email">Email</label>
                <div class="input-wrapper">
                    <input type="email" id="email" value="jeanmichel@gmail.com" readonly>
                    <select>
                        <option>Friends</option>
                        <option>Public</option>
                        <option>Private</option>
                    </select>
                </div>
            </div>
    
            <!-- Name and Surname -->
            <div class="form-row">
                <label for="name">Name</label>
                <div class="input-wrapper">
                    <input type="text" id="name" value="Jean">
                    <select>
                        <option>Public</option>
                        <option>Friends</option>
                        <option>Private</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <label for="surname">Surname</label>
                <div class="input-wrapper">
                    <input type="text" id="surname" value="Michel">
                    <select>
                        <option>Friends</option>
                        <option>Public</option>
                        <option>Private</option>
                    </select>
                </div>
            </div>
    
            <!-- Phone Number and Date of Birth -->
            <div class="form-row">
                <label for="phone">Phone number</label>
                <div class="input-wrapper">
                    <input type="tel" id="phone" value="+33 12 34 56 78">
                    <select>
                        <option>Private</option>
                        <option>Public</option>
                        <option>Friends</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <label for="dob">Date of Birth</label>
                <div class="input-wrapper">
                    <input type="date" id="dob" value="2001-01-01" readonly>
                    <select>
                        <option>Friends</option>
                        <option>Public</option>
                        <option>Private</option>
                    </select>
                </div>
            </div>
    
            <!-- Save Button -->
            <button type="submit" class="save-button">Save</button>
        </form>
    </div>    
</body>