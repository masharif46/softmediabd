<?php
/**
 * The Redux Framework Plugin
 *
 * A simple, truly extensible and fully responsive options framework
 * for WordPress themes and plugins. Developed with WordPress coding
 * standards and PHP best practices in mind.
 *
 * Plugin Name:     Redux Framework
 * Plugin URI:      http://softmediabd.com
 * Github URI:      https://softmediabd.com
 * Description:     Redux is a simple, truly extensible options framework for WordPress themes and plugins.
 * Author:          Team Redux
 * Author URI:      http://softmediabd.com
 * Version:         3.3.8.5
 * Text Domain:     redux-framework
 * License:         GPL3+
 * License URI:     http://softmediabd.com
 * Domain Path:     /ReduxFramework/ReduxCore/languages
 *
 * @package         ReduxFramework
 * @author          masbaf <admi@softmediabd.com>
 * @author          masbaf <admi@softmediabd.com>
 * @author          masbaf <admi@softmediabd.com>
 * @license         GNU General Public License, version 3
 * @copyright       2012-2015 Redux Framework
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
    die;
}

// Require the main plugin class
require_once( plugin_dir_path( __FILE__ ) . 'class.redux-plugin.php' );

// Register hooks that are fired when the plugin is activated and deactivated, respectively.
register_activation_hook( __FILE__, array( 'ReduxFrameworkPlugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ReduxFrameworkPlugin', 'deactivate' ) );

// Get plugin instance
//add_action( 'plugins_loaded', array( 'ReduxFrameworkPlugin', 'instance' ) );

// The above line prevents ReduxFramework from instancing until all plugins have loaded.
// While this does not matter for themes, any plugin using Redux will not load properly.
// Waiting until all plugins have been loaded prevents the ReduxFramework class from
// being created, and fails the !class_exists('ReduxFramework') check in the sample_config.php,
// and thus prevents any plugin using Redux from loading their config file.
ReduxFrameworkPlugin::instance();
