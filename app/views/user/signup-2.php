
<style>
    /* Error message style */
    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 0px;
    }
  </style>
<main class="main">

    <section class="Join-us-section">
        <div class="join-us-section-text">
            <h2 class="join-us-today">Join us today!</h2>
            <p>We are waiting for you!</p>
        </div>
    </section>
	
    <section class="registration-section">
        <form class="registration-form" method="POST" action="/user/register-2" enctype="multipart/form-data">
            <!-- Form Title -->
            <div class="legend-section">
                <h1 class="legend">Last <span style="color: #009688;">Steps</span> <span style="font-weight: 100;">!</span></h1>
                <p class="legend-subtext">Let us know you a little bit better!</p>
            </div>

            <!-- Profile Picture Upload Section -->
            <div class="pic-upload-section">
                <div class="uppload-description">
                    <h2>Upload your profile picture:</h2>
                    <p>Accepted formats: jpeg, png</p>
                </div>

                <div class="upload-button">
                    <label for="file-upload" class="file-upload-button">Upload File</label>
                    <input type="file" id="file-upload" name="profile_picture" accept="image/jpeg, image/png">
                </div>
            </div>

            <!-- Placeholder Image -->
            <div class="image-sec">
                <img src="assets/images/insert-image.png" alt="pictures illustration">
            </div>

            <!-- Last Name Field -->
            <div class="Last-name-field">
                <label class="form-label name-label" for="LastName">Last name</label>
                <input class="Last-name-field-field" type="text" id="LastName" name="last_name" placeholder="Enter your last name" value="<?php echo isset($_SESSION['page2_errors']['last_name']) ? $_SESSION['page2_errors']['last_name'] : ''; ?>" required>
                <?php if (!empty($_SESSION['page2_errors']['last_name_err'])): ?>
                    <div class="error-message"><?php echo $_SESSION['page2_errors']['last_name_err']; ?></div>
                <?php endif; ?>
            </div>

            <!-- First Name Field -->
            <div class="First-name-field">
                <label class="form-label name-label" for="FirstName">First name</label>
                <input type="text" id="FirstName" name="first_name" placeholder="Enter your first name" value="<?php echo isset($_SESSION['page2_errors']['first_name']) ? $_SESSION['page2_errors']['first_name'] : ''; ?>" required>
                <?php if (!empty($_SESSION['page2_errors']['first_name_err'])): ?>
                    <div class="error-message"><?php echo $_SESSION['page2_errors']['first_name_err']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Phone Number Field -->
            <div class="phone-field">
                <label class="form-label" for="phone">Enter your phone number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" pattern="[0-9]{10}" value="<?php echo isset($_SESSION['page2_errors']['phone']) ? $_SESSION['page2_errors']['phone'] : ''; ?>" required>
                <?php if (!empty($_SESSION['page2_errors']['phone_err'])): ?>
                    <div class="error-message"><?php echo $_SESSION['page2_errors']['phone_err']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Date of Birth Field -->
            <div class="dobField">
                <label class="form-label" for="dateofbirth">Enter your date of birth*</label>
                <input type="date" id="dob" name="dob" value="<?php echo isset($_SESSION['page2_errors']['dob']) ? $_SESSION['page2_errors']['dob'] : ''; ?>" required>
                <?php if (!empty($_SESSION['page2_errors']['dob_err'])): ?>
                    <div class="error-message"><?php echo $_SESSION['page2_errors']['dob_err']; ?></div>
                <?php endif; ?>
            </div>

            <!-- Finalize Button -->
            <button class="sign-up-button" type="submit">Finalize</button>
        </form>
        <p class="footer-part">Already have an account? Click <a href="#">here</a></p>
    </section>

</main>
<?php
// Clear session errors after displaying
unset($_SESSION['page2_errors']);
?>
