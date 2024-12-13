<style>
    /* Error message style */
    .error {
      color: red;
      font-size: 14px;
      margin-top: 0px;
    }
</style>
<main class="main">

<section class="Welcome-back-section">
    <div class="Welcome-back-section-text">
        <h2 class="Welcome-back">Welcome back !</h2>
        <p>It's a pleasure to see you again</p>
    </div>
</section>

<section class="registration-section">
    <form class="registration-form" method="POST" action="/login">  <!-- Make sure the action points to the correct login handler -->

        <h1 class="legend">Login to Planet<span>There</span></h1>

        <!-- Email field -->
        <div class="Email-field">
            <label class="form-label" for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <!-- Display error if email is not provided -->
            <?php if (isset($_SESSION['login_errors']['email_err'])): ?>
                <p class="error"><?= $_SESSION['login_errors']['email_err']; ?></p>
                <?php unset($_SESSION['login_errors']['email_err']); ?>  <!-- Clear the error message after display -->
            <?php endif; ?>
        </div>

        <!-- Password field -->
        <div class="Password-field">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <p class="forgot-part">forgot your password ? Click <a href="/forgot-1">here</a></p>

            <!-- Display error if password is not provided -->
            <?php if (isset($_SESSION['login_errors']['password_err'])): ?>
                <p class="error"><?= $_SESSION['login_errors']['password_err']; ?></p>
                <?php unset($_SESSION['login_errors']['password_err']); ?>  <!-- Clear the error message after display -->
            <?php endif; ?>


            <!-- Display error if login failed -->
            <?php if (isset($_SESSION['login_errors']['login_err'])): ?>
                <p class="error"><?= $_SESSION['login_errors']['login_err']; ?></p>
                <?php unset($_SESSION['login_errors']['login_err']); ?>  <!-- Clear the error message after display -->
            <?php endif; ?>
        </div>

        <button class="sign-up-button" type="submit">Login</button>

    </form>
    <p class="footer-part">Don't have an account? Click <a href="#">here</a></p>
</section>

</main>
<?php
// Clear session errors after displaying
unset($_SESSION['login_errors']);
?>