<?php get_header(); ?>

<script type="text/javascript">
	$(document).ready(function() {
		var herodiv = document.getElementById('herospace-destination');
		herodiv.style.backgroundImage = "url('<?php
        $dom = simplexml_load_string(get_the_post_thumbnail());
        $imgSrc = $dom->attributes()->src;
        echo $imgSrc;
        ?>')"
	});


	$(window).load(function(){
	   $('.wp-caption').find('img').each(function(){
	   	  var filldiv = $('.wp-caption');
		  var fillmeval = filldiv.width()/filldiv.height();
		  var imgval = $(this).width()/$(this).height();
		  var imgClass;
		  if(imgval > fillmeval){
			  imgClass = "stretchy";
		  }else{
			  imgClass = "stretchx";
		  }
		  filldiv.children('img').addClass(imgClass);
	   });
	});
</script>
	<div id="herospace-destination" class="clearfix">
			<p class="hero-image-caption"><?php echo convert_caption_links(featured_image_caption($post_id)); ?></p>
		<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post();
				$category_slug = get_the_category()[0]->slug;
				$post_id = get_the_ID();
				?>
	</div>

	<div class="main clearfix">

		<div class="post_title">
			<div class="post_title_content clear-background">
				<h1 class="post_title_heading"><?php the_title(); ?></h1>
				<h4 class="post_title_heading"><?php the_subtitle(); ?></h4>
			</div>
		</div>

		<div class="content clearfix"><?php the_content(); ?></div>
		<?php
			endwhile; else: ?>
			<p>
				<?php _e( 'Sorry, there is not content to show at this time.') ?>
			</p>
		<?php endif; ?>
		<a href="/contact-us">
			<div id="destinations-contact-us">
				<h4>Contact Us</h4>
				<h5>for the best package & pricing</h5>
			</div>
		</a>
	</div>

	<div class="related-destinations">
		<div class="related-destinations-content">
			<?php
				$args = array( 'category_name' => $category_slug, 'post_type' => 'destination', 'post__not_in' => array ( $post_id ) );
				$related_destinations = new WP_Query( $args );
				if ( $related_destinations->found_posts > 0 ) { ?>
				<h4 class="related-destinations">You might also like:</h4>
				<?php }
				while ( $related_destinations->have_posts() ) {
					$related_destinations->the_post();
					$related_destination_id = get_the_ID();
					?>
					<div class="related-destination">
					<a href="<?php the_permalink(); ?>">
						<div class="related-destination-img" style='background-image: url(" <?php
							$image_src = wp_get_attachment_image_src(get_post_thumbnail_id($related_destination_id), array(480,480));
							echo $image_src[0]; ?>")'"></div>
						<h5 class="related-destination-title"><?php the_title(); ?></h5>
					</a>
					</div>
				<?php
				}
				//var_dump($related_destinations);
			?>
		</div>
	</div>

<?php get_footer(); ?>