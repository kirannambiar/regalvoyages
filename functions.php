<?php

	register_nav_menus();

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