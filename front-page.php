<?php
	get_header();
	$args = array( 'category_name' => 'romantic,adventure', 'tag' => 'destination' );
	//filtering on known categories
	//$myfilter = 'category_name=romantic+adventure';
	$myfilter = 'tag=destination';
	$query = get_posts( $args );
?>

<div id="main">
	<div id="content clearfix">
		<p>this is using front-page.php</p>
		<?php echo var_dump($query) ?>
		<?php 
		if ( have_posts( $myfilter ) ) {
			foreach ( $query as $post) : 
				setup_postdata($post);
				$t = wp_get_post_tags($post->ID, array( 'fields' => 'names' ));
				echo "<p>tag for this post is + " + print_r($t) + "</p>";
				?>
			<h3><a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a></h3>

			<!--<p> <?php the_content(); ?> </p>-->
			
		<?php endforeach;
		wp_reset_postdata();
		}
		else { ?>
		<p>
			<?php _e( 'Sorry, there is not content to show at this time.')?>
		</p>
		<?php } ?>
	</div>
</div>


<?php get_footer(); ?>