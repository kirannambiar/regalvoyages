<?php
	get_header();
	//$args = array( 'category_name' => 'romantic,adventure', 'tag' => 'destination', 'exculde' => '1' );
	$myfilter = 'tag=destination';
	$query = get_posts( $myfilter );
    $destCategories = get_categories( array('tag' => 'destination' , 'exclude' => '1') );

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
    });
</script>

<div id="herospace" class="clearfix">
    <img src="">
</div>


<div class="main clearfix">
	<div class="content clearfix">
		<?php
		if ( have_posts( $myfilter ) ) {
			foreach ( $destCategories as $category ) :
                $posts = get_posts( array('category_name' => $category->slug) );
                ?>
                <div class="category clearfix">
                    <h1 class="category"><? echo $category->name ?></h1>
                    <div class="category-content">
                        <div class="featured-image">
                            <img class="featured-image" src="<?php echo get_featured_image_url($category); ?>">
                        </div>
                        <div class="category-titles">
                            <ul class="category-title-list">
                            <?php
                                foreach ( $posts as  $post ) :
                            ?>
                                <li><a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a></li>

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
</div>
<div id="mobile-device"></div>
<div id="tablet-device"></div>


<?php get_footer(); ?>