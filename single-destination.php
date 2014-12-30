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

	<div id="herospace">
		<div class="layer clearfix"></div>
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				$category_slug = get_the_category()[0]->slug;
				$post_id = get_the_ID();
				?>
		<div class="post_title">
			<div class="post_title_content">
				<h1 class="post_title_heading"><?php the_title(); ?></h1>
				<h4 class="post_title_heading"><?php the_subtitle(); ?></h4>
			</div>
		</div>

	</div>

	<div class="contact-us"></div>

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
		<?php
			$args = array( 'category_name' => $category_slug, 'post_type' => 'destination', 'post__not_in' => array ( $post_id ) );
			$related_destinations = new WP_Query( $args );
			if ( $related_destinations->found_posts > 0 ) { ?>
			<h4 class="related-destinations">You might also like:</h4>
			<?php }
			while ( $related_destinations->have_posts() ) : $related_destinations->the_post();
				?><div class="related-destination">
				<a href="<?php the_permalink(); ?>">
					<div class="related-destination-img"><?php the_post_thumbnail( array(270, 170) );?></div>
					<h5 class="related-destination-title"><?php the_title(); ?></h5>
				</a>
				</div>
				<?php
			endwhile;
			//var_dump($related_destinations);
		?>
	</div>

<?php get_footer(); ?>