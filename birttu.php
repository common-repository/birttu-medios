<?php
/**
 * Plugin Name: Birttu Medios
 * Plugin URI:  
 * Description: plugin de comentarios, comentarios, widget de comentarios, sistema de comentarios, Birttu, comments, wordpress comments, comments plugin, co
 * Version:     1.7.0
 * Author:      Birttu network S.L.
 * Author URI:  www.birttu.com
 * Text Domain: birttu
 * Domain Path: /languages
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

define( 'BIR_ROOTDIR', plugin_dir_path(__FILE__) );
require_once( BIR_ROOTDIR . 'crud/birttu-main.php' );
require_once( BIR_ROOTDIR . 'crud/birttu-shortcodes.php' );
require_once( BIR_ROOTDIR . 'shortcodes.php' );
require_once( BIR_ROOTDIR . 'birttu-comments-number.php' );
require_once( BIR_ROOTDIR . 'birttu-ads-txt.php' );
require_once( BIR_ROOTDIR . 'birttu-sync-tags.php' );

register_activation_hook( __FILE__, 'bir_activate_cron' );
register_activation_hook( __FILE__, 'bir_adstxt' );

// frontend
include 'inicializar.php';
//include 'shortcodes.php';

function bir_load_textdomain() {
	load_plugin_textdomain( 'birttu', false, basename( dirname( __FILE__ ) ) . '/lang' );
}
add_action( 'init', 'bir_load_textdomain' );

// parte backend
add_action('admin_menu', 'bir_admin_menu' );
function bir_admin_menu(){
   add_menu_page( 'Birttu', 'Birttu', 'manage_options', 'birttu_main', 'birttu_main', '' );
}

// Hide existing comments
function bir_comments_array($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'bir_comments_array', 10, 2);

add_filter('comments_template', 'bir_comments_template');
function bir_comments_template( $file ){
	$id_usuario = get_option('id_birttu_usuario');
    if ( is_single() && $id_usuario > 0) {
        $file = dirname( __FILE__ ) . '/file-custom-comments.php';
    }
    return $file;
}