<?php

	register_nav_menus();
    add_theme_support( 'post-thumbnails' );
    add_action( 'init', 'my_custom_post_destination' );

    function my_custom_post_destination() {
        $labels = array(
            'name'  => _x( 'Destinations', 'post type general name' ),
            'singular_name' => _x( 'Destination', 'post type singular name'),

        );
        $args = array(

        );
        register_post_type( 'destination', $args );
    }


    // returns the first post with the tag 'hero'
    // should contain only one such post
    function get_hero_post() {
        $args = array('tag' => 'hero' );
        $query = get_posts($args);
        //echo 'getting featured post ' + var_dump($query);
        return $query[0];
    }

    function get_hero_image_url() {
        $post = get_hero_post();
        if ( has_post_thumbnail($post->ID) ) {
            $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
            return $url[0];
        }
        else {
            return 'image not found';
        }
    }

    // returns the first post with the tag 'featured'
    // should contain only one such post
    function get_featured_post( $category ) {
        $args = array( 'tag' => 'featured', 'category_name' => $category->name );
        $query = get_posts($args);
        //echo 'getting featured post ' + var_dump($query);
        return $query[0];
    }

    function get_featured_image_url( $category ) {
        $post = get_featured_post( $category );
        if ( has_post_thumbnail($post->ID) ) {
            $url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
            return $url[0];
        }
        else {
            return 'image not found';
        }
    }

    // TODO: Remove this function as it's no longer used
    function get_posts_by_categories($post_categories) {
        $cats = array();

        foreach($post_categories as $c) {
            $cat = $c;
            $cats[] = array('slug' => $cat->slug);
        }
        echo 'inside get posts !!!!!!!!!! ';
        echo var_dump($cats);
        return get_posts($cats);
    }

?>