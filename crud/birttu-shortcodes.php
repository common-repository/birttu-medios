<?php

if ( ! defined( 'ABSPATH' ) ) {

    exit; // Exit if accessed directly

}





function birttu_shortcodes () {

?>

<div class="wrap">

		<div id="dashboard-widgets-wrap" class="panel-birttu">

			<div id="dashboard-widgets" class="metabox-holder">

				<div id="postbox-container-1" class="postbox-container">

				</div>

				<div  class="postbox-container">

						<div id="dashboard_quick_press" class="postbox ">

								<h2 class="title">Codigos/Shortcodes</h2>

								<div class="inside">

									<ul>

										<li>

											<label><?php _e("To add in an entry:", "birttu"); ?></label> [comentarios_birttu]

										</li>

										<li>

											<label><?php _e("To show number of comments:", "birttu"); ?></label> [numero_comentarios_birttu]

										</li>

									</ul>

								</div>

						</div>

				</div>

			</div>

</div>

<?php

}