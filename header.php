<html>
	<head>
		<title> <?php bloginfo('name'); ?> </title>
		
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
		<!-- <link href="//fonts.googleapis.com/css?family=Lato:100italic,100,300italic,300,400italic,400,700italic,700,900italic,900" rel="stylesheet" type="text/css"> -->

		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
		
		<?php wp_head(); ?>
		
	</head>
	<body>
        <div class="top-bar clearfix">
            <div class="logo"><p>Regal Voyages</p></div>
            <?php wp_nav_menu( array('menu' => 'Main Nav') ); ?>
        </div>