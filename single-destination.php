<?php get_header(); ?>

<h1>destination page</h1>
<div class="main clearfix">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<h2 class="post_title"><?php the_title(); ?></h2>
			<h2 class="post_title"><?php the_category(); ?></h2>

			<div class="content clearfix"><?php the_content(); ?></div>
		<?php endwhile; else: ?>
			<p>
				<?php _e( 'Sorry, there is not content to show at this time.') ?>
			</p>
		<?php endif; ?>
</div>

<?php get_footer(); ?>