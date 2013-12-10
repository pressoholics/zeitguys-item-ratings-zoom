<?php
/*
 * Plugin Name: Item Ratings Image Zoom by Zeitguys Inc.
 * Plugin URI: http://www.zeitguys.com
 * Description: 
 * Author: Zeitguys Inc
 * Version: 1.0
 * Author URI: http://www.zeitguys.com
 * License: GPL2+
 * Text Domain: zg_item_ratings_zoom
 * Domain Path: /languages/
 */

//Define plugin constants
define( 'ZGITEMRATINGSZOOM__MINIMUM_WP_VERSION', '3.0' );
define( 'ZGITEMRATINGSZOOM__VERSION', '1.0' );
define( 'ZGITEMRATINGSZOOM__DOMAIN', 'zg-item-ratings-zoom-plugin' );
define( 'ZGITEMRATINGSZOOM__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ZGITEMRATINGSZOOM__PLUGIN_URL', plugin_dir_url( __FILE__ ) );

//Set Activation/Deactivation hooks
register_activation_hook( __FILE__, 'zg_item_ratings_zoom_activation' );
register_deactivation_hook( __FILE__, 'zg_item_ratings_zoom_deactivation' );

function zg_item_ratings_zoom_activation( $network_wide = NULL ) {
	
}

function zg_item_ratings_zoom_deactivation() {
	
}


//Init plugin during 'admin_init' action to ensure parent is instatiated
add_action( 'admin_init', 'zg_item_ratings_zoom_init' );
function zg_item_ratings_zoom_init() {
	
	//Perform check for parent plugin
	zg_item_ratings_zoom_parent_check();
	
	//Backup check Check for parent plugin class
	if( class_exists('ZgItemRatings') ) {
		
		//Include plugin classes
		require_once( ZGITEMRATINGSZOOM__PLUGIN_DIR . 'class.zg-item-ratings-zoom.php' );
	
		//Instatiate plugin class and pass config options array
		new ZgItemRatingsZoom();
		
	}
	
}

//Check that parent plugin is active, if not display admin notice and deactivate this plugin
function zg_item_ratings_zoom_parent_check() {
	
	//Init vars
	$parent_path 	= 'zg-item-ratings/zg-item-ratings.php';
	
	//Check that parent class is active
	if( !is_plugin_active($parent_path) ) {
		
		//Parent plugin not active -- do something!!
		add_action( 'admin_notices', 'zg_item_ratings_zoom_missing_parent_plugin' );
		
		//Deactivate plugin
		deactivate_plugins( __FILE__ );
		
	}
	
}

//Echo out error admin notice if parent plugin is not active
function zg_item_ratings_zoom_missing_parent_plugin() {
	
	echo '<div class="error">
	       <p>'. _x( 'WARNING for Item Ratings Zoom Plugin -- Parent Item Ratings Plugin Requried. Zoom Plugin has been disabled!', 'Admin notice message', ZGITEMRATINGSZOOM__DOMAIN ) .'</p>
	    </div>';
	
}

