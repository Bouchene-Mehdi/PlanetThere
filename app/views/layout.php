<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Planet There</title>
		<!-- Using PHP to echo the paths inside href -->
		<link rel="stylesheet" href="<?php echo 'assets/css/navbar.css'; ?>" />
		<link rel="stylesheet" href="<?php echo 'assets/css/global.css'; ?>" />
        <link rel="stylesheet" href="<?php echo 'assets/css/footer.css'; ?>" />
		<link rel="stylesheet" href="<?php 
				switch (getCurrentRoute()) {
					case '':
						echo 'assets/css/homepage.css';
						break;
					case 'about':
						echo 'assets/css/about-us.css';
						break;
					case 'faq':
						echo 'assets/css/faq.css';
						break;
					case 'tac':
						echo 'assets/css/terms.css';
						break;
					case 'account':
						echo 'assets/css/account.css';
						break;
					case 'event-history':
						echo 'assets/css/events-history.css';
						break;
					case 'profile-settings':
						echo 'assets/css/profile-settings.css';
						break;
					default:
						echo 'assets/css/global.css';
						break;
			
				}
				?>" />
	</head>
	<body>

        <?php 
            // Include the navbar dynamically
            require views_path('partials/navbar-out.php'); 
        ?>
        <?php echo $content; ?>
        <?php 
            // Include the footer dynamically
            require views_path('partials/footer.php'); 
        ?>
	</body>
</html>