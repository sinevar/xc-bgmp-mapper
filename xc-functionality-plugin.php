<?php
/*
Plugin Name: 0 - Xtreemcoder Functionality Plugin
Description: Allows to display [bgmp-map] with one marker. It also allows to create all the functions inside it, without the need to replicate them inside each theme
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

    require_once(dirname(__FILE__) . '/XcFunctionBuilder.php');
    require_once(dirname(__FILE__) . '/XcBgmpBuilder.php');
    require_once(dirname(__FILE__) . '/XcAdminBuilder.php');

    XcFunctionBuilder::build();
    XcBgmpBuilder::build();
    XcAdminBuilder::build();

} else {
    add_action('admin_notices', 'XcHelper::whatToDoToMeetRequirements');
}
