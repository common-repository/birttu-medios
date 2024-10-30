<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// shortcode
function bir_comentarios_birttu_func( $atts=array(), $content="" ) {
    if( is_array( $atts ) ) 
    	extract( $atts );
	
	$id_birttu = get_option( 'id_birttu_usuario' );

    ob_start();
    
	wp_register_script( 'iframe-resizer', '//www.birttu.com/widget/js/iresizer/iframeResizer.min.js' );
	wp_enqueue_script( 'iframe-resizer', false, array(), false, true );
	wp_register_script( 'iframe-resizer-init', plugins_url( 'js/birttu-init.js', __FILE__ ) );
	wp_enqueue_script( 'iframe-resizer-init', false, array(), false, true );
	
	if( $id_birttu !== null):
		$mivaria = get_the_ID();
		$titunoti = str_replace( "#", "%23", get_the_title() );
		$enlace = get_the_permalink();
		$fechanoti = get_the_date('Y-m-d');
		$horanoti = get_the_time();
		$m = $id_birttu;
        
        echo"<iframe style=\"width: 100%;\" src=\"https://www.birttu.com/widget/widget.php?idarticulo=$mivaria&titunoti=$titunoti&enlace=$enlace&fechanoti=$fechanoti&horanoti=$horanoti&idmedio=$m\" frameborder=\"0\"></iframe>";
	else: ?>
		<div>Todavia no tiene un registro en birtttu; </div>
	<?php 
	endif;

    $sc = ob_get_contents();
    ob_end_clean();
    return $sc;
}
add_shortcode( 'comentarios_birttu', 'bir_comentarios_birttu_func' );

function bir_numero_comentarios_birttu_func( $atts=array(), $content="" ) {
    if( is_array( $atts ) ) 
    	extract( $atts );
	
	ob_start();

	$id_birttu = get_option('id_birttu_usuario');
   
   	if( $id_birttu !== null):
		$mivaria = $post->ID;
		$m = $id_birttu;
		echo "<div><iframe src=\"https://www.birttu.com/widget/contador.php?idmedio=$m&idarticulo=$mivaria\" style=\"width: 100%;border: none;height: 30px;\"> </iframe></div>";
	endif;
    
    $sc = ob_get_contents();
    ob_end_clean();
    return $sc;
}
add_shortcode( 'numero_comentarios_birttu', 'bir_numero_comentarios_birttu_func' );