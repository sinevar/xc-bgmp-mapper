<?php

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

class XcBgmpBuilder
{
    static public function build()
    {
        add_action('wp', array(__CLASS__, 'myBgmpMapShortcodeCalled'));
        add_filter('bgmp_get-map-placemarks-return', array(__CLASS__, 'myBgmpGetMapPlacemarksReturn'));
        add_filter('single_template', array(__CLASS__, 'mySingleTemplates'));
        //add_action('template_redirect', array(__CLASS__, 'flushRewriteRules'));
    }

    /**
     * Adds bgmp map's js and css to listed pages
     */
    static public function myBgmpMapShortcodeCalled()
    {
        global $post;

        $shortcodePageSlugs = array();
        if ('bgmp' === $post->post_type) {
            $shortcodePageSlugs[] = $post->post_name;
        }

        if ($post) {
            if (in_array($post->post_name, $shortcodePageSlugs)) {
                add_filter('bgmp_map-shortcode-called', '__return_true');
            }
        }
    }

    /**
     * Filters returned placemarks
     *
     * @param mixed $placemarks
     * @return array
     */
    static public function myBgmpGetMapPlacemarksReturn($placemarks)
    {
        $id   = get_the_ID();
        $post = get_post($id);

        $filteredPlacemarks = array();
        foreach($placemarks as $placemark)
        {
            if ($post->post_title === $placemark['title']) {
                $filteredPlacemarks[] = $placemark;
            }
        }

        return 'bgmp' === $post->post_type ? $filteredPlacemarks : $placemarks;
    }

    /**
     * Returns path to the template's file which is partly generated in admin panel
     *
     * @param mixed $single
     * @return string|mixed
     */
    static public function mySingleTemplates($single)
    {
        global $wp_query, $post;

        if ('bgmp' === $post->post_type) {
            $file = get_theme_root() . '/' . get_template() . '/single-' . get_option('xs_single_page_post_type') . '.php';
            if (file_exists($file)) {
                return $file;
            }
            wp_redirect(home_url('error404'));
        }

        return $single;
    }

    /**
     * Can flush all rewrite rules, so if new post type is added, it should be taken into account automatically after it
     *
     */
    static public function flushRewriteRules()
    {
        global $wp, $wp_rewrite;

        $wp_rewrite->flush_rules();
    }
}
