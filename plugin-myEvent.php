<?php
/**
 * Plugin Name:       myEvent
 * Plugin URI:        https://github.com/DarekRepos/myEvent
 * Description:       This is the widget displays events dates.
 * Version:           1.0.0
 * Author:            Darek Duda
 * Author URI:        https://dudawebsite.com
 * License:           GPL-2.0+ or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       myEvent
 * Domain Path:       /lang
 */

namespace MyEvent;

use MyEvent\MyEventAutoloader\MyEventAutoloader;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once dirname( __FILE__ ) . '/inc/MyEventAutoloader.php';

$loader = new MyEventAutoloader();
$loader->register();
$loader->addNamespace( 'MyEvent', dirname( __FILE__ ) . '/inc/' );

$plugin = new MyEvent( __FILE__ );
add_action( 'wp_loaded', [ $plugin, 'load' ] );
