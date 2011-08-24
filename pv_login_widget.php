<?php
/*
Plugin Name: pv_login_widget
Plugin URI: http://www.vdvreede.net
Description: Plugin that creates a widget for logging in.
Author: Paul Van de Vreede
Version: 1
Author URI: http://www.vdvreede.net
*/

add_action("plugins_loaded", "pvl_register_widget");

function pvl_register_widget() {

	register_sidebar_widget('PV Login Widget', 'pvl_render_widget');
	
}

function pvl_render_widget() {
?>

	<form method="post" action="http://localhost/wp-login.php">
		
		<input type="text" name="log" />
		
		<input type="password" name="pwd" />
		
		<input type="submit" value="Log in" />
		
		<input type="hidden" name="redirect_to" value="http://localhost" />
	
	</form>
	
<?php
}