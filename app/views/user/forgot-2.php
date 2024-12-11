<style>
  /* Styling for success and error messages */
  .success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
  }

  .error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
  }
</style>


<main class="main">
  <section class="Welcome-back-section">
    <div class="Welcome-back-section-text">
      <h2 class="Welcome-back">Everyone forgets</h2>
      <p class="welcome-back-subtext">But don't worry, you have an infinite amount of tries.</p>
    </div>
  </section>

  <section class="registration-section">
    <!-- Display success message if it exists -->
    <?php if (!empty($_SESSION['forgot_success'])): ?>
      <div class="success-message">
        <p><?php echo htmlspecialchars($_SESSION['forgot_success']); ?></p>
      </div>
      <?php unset($_SESSION['forgot_success']); // Clear the message after displaying ?>
    <?php endif; ?>

    <form class="registration-form" action="/user/forgot-password-2" method="POST">
      <h1 class="legend">Last steps</h1>

	  <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>">

      <div class="Enter-password-field">
        <label class="form-label" for="password">Enter your new password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password here" required>
        <?php if (!empty($_SESSION['forgot_errors']['password_err'])): ?>
          <div class="error-message">
            <p><?php echo htmlspecialchars($_SESSION['forgot_errors']['password_err']); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <div class="Confirm-password-field">
        <label class="form-label" for="confirm_password">Confirm your password</label>
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
        <?php if (!empty($_SESSION['forgot_errors']['confirm_password_err'])): ?>
          <div class="error-message">
            <p><?php echo htmlspecialchars($_SESSION['forgot_errors']['confirm_password_err']); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <button class="sign-up-button" type="submit">Change Password</button>
    </form>
  </section>
</main>
<?php
// Clear session errors after displaying
unset($_SESSION['forgot_errors']);

?>
