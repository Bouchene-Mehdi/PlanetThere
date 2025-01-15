<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Planet There</title>
		<?php
    // Determine the path prefix based on the current route
    $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
    $pathPrefix = (count($segments) > 1) ? '../' : '';  // If there are more than 1 segment, go up one level
    ?>
    <link rel="stylesheet" href="<?php echo $pathPrefix . '../assets/css/navbar.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . '../assets/css/global.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . '../assets/css/footer.css'; ?>" />
    <link rel="stylesheet" href="<?php echo $pathPrefix . '../assets/fonts/fontawesome-free-6.7.2-web/css/all.min.css' ?>" />

    <link rel="stylesheet" href="<?php
        switch (getCurrentRoute()) {
            case 'AdminEvent':
                echo $pathPrefix . '../assets/css/eventlist.css';
                break;
            case 'AdminUsers':
                echo $pathPrefix . '../assets/css/userlist.css';
                break;
            case 'AdminBanned':
                echo $pathPrefix . '../assets/css/bannedusers.css';
                break;
            case 'AdminPropositions':
                echo $pathPrefix . '../assets/css/bannedusers.css';
                break;
            case 'Dashboard':
                echo $pathPrefix . '../assets/css/dashboard.css';
                break;
            case 'AdminFaq':
                echo $pathPrefix . '../assets/css/AdminFAQ.css';
                break;
            case 'AdminT':
                echo $pathPrefix . '../assets/css/AdminTAC.css';
                break;

            default:
                echo $pathPrefix . '../assets/css/global.css';
                break;
        }
    ?>" />

    </head>

    <body>
        <header>
        <?php
        require views_path('partials/navbar_admin.php');
        ?>
        </header>

    <main>

    <?php
        require views_path('partials/sidebar_admin.php');
    ?>
    <?php echo $content; ?>
    </main>
    <?php 
        require views_path('partials/footer.php');
    ?>
    </body>
</html>

