<?php
/*
Plugin Name: Xtreemcoder Bgmp Mapper
Description: Allows to display bgmp post types inside other customer post type templates. It means that instead of creating single-bgmp.php inside every template, you can specify the name of customer post type like 'sinevar', so it would be processed by single-sinevar.php template inside your current theme 
Author: Adam Gegotek
Version: 1.0.0
Author URI: http://www.xtreemcoder.com
License: GPL2
*/

/*  
 * Copyright 2012 Adam Gegotek (email : adam.gegotek@gmail.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

if (__FILE__ === $_SERVER['SCRIPT_FILENAME']) {
    die('Access denied.');
}

require_once(dirname(__FILE__) . '/XcHelper.php');

define('XC_NAME', 'Xtreemcoder Bgmp Mapper');
define('XC_MIN_PHP_VERSION', '5.2');	
define('XC_MIN_WP_VERSION', '3.4');


if (version_compare(PHP_VERSION, XC_MIN_PHP_VERSION, '>=') && version_compare($wp_version, XC_MIN_WP_VERSION, '>=')) {

    require_once(dirname(__FILE__) . '/XcBgmpBuilder.php');
    require_once(dirname(__FILE__) . '/XcAdminBuilder.php');

    XcBgmpBuilder::build();
    XcAdminBuilder::build();

} else {
    add_action('admin_notices', 'XcHelper::whatToDoToMeetRequirements');
}
