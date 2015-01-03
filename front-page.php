<?php
	get_header();
	//$args = array( 'category_name' => 'romantic,adventure', 'tag' => 'destination', 'exculde' => '1' );
	//$myfilter = 'tag=destination';
	//$query = get_posts( $myfilter );
    //$destinations = get_categories( array('tag' => 'destination' , 'exclude' => '1') );
    // exclude => 1 is to exclude uncategorised posts
    $args = array ( 'post_type' => 'destination', 'post_status' => 'publish', 'exclude' => '1' );
    $categories = get_categories( $args );
    $destinations = new WP_Query( $args );
    //var_dump($destinations);
?>

<script type="text/javascript" xmlns="http://www.w3.org/1999/html">
    $( document).ready(function() {
        var herodiv = document.getElementById('herospace');
        herodiv.style.backgroundImage="url('<?php echo get_hero_image_url(); ?>')";

        $("div.featured-image").each(function(){
            // Uncomment the following if you need to make this dynamic
            var refH = $(this).height();
            var refW = $(this).width();
            var refRatio = refW/refH;

            var imgH = $(this).children("img").height();
            var imgW = $(this).children("img").width();

            if ( (imgW/imgH) < refRatio ) {
                $(this).addClass("portrait");
            } else {
                $(this).addClass("landscape");
            }
        });
        $("ul.category-title-list").each(function(){
            var numList = $(this).children().length;
            var liHeight = $(this).height();
            var isMobile = $('#mobile-device').is(':visible'); // || $('#tablet-device').is(':visible');
            var fontSize = $(this).css('font-size');
            fontSize = Math.floor(parseInt(fontSize.replace('px','')))+10;
            if ( !isMobile ) {
                var padding = ( (liHeight / numList) - fontSize ) / 2;
                //alert("padding = " + padding + " liHeight = " + liHeight + " numList = " + numList + " fontSize = " + fontSize);
                $(this).children("li").css('padding-top',  padding + 'px');
                $(this).children("li").css('padding-bottom', padding + 'px');

            }
            //alert(numList);
        });
        $("#newsletter-input").submit(function(event) {
            //Do the AJAX post
            event.preventDefault()
            var $form = $(this).find('form');

            var posting = $.post($form.attr('action'), $form.serialize(), function(data){
            });

            posting.done(function (data) {
                var tmp = $("#newsletter-input").css('display','none');
                $("#newsletter-success").css('display','inline');
            })
            posting.fail(function() {
                alert('Subscription failed! Please try again')
            })

            return false;
        });
    });
</script>

<a href="<?php echo get_hero_post_url(); ?>">
<div id="herospace" class="clearfix">
    <?php
    $hero_post = get_hero_post();
    $hero_post_id = $hero_post->ID;
    ?>
    <div class="post_title">
        <div class="post_title_content">
            <h4 class="feature-title">FEATURED DESTINATION</h4>
            <h1 class="post_title_heading"><?php echo get_the_title($hero_post_id); ?></h1>
            <h4 class="post_title_heading"><?php echo get_the_subtitle($hero_post_id); ?></h4>
        </div>
    </div>
    </div>
</div>
</a>
    <p class="hero-image-caption"><?php echo convert_caption_links(featured_image_caption($hero_post_id)); ?></p>


<div class="main clearfix">
	<div class="content clearfix">
		<div class="excerpt">
            <p><?php
                $home = get_page_by_title("home");
                echo $home->post_content;
            ?></p>
        </div>
        <?php

		if ( have_posts() ) {
			foreach ( $categories as $category ) :
                $posts = get_posts( array('category_name' => $category->slug, 'post_type' => 'destination') );
                ?>
                <div class="category clearfix">
                    <h2 class="category"><? echo $category->name ?></h2>
                    <div class="category-content">
                        <a href="<?php echo get_featured_post_url($category); ?>">
                            <div class="featured-image" style='background-image: url("<?php echo get_featured_image_url($category); ?>");'>
                                <!--<p class="hero-image-caption"><?php //echo featured_image_caption(get_featured_post_id( $category )); ?></p>-->
                            </div>
                        </a>
                        <p class="featured-image-caption"><?php echo convert_caption_links(featured_image_caption(get_featured_post_id( $category ))); ?></p>

                        <div class="category-titles">
                            <ul class="category-title-list">
                            <?php
                                foreach ( $posts as  $post ) :
                                    //var_dump($post);
                            ?>
                                <li><a href="<?php the_permalink(); ?>"> <?php the_title(); ?> </a></li>

                            <?php
                                endforeach;
                                wp_reset_postdata();
                                //the_content();
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            endforeach;
		}
		else { ?>
		<p>
			<?php _e( 'Sorry, there is not content to show at this time.')?>
		</p>
		<?php } ?>
    </div>

    <script type="text/javascript">
        //<![CDATA[
        if (typeof newsletter_check !== "function") {
            window.newsletter_check = function (f) {
                var re = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-]{1,})+\.)+([a-zA-Z0-9]{2,})+$/;
                if (!re.test(f.elements["ne"].value)) {
                    alert("The email is not correct");
                    return false;
                }
                if (f.elements["ny"] && !f.elements["ny"].checked) {
                    alert("You must accept the privacy statement");
                    return false;
                }
                return true;
            }
        }
        //]]>



    </script>

</div>


    <div class="newsletter newsletter-subscription clearfix">

        <h3 class="left-align">Why should you book with us?</h3>
        <ul class="usp-list">
            <li><strong>We Value Unique Experiences:</strong> Enjoy from our handpicked collection of one-of-a-kind accommodations</li>
            <li><strong>You can live like a local:</strong> Allow us to plan your vacation with activities that allow you to really live like a local</li>
            <li><strong>Best rate, best value:</strong> These destinations are one of a kind and we only offer the best value for your money</li>
        </ul>

        <div class="newsletter-content">
            <p class="subscription-text1">Subscribe to our newsletter for special offers and packages</p>
            <div id="newsletter-input">
                <form method="post" action="<?php echo plugins_url(); ?>/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">
                        <input class="newsletter-email" type="email" name="ne" size="30" required placeholder="Your email address">
                        <input class="newsletter-submit" type="submit" value="Subscribe"/>
                </form>
            </div>
            <div id="newsletter-success">Thank You for Subscribing!</div>
        </div>
    </div>

<div id="mobile-device"></div>
<div id="tablet-device"></div>


<?php get_footer(); ?>