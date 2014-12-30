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

<script type="text/javascript">
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
            var isMobile = $('#mobile-device').is(':visible') || $('#tablet-device').is(':visible');
            if ( !isMobile ) {
                $(this).children("li").css('line-height', liHeight / numList + 'px');
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

<div id="herospace" class="clearfix">
</div>


<div class="main clearfix">
	<div class="content clearfix">
		<?php
		if ( have_posts() ) {
			foreach ( $categories as $category ) :
                $posts = get_posts( array('category_name' => $category->slug, 'post_type' => 'destination') );
                ?>
                <div class="category clearfix">
                    <h1 class="category"><? echo $category->name ?></h1>
                    <div class="category-content">
                        <div class="featured-image">
                            <a href="<?php echo get_featured_post_url($category); ?>"><img class="featured-image" src="<?php echo get_featured_image_url($category); ?>"></a>
                        </div>
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
        <p class="subscription-text1">Sign up for our newsletter</p>
        <p class="subscription-text2">Find out about our special offers and vacation packages</p>
        <div id="newsletter-input">
            <form method="post" action="http://localhost:8888/wp-content/plugins/newsletter/do/subscribe.php" onsubmit="return newsletter_check(this)">
                    <input class="newsletter-email" type="email" name="ne" size="30" required placeholder="Your email address">
                    <input class="newsletter-submit" type="submit" value="Subscribe"/>
            </form>
        </div>
        <div id="newsletter-success">Thank You for Subscribing!</div>
    </div>

<div id="mobile-device"></div>
<div id="tablet-device"></div>


<?php get_footer(); ?>