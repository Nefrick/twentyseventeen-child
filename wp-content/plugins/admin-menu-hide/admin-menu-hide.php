<?php
/**
 * Plugin Name: Admin Menu Hide
 * Description: Прячет пункты меню в админ панели
 * Version: 1.0
 * Author: Michael Chizhevsky
 * Author URI: http://
 * Text Domain: admin-menu-hide
 */

// If this file is called directly, abort.
if ( ! defined('WPINC' ) ) {
    die;
}

// Setup
define( 'AMH_PLUGIN_URL', __FILE__ );

// Includes
include( 'includes/admin/enqueue.php' );
include( 'includes/admin/hide-menu-form.php' );
include( 'process/save-menu-item-hide.php' );
include( 'process/admin-style-print.php' );



