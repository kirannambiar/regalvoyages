<?php
	get_header();
	//$args = array( 'category_name' => 'romantic,adventure', 'tag' => 'destination', 'exculde' => '1' );
	$myfilter = 'tag=destination';
	$query = get_posts( $myfilter );
    $destCategories = get_categories( array('tag' => 'destination' , 'exclude' => '1') );

?>

<div id="main">
	<div id="content clearfix">
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
                <h2><? echo $category->name ?></h2>
                <?php
				    foreach ( $posts as  $post ) :
                        echo "<p>inside post foreach</p>";
                        //echo var_dump($post);
                        //setup_postdata($post);
                        //$t = wp_get_post_tags($post->ID, array( 'fields' => 'names' ));
				        //echo "<p>tag for this post is + " + print_r($t) + "</p>";
                ?>
                <h3><a href="<?php the_permalink(); ?>"> <?php echo the_title(); ?> </a></h3>

			    <?php
                    endforeach;
                    wp_reset_postdata();
			        //the_content();
            endforeach;
		//wp_reset_postdata();
		}
		else { ?>
		<p>
			<?php _e( 'Sorry, there is not content to show at this time.')?>
		</p>
		<?php } ?>
	</div>
</div>


<?php get_footer(); ?>