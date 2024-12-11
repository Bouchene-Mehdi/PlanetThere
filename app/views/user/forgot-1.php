<?php
// Start the session (if not already started)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}else{
  unset($_SESSION['forgot_errors']);
}
?>

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

    <!-- Display error message for email if it exists -->
    <?php if (!empty($_SESSION['forgot_errors']['email_err'])): ?>
      <div class="error-message">
        <p><?php echo htmlspecialchars($_SESSION['forgot_errors']['email_err']); ?></p>
      </div>
    <?php endif; ?>

    <form class="registration-form" action="/user/forgot-password-1" method="POST">
      <div class="legend-section">
        <h1 class="legend">Forgot your password?</h1>
        <p class="legend-subtext">Happens to the best of us</p>
      </div>

      <div class="Email-field">
        <label class="form-label" for="email">Email address</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="Enter your email address" 
          value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" 
          required>
      </div>

      <button class="sign-up-button" type="submit">Send email verification</button>
    </form>
  </section>
</main>
<?php
// Clear session errors after displaying
unset($_SESSION['forgot_errors']);

?>
