<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Planet There</title>
        <link rel="icon" href="/assets/images/favicon.png" type="image/png">
		<?php
    // Determine the path prefix based on the current route
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $pathPrefix = (count($segments) > 1) ? '../' : '';  // If there are more than 1 segment, go up one level
    ?>
    <link rel="stylesheet" href="<?php echo $pathPrefix . 'assets/css/navbar.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . 'assets/css/global.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . 'assets/css/footer.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . 'assets/fonts/fontawesome-free-6.7.2-web/css/all.min.css' ?>" />



    <link rel="stylesheet" href="<?php
        switch (getCurrentRoute()) {
            case '':
                echo $pathPrefix . 'assets/css/homepage.css';
                break;
            case 'about':
                echo $pathPrefix . 'assets/css/about-us.css';
                break;
            case 'faq':
                echo $pathPrefix . 'assets/css/faq.css';
                break;
            case 'tac':
                echo $pathPrefix . 'assets/css/terms.css';
                break;
            case 'account':
                echo $pathPrefix . 'assets/css/account.css';
                break;
            case 'event-history':
                echo $pathPrefix . 'assets/css/events-history.css';
                break;
            case 'profile-settings':
                echo $pathPrefix . 'assets/css/profile-settings.css';
                break;
            case 'unauthorized':
                echo $pathPrefix . 'assets/css/blocked.css';
                break;
            case 'signup-1':
                echo $pathPrefix . 'assets/css/signup-1.css';
                break;
            case 'signup-2':
                echo $pathPrefix . 'assets/css/signup-2.css';
                break;
            case 'login':
                echo $pathPrefix . 'assets/css/login.css';
                break;
            case 'forgot-1':
                echo $pathPrefix . 'assets/css/forgot-1.css';
                break;
            case 'forgot-2':
                echo $pathPrefix . 'assets/css/forgot-2.css';
                break;
            case 'event-search':
                echo $pathPrefix . 'assets/css/event-search.css';
                break;
            case 'user-search':
                echo $pathPrefix . 'assets/css/user-search.css';
                break;
            case 'settings':
                echo $pathPrefix . 'assets/css/settings.css';
                break;
            case 'create-event1':
                echo $pathPrefix . 'assets/css/create-event-1.css';
                break;
            case 'create-event2':
                echo $pathPrefix . 'assets/css/create-event-2.css';
                break;
            case 'friends':
                echo $pathPrefix . 'assets/css/friends.css';
                break;
            case 'profile':
                echo $pathPrefix . 'assets/css/user-profile.css';
                break;
            case 'event':
                echo $pathPrefix . 'assets/css/event-view.css';
                break;
            case 'event-attendees':
                echo $pathPrefix . 'assets/css/event-attendees.css';
                break;

             case 'event-waitlist':
                echo $pathPrefix . 'assets/css/event-attendees.css';
                break;
            case 'blocked':
                echo $pathPrefix . 'assets/css/blocked.css';
                break;
            case 'createAcc':
                echo $pathPrefix . 'assets/css/blocked.css';
                break;
            default:
                echo $pathPrefix . 'assets/css/global.css';
                break;
        }
    ?>" />

    <!-- Add a script to detect the screen size -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const smallScreen = window.matchMedia("(max-width: 768px)").matches;
            document.cookie = `screenType=${smallScreen ? 'small' : 'large'}; path=/`;
        });
    </script>

    </head>

    <body>
    <?php
        require views_path('partials/navbar.php');
    ?>
    <?php echo $content; ?>
    <?php
    // Include the correct footer dynamically

        require views_path('partials/footer.php');
    ?>
    </body>

</html>