<?php
/**
 * Plugin Name: JAMPress
 * Plugin URI: https://github.com/edhbr/misc-wp-jampress
 * Description: A plugin to help make WordPress headless
 * Version: 0.1.0
 * Author: edhbr
 * Author URI: https://github.com/edhbr
 */

$jamPress_dir = dirname( __FILE__ );

require( "$jamPress_dir/core/JAMPress.php" );

JAMPress::init(true);

