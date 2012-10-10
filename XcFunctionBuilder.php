<?php

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

class XcFunctionBuilder
{
    static public function build()
    {
        add_filter('the_excerpt', 'do_shortcode');
        //add_action('init', array(__CLASS__, 'myBuildTaxonomies')); //third parameter was 0...

        /*if (function_exists('add_image_size')) {
            add_image_size('category-thumb', 300, 9999); //300 pixels wide (and unlimited height)
            add_image_size('offer-thumb', 420, 280, true); //(cropped)
        }*/
    }

    /**
     * Builds taxonomies to group up some objects 
     */
    static public function myBuildTaxonomies() {
        register_taxonomy('category', 'post', array(
            'hierarchical' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => 'category_name',
            'rewrite' => did_action( 'init' ) ? array(
                'hierarchical' => false,
                'slug' => get_option('category_base') ? get_option('category_base') : 'category',
                'with_front' => false) : false,
            'public' => true,
            'show_ui' => true,
            '_builtin' => true,
        ));
    }
}
