<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php echo do_shortcode('[comentarios_birttu]'); ?>
</div><!-- .comments-area -->