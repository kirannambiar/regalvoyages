<html>
	<head>
		<title> <?php bloginfo('name'); ?> </title>
		
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

		<link href='http://fonts.googleapis.com/css?family=Fira+Sans:300,400,500,700,300italic,400italic,500italic,700italic' rel='stylesheet' type='text/css'>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-11556925-4', 'auto');
			ga('send', 'pageview');

		</script>

		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
		<?php wp_head(); ?>
		
	</head>
	<body>
        <div class="top-bar clearfix">
			<div class="top-bar-content">
				<div class="logo">
					<a href="/">
						<img class="logo" src="<?php echo get_template_directory_uri(); ?>/images/FullLogo.jpg"/>
					</a>
				</div>
				<div class="menu-container">
					<?php wp_nav_menu( array('menu' => 'Main Nav') ); ?>
				</div>
			</div>
        </div>