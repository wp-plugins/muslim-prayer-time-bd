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
		<div class="postbox-container" style="width:75%;">
			<h2>Muslim Prayer Time BD</h2>
			<hr>
			<div id="poststuff">
				<div class="postbox">
					<h3>Muslim Prayer Time BD Settings</h3>
					<div class="inside">
						<form method="post" action="options.php">
							<?php
								settings_fields( 'mptb-settings-group' );
								$city_states = district_lists();
								$mptb_option = get_option('mptb_option');
								if($mptb_option == "Enabled") { $color = "blue"; }
								elseif($mptb_option == "") { $mptb_option = "Disabled"; $color = "red"; }
							?>
							<p>Enable the below checkbox if you want to show Sehri Last Time in your blog:</p>
							<table class="form-table">
								<tr valign="top">
									<th scope="row">Enable Sehri time:</th>
									<td><input type="checkbox" name="mptb_option" value="Enabled" <?php if(get_option('mptb_option')=="Enabled") echo('checked="checked"'); ?>/></td><td> Status: <img src="<?php echo WP_PLUGIN_URL; ?>/muslim-prayer-time-bd/images/<?php echo $color; ?>.png" alt="color" /> <font color="<?php echo $color; ?>"><?php echo $mptb_option; ?></font></td>
								</tr>
								<tr>
									<th scope="row">Choose default district:</th>
									<td colspan="2">
										<select id="default_city" name="default_city">
											<option value="" selected="selected">
												<?php if($_POST['default_city']) { echo $_POST['default_city']; } else { echo 'ঢাকা'; } ?>
											</option>
											<?php foreach($city_states as $city) { ?>
												<option value="<?php echo $city; ?>" <?php if(get_option('default_city') == $city) {echo "selected=selected";} ?>><?php echo $city; ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>
							</table>
							<?php submit_button(); ?>
						</form>
					</div>
				</div>
			</div><!-- End poststuff -->
		</div>
		<div class="postbox-container" style="width: 20%;margin: 57px 0 0 10px;">
			<div id="poststuff" style="min-width: 25%;">
				<div class="postbox" style="margin: 0;">
					<h3>Credit</h3>
					<div class="inside">
						<p>Developer: <a href="http://facebook.com/IKIAlam" target="_blank">Iftekhar</a><br/>
						Website: <a href="http://www.tips4blog.com/" target="_blank">www.tips4blog.com</a></p>
					</div>
				</div>
			</div><!-- End poststuff -->
			<div id="poststuff" style="min-width: 25%;">
				<div class="postbox">
					<h3>Plugin Info</h3>
					<div class="inside">
						<p>Price: Free!<br/>
						Version: 1.2<br/>
						Scripts: PHP + CSS + JS.<br/>
						Requires: Wordpress 3.0+<br/>
						First release: 23-Jan-2014<br/>
						Published under: <a href="http://www.gnu.org/licenses/gpl.txt">GNU General Public License</a><br/>
						<a href="http://wordpress.org/plugins/muslim-prayer-time-bd/faq/">FAQ</a> | <a href="http://wordpress.org/plugins/muslim-prayer-time-bd/changelog/">Changelog</a><br/></p>
					</div>
				</div>
			</div><!-- End poststuff -->
		</div>
	</div>
	<?php
}
if( isset( $_POST['default_city'] ) ) {
	update_option( 'default_city' , $_POST[ 'default_city' ] );
}
?>