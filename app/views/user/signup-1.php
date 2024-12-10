<style>
    /* Error message style */
    .error-message {
      color: red;
      font-size: 14px;
      margin-top: 0px;
    }
  </style>
<main class="main">
  <section class="registration-section">
    <form class="registration-form" method="POST" action="/user/register-1">
      <div class="legend-section">
        <h1 class="legend">Sign up to Planet<span style="color: #009688;">There</span></h1>
        <p class="legend-subtext">Fill this quick form and join our event life!</p>
      </div>

      <div class="Username-field">
        <label class="form-label" for="username">Username</label>
        <input 
          type="text" 
          id="username" 
          name="username" 
          placeholder="Enter your username" 
          value="<?php echo isset($_SESSION['signup_errors']['username']) ? htmlspecialchars($_SESSION['signup_errors']['username']) : ''; ?>"
        >
        <?php if (!empty($_SESSION['signup_errors']['username_err'])): ?>
          <div class="error-message"><?php echo $_SESSION['signup_errors']['username_err']; ?></div>
        <?php endif; ?>
      </div>
      <div class="Email-field">
        <label class="form-label" for="email">Email address</label>
        <input 
          type="email" 
          id="email" 
          name="email" 
          placeholder="Enter your email address" 
          value="<?php echo isset($_SESSION['signup_errors']['email']) ? htmlspecialchars($_SESSION['signup_errors']['email']) : ''; ?>"
        >
        <?php if (!empty($_SESSION['signup_errors']['email_err'])): ?>
          <div class="error-message"><?php echo $_SESSION['signup_errors']['email_err']; ?></div>
        <?php endif; ?>
      </div>

      <div class="Password-field">
        <label class="form-label" for="password">Create password</label>
        <input 
          type="password" 
          id="password" 
          name="password" 
          placeholder="Enter your password"
        >
        <?php if (!empty($_SESSION['signup_errors']['password_err'])): ?>
          <div class="error-message"><?php echo $_SESSION['signup_errors']['password_err']; ?></div>
        <?php endif; ?>
      </div>

      <div class="Confirm-password-field">
        <label class="form-label" for="confirm_password">Confirm password</label>
        <input 
          type="password" 
          id="confirm_password" 
          name="confirm_password" 
          placeholder="Confirm your password"
        >
        <?php if (!empty($_SESSION['signup_errors']['confirm_password_err'])): ?>
          <div class="error-message"><?php echo $_SESSION['signup_errors']['confirm_password_err']; ?></div>
        <?php endif; ?>
      </div>

      <button class="sign-up-button" type="submit">Sign-up</button>
    </form>
    <p class="footer-part">Already have an account? Click <a href="/">here</a></p>
  </section>

  <section class="Join-us-section">
    <div class="join-us-section-text">
      <h2 class="join-us-today">Join us today !</h2>
      <p>We are waiting for you !</p>
    </div>
  </section>

</main>

<?php
// Clear session errors after displaying
unset($_SESSION['signup_errors']);
?>
