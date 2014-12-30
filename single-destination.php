<?php get_header(); ?>

<script type="text/javascript">
	$( document).ready(function() {

		var herodiv = document.getElementById('herospace');
		herodiv.style.backgroundImage = "url('<?php
        $dom = simplexml_load_string(get_the_post_thumbnail($post->ID, array(2048,1536)));
        $imgSrc = $dom->attributes()->src;
        echo $imgSrc;
        ?>')"
	});
</script>

	<div id="herospace" class="clearfix"></div>

	<div class="main clearfix">
		<?php
			if ( have_posts() ) : while ( have_posts() ) : $post = the_post(); ?>
				<h2 class="post_title"><?php the_title(); ?></h2>
				<div class="content clearfix"><?php the_content(); ?></div>
		<?php endwhile; else: ?>
			<p>
				<?php _e( 'Sorry, there is not content to show at this time.') ?>
			</p>
		<?php endif; ?>
	</div>

	<div class="related-destinations">
		<?php
			$args = array( 'category_name' => $post->category, 'tag' => 'destination', 'exculde' => '1' );
		?>
	</div>

<?php get_footer(); ?>