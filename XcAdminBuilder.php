<?php

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

class XcAdminBuilder
{
    static public function build()
    {
        add_action('admin_menu', array(__CLASS__, 'myPluginMenu'));
        add_action('admin_init', array(__CLASS__, 'myRegisterSettings'));
    }

    /**
     * Adds new options page to admin panel
     */
    static public function myPluginMenu() {
        add_options_page(
            'Xtreemcoder Functionality Plugin', 
            'Xtreemcoder', 
            'manage_options', 
            'xc-functionality-plugin', 
            array(__CLASS__, 'myPluginOptions')
        );
    }

    /**
     * Called by add_option_page
     */
    static public function myPluginOptions() {
        if(current_user_can('manage_options')) {
            self::renderOptionsForm();
        } else {
            wp_die('Access denied.');
        }
    }

    /**
     * Requires file with form template
     */
    static public function renderOptionsForm()
    {
        require_once(dirname(__FILE__) . '/view/optionsForm.php');
    }

    /**
     * Creates settings section, adds fields to it and register such settings, it must be also used inside /view/optionsForm.php appropriately
     */
    static public function myRegisterSettings() {
        add_settings_section(
            'xc_main_settings_group',
            '', 
            array(__CLASS__, 'mySettingsSectionCallback' ), 
            'xc_main_settings_group'
        );
        add_settings_field(
            'xc_post_type', 
            __('Custom Post Type: '),
            array(__CLASS__, 'mapSinglePagePostTypeField'),	
            'xc_main_settings_group', 
            'xc_main_settings_group', 
            array('label_for' => 'xc_post_type')
        );
        register_setting('xc_main_settings_group', 'xc_post_type');
    }

    /**
     * Called for short description about that section
     */
		static public function mySettingsSectionCallback()
		{
		    echo '<p>Specify the name of your custom post type where the [bgmp-map] shortcode should depict only one marked basing on post slug.</p>';
		}

    /**
     * Draws input for field xs_single_page_post_type
     */
		static public function mapSinglePagePostTypeField()
		{
		    echo '<input id="xc_post_type" name="xc_post_type" type="text" value="'. get_option('xc_post_type').'" style="width: 250px;" /> (you can specify more, separated by comma)';
		}
}
