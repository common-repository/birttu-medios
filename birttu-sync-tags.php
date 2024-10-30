<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action( 'save_post', 'bir_sync_tags', 10, 3 );
function bir_sync_tags( $post_id, $post, $update ) {
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;
	
	if( 'post' != $_POST['post_type'])
		return;

	$post_tags = get_the_tags( $post_id );
    
    if( empty( $post_tags ) ) 
    	return;

    $site_number = get_option( 'id_birttu_usuario' );

    if( empty( $site_number ) )
    	return;

    $tags_array = array();
	foreach ( $post_tags as $tag ) {
		$tags_array[] = $tag->name;
	}

	if( empty( $tags_array ) )
		return;

	$call = array(
		'birttuId' => $site_number,
		'articuloId' => $post_id,
		'tags' => $tags_array
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://birttu.com/api/index.php/v1/wp-plugin/tags",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode( $call ),
		CURLOPT_HTTPHEADER => array( "Content-Type: application/json" ),
	));

	$response = curl_exec($curl);

	curl_close($curl);
}