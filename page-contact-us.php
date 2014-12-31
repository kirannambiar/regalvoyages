<?php get_header(); ?>

    <script>
        $(document).ready(function () {

            // you want to enable the pointer events only on click;
            $('#location-map').addClass('scrolloff'); // set the pointer events to none on doc ready
            $('#map-canvas').on('click', function () {
                $('#location-map').removeClass('scrolloff'); // set the pointer events true on click
            });

            // you want to disable pointer events when the mouse leave the canvas area;

            $("#location-map").mouseleave(function () {
                $('#location-map').addClass('scrolloff'); // set the pointer events to none when mouse leaves the map area
            });
        });
    </script>

    <div class="main clearfix">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 class="post_title no-hero"><?php the_title(); ?></h1>
            <div class="content clearfix"><?php the_content(); ?></div>
        <?php endwhile; else: ?>
            <p>
                <?php _e( 'Sorry, there is not content to show at this time.') ?>
            </p>
        <?php endif; ?>
        <section id="map-canvas">
            <iframe id="location-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.4413771743702!2d77.57830359877654!3d13.007540865676921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae163392f9127d%3A0xef1c15df201b46ed!2s598%2F18%2F2%2C+11th+Cross+Rd%2C+Sadashiva+Nagar%2C+Armane+Nagar%2C+Bengaluru%2C+Karnataka+560080!5e0!3m2!1sen!2sin!4v1419950681190" frameborder="0" style="border:0"></iframe>
        </section>

        <div class="content">
            <h3>We also provide Services such as:</h3>
            <ul>
                <li>Tickets for Domestic and International Travel</li>
                <li>Travel Insurance</li>
                <li>Assistance with Visa applications</li>
                <li>Assistance with Passport applications</li>
                <li>Hotel Accommodation</li>
                <li>Complete tour packages</li>
                <li>Cruise Packages</li>
                <li>Group tour packages with Globus, Cosmos and Trafalgar</li>
            </ul>
        </div>

    </div>

<?php get_footer(); ?>