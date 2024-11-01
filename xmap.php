<?php
/*
Plugin Name: XMap
Description: Embed maps from the following domains into WordPress: <a href='http://www.bikemap.net'>bikemap.net</a>, <a href='http://www.runmap.net'>runmap.net</a>, <a href='http://www.inlinemap.net'>inlinemap.net</a>, <a href='http://www.wandermap.net'>wandermap.net</a>, <a href='http://www.mopedmap.net'>mopedmap.net</a>
Version: 1.3
Text Domain: xmap
Author: Matthias Scheidl <dev@scheidl.name>
*/

/*  Copyright 2010-2014  Matthias Scheidl  (email : dev@scheidl.name)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



// i18n
load_plugin_textdomain( 'xmap', false, basename(dirname(__FILE__)) . '/languages/' );

// Includes
$pluginRoot = plugin_dir_path( __FILE__ );

require_once ($pluginRoot . '/includes/helpers.php');
require_once ($pluginRoot . '/includes/options.php');
require_once ($pluginRoot . '/includes/shortcodes.php');

// Actions
add_action( 'admin_menu', 'xmap_admin_menu_handler');
add_action('admin_init', 'xmap_admin_init_handler');

// Hooks
register_activation_hook(__FILE__, 'xmap_activation_handler');
register_uninstall_hook(__FILE__, 'xmap_uninstall_handler');



/**
 * Plugin activation handler
 */
function xmap_activation_handler() {
	xmap_default_options();
}


/**
 * Plugin uninstall handler
 */
function xmap_uninstall_handler() {
	delete_option('xmap_options');
}


?>