<?php
/**
 * Plugin Name: Widgets Demo
 * Author: SaberHR
 * Plugin URI: http://saberhr.com
 * Author URI: http://saberhr.com
 * Description:
 * Version: 1.0.0
 * Licence: GPLv2 or later
 * Text Domain: widgets-demo
 * Domain Path: /languages/
 */

require_once plugin_dir_path( __FILE__ ) . 'widgets/class.demowidget.php';
require_once plugin_dir_path( __FILE__ ) . 'widgets/class.advertisementwidget.php';


function widgets_demo_load_text_domain() {
	load_plugin_textdomain( 'widgets-demo', false, plugin_dir_path( __FILE__ ) . '/languages' );
}

add_action( 'plugins_loaded', 'widgets_demo_load_text_domain' );

function widgets_demo_register_demowidget() {
	register_widget( 'DemoWidget' );
	register_widget( 'AdvertisementWidget' );
}

add_action( 'widgets_init', 'widgets_demo_register_demowidget' );


function widgets_demo_admin_assets ($screen) {
	if ('widgets.php' == $screen) {
		wp_enqueue_media();
		wp_enqueue_script('advertisement-widgets-js', plugin_dir_url(__FILE__).'assets/admin/js/advertisement.js', array("jquery"), "1.0", 1);
	}
}
add_action('admin_enqueue_scripts', 'widgets_demo_admin_assets');