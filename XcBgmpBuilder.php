<?php

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

class XcBgmpBuilder
{
    /**
     * Build all hooks needed for displaying single markup on custom post type
     */
    static public function build()
    {
        add_action('wp', array(__CLASS__, 'myBgmpMapShortcodeCalled'));
        add_filter('bgmp_get-map-placemarks-query', array(__CLASS__, 'myBgmpGetMapPlacemarksQuery'));
    }

    /**
     * Adds bgmp map's js and css to listed pages
     */
    static public function myBgmpMapShortcodeCalled()
    {
        global $post;

        $bgmps = query_posts('post_type=bgmp');
        wp_reset_query(); //otherwise above query will be visible instead of the right one

        $bgmpSlugs = array();
        foreach ($bgmps as $bgmp) {
            $bgmpSlugs[] = $bgmp->post_name;
        }

        if ($post && in_array($post->post_type, self::getCPTS()) && in_array($post->post_name, $bgmpSlugs)) {
            add_filter('bgmp_map-shortcode-called', '__return_true');
        }
    }

    /**
     * It allows to modify the query during retrival of placemarks from database
     *
     * @return array
     */
    static public function myBgmpGetMapPlacemarksQuery($query)
    {
        global $post;

        if (in_array($post->post_type, self::getCPTS())) {
            $query['name'] = $post->post_name;
        }

        return $query;
    }

    /**
     * Returns array of customer post types
     *
     * @return array
     */
    static public function getCPTS()
    {
        return array_map('trim', explode(',', get_option('xc_post_type')));
    }
}
