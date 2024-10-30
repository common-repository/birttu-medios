<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action( 'admin_enqueue_scripts', 'bir_script_enqueuer' );
function bir_script_enqueuer( $hook ) {
	if( $hook != 'toplevel_page_birttu_main' )
		return;

   	wp_register_style( 'bir-style', plugins_url('css/style.css', __FILE__) );
	wp_enqueue_style( 'bir-style' );
}
