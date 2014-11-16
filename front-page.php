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
    });
</script>

<div id="herospace">

</div>


<div class="main">
	<div class="content clearfix">
		<?php
		if ( have_posts( $myfilter ) ) {
			foreach ( $destCategories as $category ) :
                $posts = get_posts( array('category_name' => $category->slug) );
                ?>
                <div class="category clearfix">
                    <h1 class="category"><? echo $category->name ?></h1>
                    <div class="featured-image">
                        <img class="featured-image" src="<?php echo get_featured_image_url($category); ?>">
                    </div>
                    <div class="category-titles">
                        <?php
                            foreach ( $posts as  $post ) :
                        ?>
                        <h3 class="category-titles"><a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a></h3>

                        <?php
                            endforeach;
                            wp_reset_postdata();
                            //the_content();
                        ?>
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


<?php get_footer(); ?>