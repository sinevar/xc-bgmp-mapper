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
            'xs_main-settings-group',
            '', 
            array(__CLASS__, 'mySettingsSectionCallback' ), 
            'xs_main-settings-group'
        );
        add_settings_field(
            'xs_single_page_post_type', 
            __('Single Page Post Type: '),
            array(__CLASS__, 'mapSinglePagePostTypeField'),	
            'xs_main-settings-group', 
            'xs_main-settings-group', 
            array('label_for' => 'xs_single_page_post_type')
        );
        register_setting('xs_main-settings-group', 'xs_single_page_post_type');
    }

    /**
     * Called for short description about that section
     */
		static public function mySettingsSectionCallback()
		{
		    echo '<p>Specify the name of your custom post type for single pages that is hosted inside your curreny used theme. It will let your bgmp placemarks maps be displayed in this template</p>';
		}

    /**
     * Draws input for field xs_single_page_post_type
     */
		static public function mapSinglePagePostTypeField()
		{
		    echo '<input id="xs_single_page_post_type" name="xs_single_page_post_type" type="text" value="'. get_option('xs_single_page_post_type').'" style="width: 250px;" />';
		}
}
