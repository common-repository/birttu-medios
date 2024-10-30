<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

function bir_activate_cron() {
    if (! wp_next_scheduled ( 'birttu_hourly_event' )) {
		wp_schedule_event(time(), 'hourly', 'birttu_hourly_event');
    }
}

add_action( 'birttu_hourly_event', 'bir_refresh_comments_number_from_api');
function bir_refresh_comments_number_from_api() {
	$site_number = get_option( 'id_birttu_usuario' );
	$response = wp_remote_get( 'https://www.birttu.com/api/index.php/v1/wp-plugin/countLatestSpeaks/' . $site_number );
	
	if ( is_array( $response ) ) {
		$body = json_decode( $response['body'] );
	}
	else{
		return;
	}

	if( $body->error )
		return;

	$records = $body->records;
	
	foreach ( $records as $record ) {
		update_post_meta( intval( $record->ID_articulo ), 'bir_get_comments_number', intval( $record->numComentarios ) );
	}
}

add_filter( 'get_comments_number', 'bir_get_comments_number', 999, 2 );
function bir_get_comments_number( $count, $post_id ){
	return get_post_meta( $post_id, 'bir_get_comments_number', true );
}