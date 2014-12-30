<?php get_header(); ?>

<script type="text/javascript">
	$( document).ready(function() {

		var herodiv = document.getElementById('herospace');
		herodiv.style.backgroundImage = "url('<?php
        $dom = simplexml_load_string(get_the_post_thumbnail());
        $imgSrc = $dom->attributes()->src;
        echo $imgSrc;
        ?>')"
	});
</script>

	<div id="herospace" class="clearfix">
	<div class="layer"></div>
	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$category_slug = get_the_category()[0]->slug;
			$post_id = get_the_ID();
			?>
			<div class="post_title"><h1 class="post_title"><?php the_title(); ?></h1></div>

	</div>

	<div class="main clearfix">

				<div class="content clearfix"><?php the_content(); ?></div>
		<?php
			endwhile; else: ?>
			<p>
				<?php _e( 'Sorry, there is not content to show at this time.') ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="related-destinations">
		<h4>Related Destinations</h4>
		<?php
			$args = array( 'category_name' => $category_slug, 'post_type' => 'destination', 'post__not_in' => array ( $post_id ) );
			$related_destinations = new WP_Query( $args );
			while ( $related_destinations->have_posts() ) : $related_destinations->the_post();
				?><div class="related-destination">
				<a href="<?php the_permalink(); ?>"> <?php the_title(); ?>
				<?php the_post_thumbnail( array(150, 150) );?>
				</a>
				</div>
				<?php
			endwhile;
			//var_dump($related_destinations);
		?>
	</div>

<?php get_footer(); ?>