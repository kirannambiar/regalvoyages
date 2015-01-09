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
            <div class="content contact-page clearfix"><?php the_content(); ?></div>
        <?php endwhile; else: ?>
            <p>
                <?php _e( 'Sorry, there is not content to show at this time.') ?>
            </p>
        <?php endif; ?>
        <section id="map-canvas">
            <iframe id="location-map" src="https://www.google.com/maps/embed/v1/place?q=598/18/1,+11th+Cross+Rd+Sadashiva+Nagar,+Armane+Nagar+Bengaluru,+Karnataka+560080&key=AIzaSyAw9ZWaIC9-vc4jshPiijmi61m8dh270PI" frameborder="0" style="border:0"></iframe>
        </section>

        <div class="content">
            <h3 class="left-align">We also provide Services such as:</h3>
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