<?php get_header(); ?>

<div id="main">
	<div id="content clearfix">
		<p>this is using front-page.php</p>
		<?php if ( have_posts() ) : while ( have_posts() ) :the_post(); ?>
			
		<?php endwhile; 
			else: ?>
			<p>
				<?php _e( 'Sorry, there is not content to show at this time.')?>
			</p>
		<?php endif; ?>
	</div>
</div>


<?php get_footer(); ?>