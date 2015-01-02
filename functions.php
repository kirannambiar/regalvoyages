<?php

	register_nav_menus();
    add_theme_support( 'post-thumbnails' );
    add_action( 'init', 'register_cpt_destination' );
    add_action( 'init', 'add_subtitle_to_destination_post' );
    add_action( 'init', 'add_taxonomy_to_destination_post' );
    add_filter( 'show_admin_bar', '__return_false' );


    function register_cpt_destination() {
        $labels = array(
            'name' => _x( 'Destinations', 'destination' ),
            'singular_name' => _x( 'Destination', 'destination' ),
            'add_new' => _x( 'Add New', 'destination' ),
            'add_new_item' => _x( 'Add New Destination', 'destination' ),
            'edit_item' => _x( 'Edit Destination', 'destination' ),
            'new_item' => _x( 'New Destination', 'destination' ),
            'view_item' => _x( 'View Destination', 'destination' ),
            'search_items' => _x( 'Search Destinations', 'destination' ),
            'not_found' => _x( 'No destinations found', 'destination' ),
            'not_found_in_trash' => _x( 'No destinations found in Trash', 'destination' ),
            'parent_item_colon' => _x( 'Parent Destination:', 'destination' ),
            'menu_name' => _x( 'Destinations', 'destination' ),
        );
        $args = array(
            'labels' => $labels,
            'hierarchical' => false,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array( 'category', 'post_tag' ),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_nav_menus' => true,
            'publicly_queryable' => true,
            'exclude_from_search' => false,
            'has_archive' => true,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true,
            'capability_type' => 'post'
        );
        register_post_type( 'destination', $args );
    }

    function add_taxonomy_to_destination_post() {
        register_taxonomy_for_object_type('category', 'destination');
        register_taxonomy_for_object_type('post_tag', 'destination');
    }

    function add_subtitle_to_destination_post() {
        add_post_type_support( 'destination', 'wps_subtitle');
    }



    // returns the first post with the tag 'hero'
    // should contain only one such post
    function get_hero_post() {
        $args = array('tag' => 'hero', 'post_type' => 'destination' );
        $query = get_posts($args);
        //echo 'getting hero post ' + var_dump($query);
        return $query[0];
    }

    function get_hero_post_url() {
        $post = get_hero_post();
        if ( $post ) {
            return get_permalink($post->ID);
        }
        else {
            return 'no featured post found';
        }
    }

    function get_hero_image_url() {
        $post = get_hero_post();
        //var_dump($post);
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
        $category_id = get_cat_ID($category->name);
        //var_dump($category_id);
        $args = array( 'tag' => 'featured', 'category' => $category_id, 'post_type' => 'destination'  );
        $query = get_posts($args);
        //var_dump($query);
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

    //returns the URL for a featured post in a specific category
    function get_featured_post_url( $category ) {
        $post = get_featured_post( $category );
        if ( $post ) {
            return get_permalink($post->ID);
        }
        else {
            return 'no featured post found';
        }

    }

    function get_featured_post_id( $category ) {
        $post = get_featured_post( $category );
        return $post->ID;
    }

    function featured_image_caption( $post_id ) {
        $thumbnail_id    = get_post_thumbnail_id($post_id);
        $thumbnail_image = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));

        if ($thumbnail_image && isset($thumbnail_image[0])) {
            return $thumbnail_image[0]->post_excerpt;
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

    function convert_caption_links($string) {
        // {link="http://www.flickr.com/photos/26598370@N00/219132302/"}Jenny{/link} / CC BY 2.0 https://creativecommons.org/licenses/by-nd/2.0/
        $patterns[0] = '/({link=\")/';
        $patterns[1] = '/\"\s*(})/';
        $patterns[2] = '/{\/link}/';
        $replacements[0] = '<a href="';
        $replacements[1] = '" target="_blank">';
        $replacements[2] = '</a>';

        //preg_match($pattern1,$string,$match);
        $result = preg_replace($patterns,$replacements,$string);
        //$url = '<a href="' . $match[1] . '" >' . $match[2] . '</a>';
        //var_dump($result);
        //echo ($string);
        return $result;

    }

?>