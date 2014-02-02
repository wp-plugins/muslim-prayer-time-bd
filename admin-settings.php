<?php
add_action('admin_menu', 'register_mptb_menu_page');

function register_mptb_menu_page() {
	add_options_page('Muslim Prayer Time BD', 'Prayer Settings', 'manage_options', __FILE__, 'mptb_plugin_menu');
	add_action( 'admin_init', 'register_mptb_settings' );
}

function register_mptb_settings() {
	//register our settings
	register_setting( 'mptb-settings-group', 'mptb_option' );
}

function mptb_plugin_menu() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
?>
	<div class="wrap">
	<h2>Muslim Prayer Time BD Plugin Settings</h2>

	<form method="post" action="options.php">
	<?php
		settings_fields( 'mptb-settings-group' );
		$mptb_option = get_option('mptb_option');

		if($mptb_option == "Enabled") { $color = "blue"; }
		elseif($mptb_option == "") { $mptb_option = "Disabled"; $color = "red"; }
	?><br/>
	<div style="width: 65%; float: left;">
		<div class="postbox" style="display: block;float:left;margin:5px;clear:left; width: 99%;">
			<h3 class="hndle" style="padding:5px;"><span>Sehri Options</span></h3>
			<div class="inside">
				<div><p align="justify">To display the Sehri Last Time just Enable and Save Changes your options below:</p>
				
    			<table class="form-table">
        			<tr valign="top">
        				<th scope="row">Enable Sehri time to show:</th>
        				<td><input type="checkbox" name="mptb_option" value="Enabled" <?php if(get_option('mptb_option')==Enabled) echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/muslim-prayer-time-bd/images/<?php echo $color; ?>.png" alt="color" /> <font color="<?php echo $color; ?>"><?php echo $mptb_option; ?></font></td>
        			</tr>
    			</table>
    			<?php submit_button(); ?>
				</div>
			</div>
		</div>
	</div>
	</form>
</div>

<div style="width:30%;float:right;margin-right:5%">
	<div class="postbox" style="display: block; float: right; margin: 5px; clear: right; width: 97%;">
		<h3 class="hndle" style="padding:5px; color:#007193;">Credits</h3>
		<div class="inside">
			<p>Developer: <a href="http://facebook.com/IKIAlam">Iftekhar</a><br/>
			Website: <a href="http://www.tips4blog.com/" target="_blank">www.tips4blog.com</a></p>
		</div>
	</div>

	<div class="postbox" style="display: block; float: right; margin: 5px; clear: right; width: 97%;">
		<h3 class="hndle" style="padding:5px; color:#007193;">Plugin Info</h3>
		<div class="inside">
			<p>Price: Free!<br/>
			Version: 1.1<br/>
			Scripts: PHP + CSS + JS.<br/>
			Requires: Wordpress 3.0+<br/>
			First release: 23-Jan-2014<br/>
			Published under: <a href="http://www.gnu.org/licenses/gpl.txt">GNU General Public License</a><br/>
			<a href="http://wordpress.org/plugins/muslim-prayer-time-bd/faq/">FAQ</a> | <a href="http://wordpress.org/plugins/muslim-prayer-time-bd/changelog/">Changelog</a><br/></p>
		</div>
	</div>
</div>
<?php
}
?>