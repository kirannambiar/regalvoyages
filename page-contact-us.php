<?php get_header(); ?>

    <div class="main clearfix">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h2 class="post_title"><?php the_title(); ?></h2>
            <div class="content clearfix"><?php the_content(); ?></div>
        <?php endwhile; else: ?>
            <p>
                <?php _e( 'Sorry, there is not content to show at this time.') ?>
            </p>
        <?php endif; ?>

        <iframe id="location-map" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3887.3855479736285!2d77.57681291534426!3d13.011102398533753!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae16332ce53759%3A0x1bffdeba5bb6e333!2sRegal+Voyages!5e0!3m2!1sen!2sin!4v1419816489337" frameborder="0" style="border:0"></iframe>

    </div>

<?php get_footer(); ?>