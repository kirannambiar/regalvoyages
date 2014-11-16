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
    });
</script>

<div id="herospace">

</div>


<div class="main">
	<div class="content clearfix">
		<p>this is using front-page.php</p>
		<?php //echo var_dump($destCategories) ?>
		<?php 
		if ( have_posts( $myfilter ) ) {
			foreach ( $destCategories as $category ) :
                //echo "<p>inside category foreach</p>";
                //echo var_dump($category);
                $posts = get_posts( array('category_name' => $category->slug) );
                //echo var_dump($posts);
                ?>
                <div class="category clearfix">
                    <h1 class="category"><? echo $category->name ?></h1>
                    <div class="featured-image">
                        <img src="<?php echo get_featured_image_url($category); ?>">
                    </div>
                    <?php
                        foreach ( $posts as  $post ) :
                    ?>
                    <h3><a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a></h3>

                    <?php
                        endforeach;
                        wp_reset_postdata();
                        //the_content();
                    ?>
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