<?php
/**
 * Plugin Name: 2 Click Social Media Buttons
 * Plugin URI: http://blog.ppfeufer.de/wordpress-plugin-2-click-social-media-buttons/
 * Description: Fügt die Buttons für Facebook-Like (Empfehlen), Twitter, Flattr, Xing und Googleplus dem deutschen Datenschutz entsprechend in euer WordPress ein.
 * Version: 0.35.2
 * Author: H.-Peter Pfeufer
 * Author URI: http://ppfeufer.de
 */
define('TWOCLICK_DONATE_FLATTR_LINK', 'http://flattr.com/thing/390240/WordPress-Plugin-2-Click-Social-Media-Buttons');
define('TWOCLICK_DONATE_PAYPAL_LINK', 'https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=DC2AEJD2J66RE');

/**
 * Sidebarwidget einbinden.
 *
 * @since work in progress
 */
//include_once('2-click-socialmedia-buttons-widget.php');

/**
 * Optionen auslesen.
 *
 * @since 0.4
 *
 * @param string $parameter
 */
$twoclick_buttons_options = get_option('twoclick_buttons_settings');
if(!function_exists('twoclick_buttons_get_option')) {
	function twoclick_buttons_get_option($parameter = '') {
		/**
		 * Prüfen ob das Formular abgesendet wurde.
		 * Wenn nicht, importiere $twoclick_buttons_options,
		 * ansonsten lade sie neu.
		 */
		if(!isset($_REQUEST['_wpnonce'])) {
			global $twoclick_buttons_options;
		} else {
			$twoclick_buttons_options = get_option('twoclick_buttons_settings');
		}

		if($parameter == '') {
			return $twoclick_buttons_options;
		} else {
			return $twoclick_buttons_options[$parameter];
		}
	}
}

/**
 * Button Menü zum Dashboard hinzufügen.
 *
 * @since 0.4
 */
if(!function_exists('twoclick_buttons_options')) {
	function twoclick_buttons_options() {
		add_options_page(
			'2-Klick-Buttons',
			'<img src="' . plugins_url(basename(dirname(__FILE__)) . '/images/twoclick.jpg') . '" id="2-click-icon" alt="2 Click Social Media Buttons Icon" width="16" height="16" /> 2-Klick-Buttons',
			'manage_options',
			'twoclick-buttons-options',
			'twoclick_buttons_options_page'
		);
	}
}

/**
 * Optionsseite generieren.
 *
 * @since 0.4
 */
if(!function_exists('twoclick_buttons_options_page')) {
	function twoclick_buttons_options_page() {
		/**
		 * Status von $_REQUEST abfangen.
		 */
		if(!empty($_REQUEST['_wpnonce'])) {
			/**
			 * Validate the nonce.
			 */
			check_admin_referer('twoclick-buttons-options');

			if($_REQUEST['twoclick_buttons_maintenance_reset']) {
				/**
				 * Resetting options to defaults.
				 */
//				twoclick_buttons_reset_options();

//				echo '<div id="message" class="updated fade">';
//				echo '<p><strong>';
//				_e('Settings resetted.', 'twoclick-buttons');
//				echo '</strong></p>';
//				echo '</div>';
			} elseif($_REQUEST['twoclick_buttons_maintenance_clear']) {
				/**
				 * Deleting all options from database.
				 */
//				twoclick_buttons_delete_options();

//				echo '<div id="message" class="updated fade">';
//				echo '<p><strong>';
//				_e('Settings deleted.', 'twoclick-buttons');
//				echo '</strong></p>';
//				echo '</div>';
			} else {
				/**
				 * Writing new options to database.
				 *
				 * @var array
				 */
				$array_Options = array(
					'twoclick_buttons_where' => (string) (@$_REQUEST['twoclick_buttons_where']),
					'twoclick_buttons_twitter_reply' => (string) (@$_REQUEST['twoclick_buttons_twitter_reply']),
					'twoclick_buttons_twitter_tweettext' => (string) (@$_REQUEST['twoclick_buttons_twitter_tweettext']),
					'twoclick_buttons_twitter_tweettext_owntext' => (string) (@$_REQUEST['twoclick_buttons_twitter_tweettext_owntext']),
					'twoclick_buttons_twitter_hashtags' => (int) (!empty($_REQUEST['twoclick_buttons_twitter_hashtags'])),
					'twoclick_buttons_twitter_tweettext_default_as' => (string) (@$_REQUEST['twoclick_buttons_twitter_tweettext_default_as']),
					'twoclick_buttons_flattr_uid' => (string) (@$_REQUEST['twoclick_buttons_flattr_uid']),
					'twoclick_buttons_pinterest_description' => (string) (@$_REQUEST['twoclick_buttons_pinterest_description']),

					'twoclick_buttons_display_page' => (int) (!empty($_REQUEST['twoclick_buttons_display_page'])),
					'twoclick_buttons_display_index' => (int) (!empty($_REQUEST['twoclick_buttons_display_index'])),
					'twoclick_buttons_display_year' => (int) (!empty($_REQUEST['twoclick_buttons_display_year'])),
					'twoclick_buttons_display_month' => (int) (!empty($_REQUEST['twoclick_buttons_display_month'])),
					'twoclick_buttons_display_day' => (int) (!empty($_REQUEST['twoclick_buttons_display_day'])),
					'twoclick_buttons_display_search' => (int) (!empty($_REQUEST['twoclick_buttons_display_search'])),
					'twoclick_buttons_display_tag' => (int) (!empty($_REQUEST['twoclick_buttons_display_tag'])),
					'twoclick_buttons_display_category' => (int) (!empty($_REQUEST['twoclick_buttons_display_category'])),

					'twoclick_buttons_display_facebook' => (int) (!empty($_REQUEST['twoclick_buttons_display_facebook'])),
					'twoclick_buttons_display_twitter' => (int) (!empty($_REQUEST['twoclick_buttons_display_twitter'])),
					'twoclick_buttons_display_googleplus' => (int) (!empty($_REQUEST['twoclick_buttons_display_googleplus'])),
					'twoclick_buttons_display_flattr' => (int) (!empty($_REQUEST['twoclick_buttons_display_flattr'])),
					'twoclick_buttons_display_xing' => (int) (!empty($_REQUEST['twoclick_buttons_display_xing'])),
					'twoclick_buttons_display_pinterest' => (int) (!empty($_REQUEST['twoclick_buttons_display_pinterest'])),

					'twoclick_buttons_display_facebook_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_facebook_perm'])),
					'twoclick_buttons_display_twitter_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_twitter_perm'])),
					'twoclick_buttons_display_googleplus_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_googleplus_perm'])),
					'twoclick_buttons_display_flattr_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_flattr_perm'])),
					'twoclick_buttons_display_xing_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_xing_perm'])),
					'twoclick_buttons_display_pinterest_perm' => (int) (!empty($_REQUEST['twoclick_buttons_display_pinterest_perm'])),

					'twoclick_buttons_infotext_facebook' => (string) (@$_REQUEST['twoclick_buttons_infotext_facebook']),
					'twoclick_buttons_infotext_twitter' => (string) (@$_REQUEST['twoclick_buttons_infotext_twitter']),
					'twoclick_buttons_infotext_googleplus' => (string) (@$_REQUEST['twoclick_buttons_infotext_googleplus']),
					'twoclick_buttons_infotext_flattr' => (string) (@$_REQUEST['twoclick_buttons_infotext_flattr']),
					'twoclick_buttons_infotext_xing' => (string) (@$_REQUEST['twoclick_buttons_infotext_xing']),
					'twoclick_buttons_infotext_pinterest' => (string) (@$_REQUEST['twoclick_buttons_infotext_pinterest']),
					'twoclick_buttons_infotext_infobutton' => (string) (@$_REQUEST['twoclick_buttons_infotext_infobutton']),
					'twoclick_buttons_infotext_permaoption' => (string) (@$_REQUEST['twoclick_buttons_infotext_permaoption']),
					'twoclick_buttons_infolink' => (string) (@$_REQUEST['twoclick_buttons_infolink']),

					'twoclick_buttons_facebook_action' => (string) (@$_REQUEST['twoclick_buttons_facebook_action']),
					'twoclick_buttons_postthumbnail' => (string) (@$_REQUEST['twoclick_buttons_postthumbnail']),
				);

				twoclick_buttons_update_options($array_Options);

				echo '<div id="message" class="updated fade">';
				echo '<p><strong>Einstellungen gespeichert</strong></p>';
				echo '</div>';
			}
		}
		?>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br /></div>
			<h2><?php _e('Settings for 2-Click Social Media Buttons', 'twoclick-socialmedia'); ?></h2>
			<form method="post" action="" id="twoclick-buttons-options">
				<?php wp_nonce_field('twoclick-buttons-options'); ?>
				<!-- Donation -->
				<div style="float:right; text-align:center; width:120px;  padding-top:25px;">
					<?php _e('Like this Plugin? Buy me a coffee.', 'twoclick-socialmedia'); ?><br />
					<p>
						<a href="<?php echo TWOCLICK_DONATE_FLATTR_LINK; ?>" target="_blank"><img src="http://api.flattr.com/button/flattr-badge-large.png" alt="Flattr this" title="Flattr this" border="0" /></a>
					</p>
					<p>
						<a class="PayPalButton" href="<?php echo TWOCLICK_DONATE_PAYPAL_LINK; ?>" target="_blank"><img src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_GB/i/btn/btn_donate_SM.gif" /></a>
					</p>
				</div>

				<!-- Anzeigeeinstellungen -->
				<div style="padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Display', 'twoclick-socialmedia'); ?></div>
					<div style="margin-left:100px;">

						<!-- Welche Buttons sollen angezeigt werden -->
						<!-- Facebook -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_facebook') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_facebook" id="twoclick_buttons_display_facebook" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_facebook" style="display:inline-block; width:150px;"><?php _e('Enable Facebook', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_facebook_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_facebook_perm" id="twoclick_buttons_display_facebook_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_facebook_perm"><?php _e('Option for permanent activation for Facebook', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Twitter -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_twitter') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_twitter" id="twoclick_buttons_display_twitter" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_twitter" style="display:inline-block; width:150px;"><?php _e('Enable Twitter', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_twitter_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_twitter_perm" id="twoclick_buttons_display_twitter_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_twitter_perm"><?php _e('Option for permanent activation for Twitter', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Google+ -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_googleplus') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_googleplus" id="twoclick_buttons_display_googleplus" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_googleplus" style="display:inline-block; width:150px;"><?php _e('Enable Google+', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_googleplus_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_googleplus_perm" id="twoclick_buttons_display_googleplus_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_googleplus_perm"><?php _e('Option for permanent activation for Google+', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Flattr -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_flattr') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_flattr" id="twoclick_buttons_display_flattr" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_flattr" style="display:inline-block; width:150px;"><?php _e('Enable Flattr', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_flattr_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_flattr_perm" id="twoclick_buttons_display_flattr_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_flattr_perm"><?php _e('Option for permanent activation for Flattr', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Xing -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_xing') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_xing" id="twoclick_buttons_display_xing" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_xing" style="display:inline-block; width:150px;"><?php _e('Enable Xing', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_xing_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_xing_perm" id="twoclick_buttons_display_xing_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_xing_perm"><?php _e('Option for permanent activation for Xing', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Pinterest -->
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_pinterest') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_pinterest" id="twoclick_buttons_display_xing" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_pinterest" style="display:inline-block; width:150px;"><?php _e('Enable Pinterest', 'twoclick-socialmedia'); ?></label>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_pinterest_perm') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_pinterest_perm" id="twoclick_buttons_display_pinterest_perm" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_pinterest_perm"><?php _e('Option for permanent activation for Pinterest', 'twoclick-socialmedia'); ?></label>
						</div>

						<!-- Auf welchen Seiten sollen die Buttons angezeigt werden -->
						<div style="margin-top:10px;">
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_page') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_page" id="twoclick_buttons_display_page" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_page"><?php _e('Display on CMS-Pages', 'twoclick-socialmedia'); ?></label>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_index') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_index" id="twoclick_buttons_display_index" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_index"><?php _e('Display on Index', 'twoclick-socialmedia'); ?></label>
						</div>
						<div style="margin-top:10px;">
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_year') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_year" id="twoclick_buttons_display_year" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_year"><?php _e('Display on Yearly Archives', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_month') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_month" id="twoclick_buttons_display_month" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_month"><?php _e('Display on Monthly Archives', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_day') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_day" id="twoclick_buttons_display_day" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_day"><?php _e('Display on Daily Archives', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div style="margin-top:10px;">
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_search') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_search" id="twoclick_buttons_display_search" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_search"><?php _e('Display on Search-Pages', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_category') == '1') echo 'cheched="checked"'; ?> name="twoclick_buttons_display_category" id="twoclick_buttons_display_category" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_category"><?php _e('Display on Category-Archive', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_display_tag') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_display_tag" id="twoclick_buttons_display_tag" group="twoclick_buttons_display" />
							<label for="twoclick_buttons_display_tag"><?php _e('Display on Tag-Archive', 'twoclick-socialmedia'); ?></label> <span class="description">(<?php _e('Note: Not every theme supports this option.',  'twoclick-socialmedia'); ?>)</span>
						</div>
						<div>
							<p>
								<?php _e('On singleposts the buttons will be shown by default. There is no option needed.', 'twoclick-socialmedia'); ?>
							</p>
						</div>
					</div>
				</div>

				<!-- Position innerhalb des Artikels -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Position', 'twoclick-socialmedia'); ?></div>
					<div style="margin-left:100px;">
						<div>
							<select name="twoclick_buttons_where">
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_where') == 'before') echo 'selected="selected"'; ?> value="before"><?php _e('Before the Post', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_where') == 'after') echo 'selected="selected"'; ?> value="after"><?php _e('After the Post', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_where') == 'shortcode') echo 'selected="selected"'; ?> value="shortcode"><?php _e('Manuall (Shortcode)', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_where') == 'template') echo 'selected="selected"'; ?> value="template"><?php _e('Manuall (Template)', 'twoclick-socialmedia'); ?></option>
							</select>
						</div>
						<div>
							<p>
								<?php _e('If you choose "Manuall (Shortcode)", you can use the shortcode <strong>[twoclick_buttons]</strong> inside your articles.', 'twoclick-socialmedia'); ?><br />
								<?php _e('If you choose "Manuall (Template)", you can use the code <strong>&lt;?php if(function_exists(\'get_twoclick_buttons\')) {get_twoclick_buttons(get_the_ID());}?&gt;</strong> inside your template. It\'s using all settings for "Display". <em><strong>Note:</strong> It will only work in single post or page templates. Not in any loop.</em>', 'twoclick-socialmedia'); ?>
							</p>
						</div>
					</div>
				</div>

				<!-- Infotexte -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Infotext<br /><em>(optional)</em>', 'twoclick-socialmedia'); ?></div>
					<div style="float:left;">
						<!-- Facebook -->
						<div>
							<label for="twoclick_buttons_infotext_facebook" style="display:inline-block; width:80px;"><?php _e('Facebook:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_facebook'); ?>" name="twoclick_buttons_infotext_facebook" id="twoclick_buttons_infotext_facebook" minlength="2" />
						</div>

						<!-- Twitter -->
						<div>
							<label for="twoclick_buttons_infotext_twitter" style="display:inline-block; width:80px;"><?php _e('Twitter:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_twitter'); ?>" name="twoclick_buttons_infotext_twitter" id="twoclick_buttons_infotext_twitter" minlength="2" />
						</div>

						<!-- Google+ -->
						<div>
							<label for="twoclick_buttons_infotext_googleplus" style="display:inline-block; width:80px;"><?php _e('Google+:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_googleplus'); ?>" name="twoclick_buttons_infotext_googleplus" id="twoclick_buttons_infotext_googleplus" minlength="2" />
						</div>

						<!-- Flattr -->
						<div>
							<label for="twoclick_buttons_infotext_flattr" style="display:inline-block; width:80px;"><?php _e('Flattr:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_flattr'); ?>" name="twoclick_buttons_infotext_flattr" id="twoclick_buttons_infotext_flattr" minlength="2" />
						</div>

						<!-- Xing -->
						<div>
							<label for="twoclick_buttons_infotext_xing" style="display:inline-block; width:80px;"><?php _e('Xing:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_xing'); ?>" name="twoclick_buttons_infotext_xing" id="twoclick_buttons_infotext_xing" minlength="2" />
						</div>

						<!-- Pinterest -->
						<div>
							<label for="twoclick_buttons_infotext_pinterest" style="display:inline-block; width:80px;"><?php _e('Pinterest:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_pinterest'); ?>" name="twoclick_buttons_infotext_pinterest" id="twoclick_buttons_infotext_pinterest" minlength="2" />
						</div>

						<!-- Infobutton -->
						<div>
							<label for="twoclick_buttons_infotext_infobutton" style="display:inline-block; width:80px;"><?php _e('Infobutton:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_infobutton'); ?>" name="twoclick_buttons_infotext_infobutton" id="twoclick_buttons_infotext_infobutton" minlength="2" />
						</div>

						<!--  Permaoption -->
						<div>
							<label for="twoclick_buttons_infotext_permaoption" style="display:inline-block; width:80px;"><?php _e('Permaoption:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infotext_permaoption'); ?>" name="twoclick_buttons_infotext_permaoption" id="twoclick_buttons_infotext_permaoption" minlength="2" />
						</div>

						<!-- Infolink -->
						<div>
							<label for="twoclick_buttons_infolink" style="display:inline-block; width:80px;"><?php _e('Infolink:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_infolink'); ?>" name="twoclick_buttons_infolink" id="twoclick_buttons_infolink" minlength="2" /><br />
							<span class="description"><?php _e('Links starting with http://', 'twoclick-socialmedia'); ?></span>
						</div>
					</div>
				</div>

				<!-- Artikelbild -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Postthumbnail<br /><em>(optional)</em>', 'twoclick-socialmedia'); ?></div>
					<div style="margin-left:100px;">
						<div>
							<label for="twoclick_buttons_postthumbnail" style="display:inline-block; width:80px;"><?php _e('Link:', 'twoclick-socialmedia'); ?></label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_postthumbnail'); ?>" name="twoclick_buttons_postthumbnail" id="twoclick_buttons_postthumbnail" minlength="2" />
							<input id="upload-image-button" type="button" value="<?php _e('Upload Image', 'twoclick-socialmedia'); ?>" /><br />
							<span class="description"><?php _e('Links starting with http://', 'twoclick-socialmedia'); ?></span>
						</div>
						<div>
							<p>
								<?php _e('This image is taken for Facebook, Google+ and Pinterest if there is no postthumbnail or other image inside the article or page. If empty, no image will be used for and the pinterest-button will be disabled for this article.', 'twoclick-socialmedia'); ?>
							</p>
						</div>
						<div>
							<?php
							if(twoclick_buttons_get_option('twoclick_buttons_postthumbnail') != '') {
								?>
								<p><img src="<?php echo twoclick_buttons_get_option('twoclick_buttons_postthumbnail'); ?>" /></p>
								<?php
							}
							?>
						</div>
					</div>
				</div>

				<!-- Facebook -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Facebook', 'twoclick-socialmedia'); ?></div>
					<div style="float:left;">
						<label for="twoclick_buttons_facebook_action" style="display:inline-block; width:80px;"><?php _e('Button:', 'twoclick-socialmedia'); ?></label>
						<select name="twoclick_buttons_facebook_action">
							<option <?php if(twoclick_buttons_get_option('twoclick_buttons_facebook_action') == 'recommend') echo 'selected="selected"'; ?> value="recommend"><?php _e('Recommend', 'twoclick-socialmedia'); ?></option>
							<option <?php if(twoclick_buttons_get_option('twoclick_buttons_facebook_action') == 'like') echo 'selected="selected"'; ?> value="like"><?php _e('Like', 'twoclick-socialmedia'); ?></option>
						</select>
					</div>
				</div>

				<!-- Twitter -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Twitter', 'twoclick-socialmedia'); ?></div>
					<div style="float:left;">
						<div>
							<label for="twoclick_buttons_twitter_reply" style="display:inline-block; width:80px;">RT @:</label>
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_twitter_reply'); ?>" name="twoclick_buttons_twitter_reply" id="twoclick_buttons_twitter_reply" class="required" minlength="2" />
							<span class="description"><?php _e('Please use \'yourname\', <strong>not</strong> \'RT @yourname\'.', 'twoclick-socialmedia'); ?></span>
						</div>
						<div>
							<?php _e('Tweettext:', 'twoclick-socialmedia'); ?>
						</div>
						<div>
							<input type="radio" value="default" <?php if (twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext') == 'default') echo 'checked="checked"'; ?> name="twoclick_buttons_twitter_tweettext" id="twoclick_buttons_twitter_tweettext_default" group="twoclick_buttons_twitter_tweettext" />
							<select name="twoclick_buttons_twitter_tweettext_default_as">
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_default_as') == 'posttitle-blogtitle') echo 'selected="selected"'; ?> value="posttitle-blogtitle"><?php _e('Posttitle &raquo; Blogtitle', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_default_as') == 'posttitle') echo 'selected="selected"'; ?> value="posttitle"><?php _e('Posttitle', 'twoclick-socialmedia'); ?></option>
							</select>
							<label for="twoclick_buttons_twitter_tweettext_default"><?php _e('The title of the page the button is on.', 'twoclick-socialmedia'); ?></label>
						</div>
						<div>
							<input type="radio" value="own" <?php if (twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext') == 'own') echo 'checked="checked"'; ?> name="twoclick_buttons_twitter_tweettext" id="twoclick_buttons_twitter_tweettext_own" group="twoclick_buttons_twitter_tweettext" />
							<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_owntext'); ?>" name="twoclick_buttons_twitter_tweettext_owntext" id="twoclick_buttons_twitter_tweettext_owntext" />
							<span class="description"><?php _e('This is the text that people will include in their Tweet when they share from your website.', 'twoclick-socialmedia'); ?></span>
							<?php if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext') == 'own' && strlen(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_owntext')) == 0) : ?>
							<div class="error">
								<p style="font-weight:bold;">
									<?php _e('Custom tweettext missing !!!', 'twoclick-socialmedia'); ?>
								</p>
								<p>
									<?php _e('Please enter a custom tweettext. Otherweise the plugin will use default settings for tweetext as &quot;<strong>Posttitle &raquo; Blogtitle</strong>&quot;', 'twoclick-socialmedia'); ?>
								</p>
							</div>
							<?php endif; ?>
						</div>
						<div>
							<input type="checkbox" value="1" <?php if(twoclick_buttons_get_option('twoclick_buttons_twitter_hashtags') == '1') echo 'checked="checked"'; ?> name="twoclick_buttons_twitter_hashtags" id="twoclick_buttons_twitter_hashtags" group="twoclick_buttons_twitter_tweettext" />
							<label for="twoclick_buttons_twitter_hashtags"><?php _e('Use tags as #hashtags', 'twoclick-socialmedia'); ?></label>
						</div>
					</div>
				</div>

				<!-- Flattr -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Flattr', 'twoclick-socialmedia'); ?></div>
					<div style="float:left;">
						<label for="twoclick_buttons_flattr_uid" style="display:inline-block; width:80px;"><?php _e('User:', 'twoclick-socialmedia'); ?></label>
						<input type="text" value="<?php echo twoclick_buttons_get_option('twoclick_buttons_flattr_uid'); ?>" name="twoclick_buttons_flattr_uid" id="twoclick_buttons_flattr_uid" class="required" minlength="2" />
					</div>
				</div>

				<!-- Pinterest -->
				<div style="clear:both; padding-top:25px;">
					<div style="float:left; width:100px"><?php _e('Pinterest', 'twoclick-socialmedia'); ?></div>
					<div style="float:left;">
						<div>
							<?php _e('Description:', 'twoclick-socialmedia'); ?>
						</div>
						<div>
							<select name="twoclick_buttons_pinterest_description">
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_pinterest_description') == 'posttitle') echo 'selected="selected"'; ?> value="posttitle"><?php _e('Posttitle', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_pinterest_description') == 'posttitle-tags') echo 'selected="selected"'; ?> value="posttitle-tags"><?php _e('Posttitle and #Tags', 'twoclick-socialmedia'); ?></option>
								<option <?php if(twoclick_buttons_get_option('twoclick_buttons_pinterest_description') == 'posttitle-excerpt') echo 'selected="selected"'; ?> value="posttitle-excerpt"><?php _e('Posttitle &raquo; Excerpt', 'twoclick-socialmedia'); ?></option>
							</select>
							<label for="twoclick_buttons_pinterest_description"><?php _e('The description wich is send to Pinterest.', 'twoclick-socialmedia'); ?></label>
						</div>
					</div>
				</div>

				<!-- Speichern -->
				<div style="clear:both;">
					<p class="submit" style="clear:both;">
						<input type="submit" name="Submit" value="<?php _e('Save Changes', 'twoclick-socialmedia'); ?>" />
					</p>
				</div>
			</form>
		</div>
		<?php
	}
}

/**
 * Buttons in WordPress einbauen.
 *
 * @since 0.1 (rewritten at 0.22)
 */
function twoclick_buttons($content) {
	global $post;

	/**
	 * Manual Option
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_where') == 'template') {
		return $content;
	}

	/**
	 * Sind wir auf einer CMS-Seite?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_page') == null && is_page()) {
		return $content;
	}

	/**
	 * Sind wir auf der Startseite?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_index') == null && is_home()) {
		return $content;
	}

	/**
	 * Sind wir im Jahresarchiv?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_year') == null && is_year()) {
		return $content;
	}

	/**
	 * Sind wir im Monatsarchiv?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_month') == null && is_month()) {
		return $content;
	}

	/**
	 * Sind wir im Tagesarchiv?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_day') == null && is_day()) {
		return $content;
	}

	/**
	 * Sind wir auf der Suchseite?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_search') == null && is_search()) {
		return $content;
	}

	/**
	 * Sind wir auf der Tagseite?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_tag') == null && is_tag()) {
		return $content;
	}

	/**
	 * Sind wir auf der Kategorieseite?
	 */
	if(twoclick_buttons_get_option('twoclick_buttons_display_category') == null && is_category()) {
		return $content;
	}

	/**
	 * Soll der Button im Feed ausgeblendet werden?
	 */
	if(is_feed()) {
		return $content;
	}

	$button = twoclick_buttons_generate_html(get_the_ID());
	$where = 'twoclick_buttons_where';

	/**
	 * Wurde der Shortcode genutzt
	 */
	if(twoclick_buttons_get_option($where) == 'shortcode') {
		return str_replace('[twoclick_buttons]', $button, $content);
	} else {
		/**
		 * In den Content einbinden
		 */
		if(get_post_meta($post->ID, 'twoclick_buttons') == null) {
			if(twoclick_buttons_get_option($where) == 'beforeandafter') {
				/**
				 * Vor und nach dem Beitrag einfügen
				 */
				return $button . $content . $button;
			} else if(twoclick_buttons_get_option($where) == 'before') {
				/**
				 * Vor dem Beitrag einfügen
				 */
				return $button . $content;
			} else {
				/**
				 * Nach dem Beitrag einfügen
				 */
				return $content . $button;
			}
		} else {
			/**
			 * Keinen Button einfügen
			 */
			return $content;
		}
	}
}

/**
 * Post Excerpt generieren, wenn noch keiner da ist ...
 *
 * @since 0.10
 */
if(!function_exists('twoclick_buttons_generate_post_excerpt')) {
	function twoclick_buttons_generate_post_excerpt($excerpt, $maxlength) {
		if(function_exists('strip_shortcodes')) {
			$excerpt = strip_shortcodes($excerpt);
		}

		$excerpt = trim($excerpt);

		// Now lets strip any tags which dont have balanced ends
		// Need to put NGgallery tags in there - there are a lot of them and they are all different.
		$open_tags = "[simage,[[CP,[gallery,[imagebrowser,[slideshow,[tags,[albumtags,[singlepic,[album";
		$close_tags = "],]],],],],],],],]";
		$open_tag = explode(",", $open_tags);
		$close_tag = explode(",", $close_tags);

		foreach(array_keys($open_tag) as $key) {
			if(preg_match_all('/' . preg_quote($open_tag[$key]) . '(.*?)' . preg_quote($close_tag[$key]) . '/i', $excerpt, $matches)) {
				$excerpt = str_replace($matches[0], "", $excerpt);
			}
		} // END foreach(array_keys($open_tag) as $key)

		$excerpt = preg_replace('#(<wpg.*?>).*?(</wpg2>)#', '$1$2', $excerpt);

		// Support for qTrans
		if(function_exists('qtrans_use')) {
			global $q_config;
			$excerpt = qtrans_use($q_config['default_language'], $excerpt);
		} // END if(function_exists('qtrans_use'))
		$excerpt = strip_tags($excerpt);

		// Now lets strip off the youtube stuff.
		preg_match_all('#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)player_embedded#i', $excerpt, $matches);
		$excerpt = str_replace($matches[0], "", $excerpt);

		preg_match_all('#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=|embed/)([\w-]+)(.*?)#i', $excerpt, $matches);
		$excerpt = str_replace($matches[0], "", $excerpt);

		if(strlen($excerpt) > $maxlength) {
			# If we've got multibyte support then we need to make sure we get the right length - Thanks to Kensuke Akai for the fix
			if(function_exists('mb_strimwidth')) {
				$excerpt = mb_strimwidth($excerpt, 0, $maxlength, " ...");
			} else {
				$excerpt = current(explode("SJA26666AJS", wordwrap($excerpt, $maxlength, "SJA26666AJS"))) . " ...";
			} // END if(function_exists('mb_strimwidth'))
		} // END if(strlen($excerpt) > $maxlength)

		return strip_tags($excerpt);
	} // END function twoclick_buttons_generate_post_excerpt($excerpt, $maxlength)
} // END if(!function_exists('twoclick_buttons_generate_post_excerpt'))

/**
 * Tweettext einbinden
 *
 * @since 0.14
 */
if(!function_exists('twoclick_buttons_get_tweettext')) {
	function twoclick_buttons_get_tweettext() {
		global $post;

		$twitter_hashtags = twoclick_buttons_get_hashtags();
		$tweettext = '';

		if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext') == 'own') {
			if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext') == 'own' && strlen(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_owntext')) == 0) {
				$tweettext = get_the_title(get_the_ID()) . ' » ' . get_bloginfo('name') . $twitter_hashtags;
			} else {
				$tweettext = twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_owntext') . $twitter_hashtags;
			}
		} else {
			if(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_default_as') == 'posttitle-blogtitle') {
				$tweettext = get_the_title(get_the_ID()) . ' » ' . get_bloginfo('name') . $twitter_hashtags;
			} elseif(twoclick_buttons_get_option('twoclick_buttons_twitter_tweettext_default_as') == 'posttitle') {
				$tweettext = get_the_title(get_the_ID()) . $twitter_hashtags;
			}
		}

// 		return twoclick_buttons_shorten_tweettext($tweettext);
		return twoclick_buttons_shorten_tweettext(html_entity_decode($tweettext, ENT_QUOTES, get_bloginfo('charset')));
	}
}

/**
 * Description for Pinterest
 *
 * @since 0.32
 */
if(!function_exists('twoclick_buttons_get_pinterest_description')) {
	function twoclick_buttons_get_pinterest_description() {
		$var_sPinterestDescription = '';

		switch(twoclick_buttons_get_option('twoclick_buttons_pinterest_description')) {
			case 'posttitle-tags':
				$var_sPinterestDescription = strip_tags(get_the_title(get_the_ID())) . ' ' . strip_tags(get_the_tag_list(' #', ' #', ''));
				break;

			case 'posttitle-excerpt':
				$var_sPinterestDescription = strip_tags(get_the_title(get_the_ID())) . ' &raquo; ' . twoclick_buttons_generate_post_excerpt(get_the_content(), 70);
				break;

			default:
				$var_sPinterestDescription = strip_tags(get_the_title(get_the_ID()));
				break;
		}

		return rawurlencode($var_sPinterestDescription);
	}
}

/**
 * Tweettext kürzen
 *
 * @since 0.14
 */
if(!function_exists('twoclick_buttons_shorten_tweettext')) {
	function twoclick_buttons_shorten_tweettext($tweettext) {
		$array_tweettextData = array(
			'length_tweettext_maximal' => 140,
			'length_tweettext' => strlen($tweettext),
			'length_twitter_name' => strlen(' via @' . twoclick_buttons_get_option('twoclick_buttons_twitter_reply')),
			'length_tweetlink' => 20,
			'length_more' => strlen(' [...]')
		);

		$length_new_tweettext = $array_tweettextData['length_tweettext_maximal'] - $array_tweettextData['length_twitter_name'] - $array_tweettextData['length_tweetlink'] - $array_tweettextData['length_more'];

		if($array_tweettextData['length_tweettext'] > $length_new_tweettext) {
			$tweettext = substr($tweettext, 0, $length_new_tweettext) . ' [...]';
		}

		return $tweettext;
	}
}

/**
 * Tags des Artikels in #Hashtags umwandeln
 *
 * @since 0.14
 */
if(!function_exists('twoclick_buttons_get_hashtags')) {
	function twoclick_buttons_get_hashtags() {
		/**
		 * Sollen #Hashtags angezeigt werden?
		 */
		if (twoclick_buttons_get_option('twoclick_buttons_twitter_hashtags') == '1') {
			$hashtags = strip_tags(get_the_tag_list(' #', ' #', ''));
		} else {
			$hashtags = '';
		}

		return $hashtags;
	}
}

/**
 * HTML generieren.
 *
 * @since 0.1
 */
if(!function_exists('twoclick_buttons_generate_html')) {
	function twoclick_buttons_generate_html($var_sPostID = '') {
		if($var_sPostID == '') {
			$var_sPostID = get_the_ID();
		}

		return twoclick_buttons_get_js($var_sPostID);
	}
}

/**
 * Template-Tag zur Verfügung stellen.
 * Einbindung:
 * 		<?php if(function_exists('get_twoclick_buttons')) {get_twoclick_buttons(get_the_ID());}?>
 *
 * @since 0.18
 */
if(!function_exists('get_twoclick_buttons')) {
	function get_twoclick_buttons($var_sPostId) {
		if(twoclick_buttons_get_option('twoclick_buttons_where') == 'template') {
			/**
			 * Wenn der Button nicht auf CMS-Seiten angezeigt werden soll.
			 */
			echo twoclick_buttons_generate_html($var_sPostId);
		}
	}
}

/**
 * Dummybilder bereit stellen.
 *
 * Je nach Sprache des Blogs werden verschiedene Dummybilder bereit gestellt.
 * Im Moment stehen Bilder für Deutsch und Englisch zur Verfügung.
 * Sollte kein Bild für die jeweilige Sprache gefunden werden, so wird das Bild ohne Sprachcode hergenommen.
 *
 * @since 0.14
 * @since 0.32 (modified)
 */
if(!function_exists('twoclick_buttons_get_dummy_images')) {
	function twoclick_buttons_get_dummy_images($var_sLang = '') {
		$var_sPluginsUrl =  plugin_dir_url(__FILE__);
		$var_sPluginsPath = plugin_dir_path(__FILE__);

		if(empty($var_sLang)) {
			$var_sLang = get_locale();
		}

		$array_DummyImages = array(
			'facebook-recommend' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/facebook-dummy-image-recommend-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/facebook-dummy-image-recommend-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/facebook-dummy-image-recommend.png',
				'width' => '82'
			),
			'facebook-like' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/facebook-dummy-image-like-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/facebook-dummy-image-like-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/facebook-dummy-image-like.png',
				'width' => '72'
			),
			'twitter' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/twitter-dummy-image-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/twitter-dummy-image-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/twitter-dummy-image.png',
				'width' => '62'
			),
			'googleplus' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/googleplus-dummy-image-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/googleplus-dummy-image-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/googleplus-dummy-image.png',
				'width' => '32'
			),
			'flattr' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/flattr-dummy-image-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/flattr-dummy-image-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/flattr-dummy-image.png',
				'width' => '54'
			),
			'xing' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/xing-dummy-image-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/xing-dummy-image-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/xing-dummy-image.png',
				'width' => '55'
			),
			'pinterest' => array(
				'image' => (is_readable($var_sPluginsPath . 'images/pinterest-dummy-image-' . $var_sLang . '.png')) ? $var_sPluginsUrl . 'images/pinterest-dummy-image-' . $var_sLang . '.png' : $var_sPluginsUrl . 'images/pinterest-dummy-image.png',
				'width' => '63'
			)
		);

		return $array_DummyImages;
	}
}

/**
 * CSS in den Head auslagern.
 *
 * @since 0.1
 */
if(!function_exists('twoclick_buttons_head')) {
	function twoclick_buttons_head() {
		if(!is_admin()) {
			$var_sCss = plugins_url(basename(dirname(__FILE__)) . '/css/socialshareprivacy.css');

			echo '<!-- 2-Click Social Media Buttons by H.-Peter Pfeufer -->' . "\n" . '<link rel="stylesheet" id="twoclick-socialshar-buttons"  href="' . $var_sCss . '" type="text/css" media="all" />' . "\n";
			echo twoclick_buttons_opengraph_tags();
		}
	}
}

/**
 * JS for imageupload to the admin head
 *
 * @since 0.32
 */
if(!function_exists('twoclick_buttons_admin_head')) {
	function twoclick_buttons_admin_head() {
		global $current_screen;

		if($current_screen->id == 'settings_page_twoclick-buttons-options') {
			/**
			 * JavaScript
			 */
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_register_script('twoclick-image-upload', plugins_url(basename(dirname(__FILE__))) . '/js/jquery-media-upload.js', array(
				'jquery',
				'media-upload',
				'thickbox'
			));
			wp_localize_script('twoclick-image-upload', 'twoclick_localizing_upload_js', array(
				'use_this_image' => __('Use This Image', 'twoclick-socialmedia')
			));
			wp_enqueue_script('twoclick-image-upload');

			/**
			 * CSS
			 */
			wp_enqueue_style('thickbox');
		}
	}

	add_action('admin_head', 'twoclick_buttons_admin_head');
}

/**
 * Artikelbild
 *
 * @since 0.32
 */
if(!function_exists('twoclick_buttons_get_article_image')) {
	function twoclick_buttons_get_article_image() {
		global $post;

		$array_Image = '';

		/**
		 * Abfrage ob das Theme Post Thumbnails unterstützt.
		 * Einige Themes tun das einfach nicht.
		 *
		 * @since 0.7.1
		 */
		if(function_exists('get_post_thumbnail_id')) {
			$array_Image = wp_get_attachment_image_src(get_post_thumbnail_id($GLOBALS['post']->ID));
		}

		if(is_array($array_Image)) {
			$var_sFaceBookThumbnail = $array_Image['0'];
		} else {
			$var_sDefaultThumbnail = '';
			$var_sOutput = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $GLOBALS['post']->post_content, $array_Matches);

			if($var_sOutput > 0) {
				$var_sFaceBookThumbnail = $array_Matches[1][0];
			} else {
				if(twoclick_buttons_get_option('twoclick_buttons_postthumbnail') != '') {
					$var_sFaceBookThumbnail = twoclick_buttons_get_option('twoclick_buttons_postthumbnail');
				} else {
					$var_sFaceBookThumbnail = false;
				}
			}
		}

		return $var_sFaceBookThumbnail;
	}
}

/**
 * Schreibe OpenGraph-Tags und Artikelbild in den <head>-Bereich.
 *
 * @since 0.7
 */
if(!function_exists('twoclick_buttons_opengraph_tags')) {
	function twoclick_buttons_opengraph_tags() {
		global $post;

		/* Nur Einzelartikel */
		if(is_feed() || is_trackback() || !is_singular()) {
			return;
		}

		$var_sPostThumbnail = twoclick_buttons_get_article_image();
		/* Ausgabe */
		echo "\n" . '<!-- Facebook Like Thumbnail -->' . "\n";
		if($var_sPostThumbnail) {
			echo sprintf('<link href="%s" rel="image_src" />%s', esc_url($var_sPostThumbnail), "\n");
		}

		/**
		 * Post Excerpt suchen und eventuell setzen, da sonst bei Facebook und G+ nichts steht.
		 * Sollte der Post keinen eigenen Excerpt haben, wird einer aus dem Artikel extrahiert.
		 * Dieser wird dann, ganz Twitterstyle, auf 140 Zeichen begrenzt.
		 *
		 * @since 0.10
		 */
		if(has_excerpt()) {
			define('TWOCLICK_POST_EXCERPT', $post->post_excerpt);
		} else {
			define('TWOCLICK_POST_EXCERPT', twoclick_buttons_generate_post_excerpt($post->post_content, 400));
		}

		/**
		 * Open:Graph-Tags fuer FB-Like
		 *
		 * @since 0.7
		 */
		echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '"/>' . "\n";
		echo '<meta property="og:type" content="article"/>' . "\n";
		echo '<meta property="og:title" content="' . strip_tags(get_the_title()) . '"/>' . "\n";
		echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '"/>' . "\n";
		if($var_sPostThumbnail) {
			echo '<meta property="og:image" content="' . esc_url($var_sPostThumbnail) . '"/>' . "\n";
		}
		echo '<meta property="og:description" content="' . strip_tags(esc_attr(TWOCLICK_POST_EXCERPT)) . '"/>' . "\n";
		echo '<!-- Facebook Like Thumbnail -->' . "\n";
	}
}

/**
 * JavaScript in den Footer auslagern.
 *
 * @since 0.1
 */
if(!function_exists('twoclick_buttons_footer')) {
	function twoclick_buttons_footer() {
		if(!is_admin()) {
// 			$var_sJavaScript = plugins_url(basename(dirname(__FILE__)) . '/js/social_bookmarks.js');
			$var_sJavaScript = plugins_url(basename(dirname(__FILE__)) . '/js/social_bookmarks-min.js');

			echo '<!-- 2-Click Social Media Buttons by H.-Peter Pfeufer -->' . "\n" . '<script type="text/javascript" src="' . $var_sJavaScript . '"></script>';
		}
	}
}

/**
 * JavaScript für Ausgabe generieren.
 *
 * @since 0.4
 */
if(!function_exists('twoclick_buttons_get_js')) {
	function twoclick_buttons_get_js($var_sPostID = '') {
		if(!is_admin()) {
			if($var_sPostID == '') {
				$var_sPostID = get_the_ID();
			}

			$var_sTitle = rawurlencode(get_the_title($var_sPostID));
			$var_sTweettext = rawurlencode(twoclick_buttons_get_tweettext());
			$var_sArticleImage = twoclick_buttons_get_article_image();

			$var_sShowFacebook = (twoclick_buttons_get_option('twoclick_buttons_display_facebook')) ? 'on' : 'off';
			$var_sShowFacebookPerm = (twoclick_buttons_get_option('twoclick_buttons_display_facebook_perm')) ? 'on' : 'off';
			$var_sShowTwitter = (twoclick_buttons_get_option('twoclick_buttons_display_twitter')) ? 'on' : 'off';
			$var_sShowFlattr = (twoclick_buttons_get_option('twoclick_buttons_display_flattr')) ? 'on' : 'off';
			$var_sShowXing = (twoclick_buttons_get_option('twoclick_buttons_display_xing')) ? 'on' : 'off';
			$var_sShowPinterest = (twoclick_buttons_get_option('twoclick_buttons_display_pinterest') && $var_sArticleImage != false) ? 'on' : 'off';

			$var_sShowTwitterPerm = (twoclick_buttons_get_option('twoclick_buttons_display_twitter_perm')) ? 'on' : 'off';
			$var_sShowGoogleplus = (twoclick_buttons_get_option('twoclick_buttons_display_googleplus')) ? 'on' : 'off';
			$var_sShowGoogleplusPerm = (twoclick_buttons_get_option('twoclick_buttons_display_googleplus_perm')) ? 'on' : 'off';
			$var_sShowFlattrPerm = (twoclick_buttons_get_option('twoclick_buttons_display_flattr_perm')) ? 'on' : 'off';
			$var_sShowXingPerm = (twoclick_buttons_get_option('twoclick_buttons_display_xing_perm')) ? 'on' : 'off';
			$var_sShowPinterestPerm = (twoclick_buttons_get_option('twoclick_buttons_display_pinterest_perm')) ? 'on' : 'off';

			$var_sCss = plugins_url(basename(dirname(__FILE__)) . '/css/socialshareprivacy.css');
			$var_sXingLib = plugins_url(basename(dirname(__FILE__)) . '/libs/xing.php');
			$var_sPinterestLib = plugins_url(basename(dirname(__FILE__)) . '/libs/pinterest.php');

			$var_sPostExcerpt = '';
			if(is_singular()) {
				$var_sPostExcerpt = rawurlencode(TWOCLICK_POST_EXCERPT);
			} else {
				$var_sPostExcerpt = rawurlencode(twoclick_buttons_generate_post_excerpt(get_the_content(), 400));
				$var_sShowFacebookPerm = 'off';
				$var_sShowTwitterPerm = 'off';
				$var_sShowGoogleplusPerm = 'off';
				$var_sShowFlattrPerm = 'off';
				$var_sShowXingPerm = 'off';
				$var_sShowPinterestPerm = 'off';
			}

			/**
			 * Link zusammenbauen, auch wenn Optionen übergeben werden.
			 *
			 * @since 0.16
			 */
			if(isset($_GET) && count($_GET) != '0') {
				$var_sPermalink = (isset($_SERVER['HTTPS'])?'https':'http').'://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			} else {
				$var_sPermalink = get_permalink($var_sPostID);
			}

			// Infotexte
			$var_sInfotextFacebook = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Facebook senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_facebook') != '') {
				$var_sInfotextFacebook = twoclick_buttons_get_option('twoclick_buttons_infotext_facebook');
			}

			$var_sInfotextTwitter = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Twitter senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_twitter') != '') {
				$var_sInfotextTwitter = twoclick_buttons_get_option('twoclick_buttons_infotext_twitter');
			}

			$var_sInfotextGoogleplus = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Google+ senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_googleplus') != '') {
				$var_sInfotextGoogleplus = twoclick_buttons_get_option('twoclick_buttons_infotext_googleplus');
			}

			$var_sInfotextFlattr = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Flattr senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_flattr') != '') {
				$var_sInfotextFlattr = twoclick_buttons_get_option('twoclick_buttons_infotext_flattr');
			}

			$var_sInfotextXing = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Xing senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_xing') != '') {
				$var_sInfotextXing = twoclick_buttons_get_option('twoclick_buttons_infotext_xing');
			}

			$var_sInfotextPinterest = '2 Klicks für mehr Datenschutz: Erst wenn Sie hier klicken, wird der Button aktiv und Sie können Ihre Empfehlung an Pinterest senden. Schon beim Aktivieren werden Daten an Dritte übertragen - siehe <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_pinterest') != '') {
				$var_sInfotextPinterest = twoclick_buttons_get_option('twoclick_buttons_infotext_pinterest');
			}

			$var_sInfotextInfobutton = 'Wenn Sie diese Felder durch einen Klick aktivieren, werden Informationen an Facebook, Twitter, Flattr oder Google ins Ausland übertragen und unter Umständen auch dort gespeichert. Näheres erfahren Sie durch einen Klick auf das <em>i</em>.';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_infobutton') != '') {
				$var_sInfotextInfobutton = twoclick_buttons_get_option('twoclick_buttons_infotext_infobutton');
			}

			$var_sInfotextPermaoption = 'Dauerhaft aktivieren und Datenüber-tragung zustimmen:';
			if(twoclick_buttons_get_option('twoclick_buttons_infotext_permaoption') != '') {
				$var_sInfotextPermaoption = twoclick_buttons_get_option('twoclick_buttons_infotext_permaoption');
			}

			$var_sInfolink = 'http://www.heise.de/ct/artikel/2-Klicks-fuer-mehr-Datenschutz-1333879.html';
			if(twoclick_buttons_get_option('twoclick_buttons_infolink') != '') {
				$var_sInfolink = trim(twoclick_buttons_get_option('twoclick_buttons_infolink'));
			}

			// Dummybilder holen.
			$array_DummyImages = twoclick_buttons_get_dummy_images(get_locale());

			// Sprache für Xing und Twitter
			$var_sButtonLanguage = 'de';
			if(get_locale() != 'de_DE') {
				$var_sButtonLanguage = 'en';
			}

			$var_sFacebookAction = (twoclick_buttons_get_option('twoclick_buttons_facebook_action')) ? twoclick_buttons_get_option('twoclick_buttons_facebook_action') : 'recommend';

			$array_ButtonData = array(
				'services' => array(
					'facebook' => array(
						'dummy_img' => $array_DummyImages['facebook-' . $var_sFacebookAction]['image'],
						'dummy_img_width' => $array_DummyImages['facebook-' . $var_sFacebookAction]['width'],
						'dummy_img_height' => '20',
						'status' => $var_sShowFacebook,
						'txt_info' => $var_sInfotextFacebook,
						'perma_option' => $var_sShowFacebookPerm,
						'action' => twoclick_buttons_get_option('twoclick_buttons_facebook_action'),
						'language' => get_locale()
					),
					'twitter' => array(
						'reply_to' => twoclick_buttons_get_option('twoclick_buttons_twitter_reply'),
						'dummy_img' => $array_DummyImages['twitter']['image'],
						'dummy_img_width' => $array_DummyImages['twitter']['width'],
						'dummy_img_height' => '20',
						'tweet_text' => rawurlencode(twoclick_buttons_get_tweettext()),
						'status' => $var_sShowTwitter,
						'txt_info' => $var_sInfotextTwitter,
						'perma_option' => $var_sShowTwitterPerm,
						'language' => $var_sButtonLanguage
					),
					'gplus' => array(
						'dummy_img' => $array_DummyImages['googleplus']['image'],
						'dummy_img_width' => $array_DummyImages['googleplus']['width'],
						'dummy_img_height' => '20',
						'status' => $var_sShowGoogleplus,
						'txt_info' => $var_sInfotextGoogleplus,
						'perma_option' => $var_sShowGoogleplusPerm
					),
					'flattr' => array(
						'uid' => twoclick_buttons_get_option('twoclick_buttons_flattr_uid'),
						'dummy_img' => $array_DummyImages['flattr']['image'],
						'dummy_img_width' => $array_DummyImages['flattr']['width'],
						'dummy_img_height' => '20',
						'status' => $var_sShowFlattr,
						'the_title' => $var_sTitle,
						'the_excerpt' => $var_sPostExcerpt,
						'txt_info' => $var_sInfotextFlattr,
						'perma_option' => $var_sShowFlattrPerm
					),
					'xing' => array(
						'dummy_img' => $array_DummyImages['xing']['image'],
						'dummy_img_width' => $array_DummyImages['xing']['width'],
						'dummy_img_height' => '20',
						'status' => $var_sShowXing,
						'txt_info' => $var_sInfotextXing,
						'perma_option' => $var_sShowXingPerm,
						'language' => $var_sButtonLanguage,
						'xing_lib' => $var_sXingLib
					),
					'pinterest' => array(
						'dummy_img' => $array_DummyImages['pinterest']['image'],
						'dummy_img_width' => $array_DummyImages['pinterest']['width'],
						'dummy_img_height' => '20',
						'status' => $var_sShowPinterest,
						'the_excerpt' => twoclick_buttons_get_pinterest_description(),
						'txt_info' => $var_sInfotextPinterest,
						'perma_option' => $var_sShowPinterestPerm,
						'pinterest_lib' => $var_sPinterestLib,
						'media' => $var_sArticleImage
					)
				),
				'txt_help' => $var_sInfotextInfobutton,
				'settings_perma' => $var_sInfotextPermaoption,
				'info_link' => $var_sInfolink,
				'css_path' => apply_filters('twoclick-css', $var_sCss),
				'uri' => esc_url($var_sPermalink)
			);

			$var_sJavaScript = '/* <![CDATA[ */' . "\n" . '// WP-Language = ' . get_locale() . "\n" . 'jQuery(document).ready(function($){if($(\'.twoclick_social_bookmarks_post_' . $var_sPostID . '\')){$(\'.twoclick_social_bookmarks_post_' . $var_sPostID . '\').socialSharePrivacy(' . json_encode($array_ButtonData) . ');}});' . "\n" . '/* ]]> */';

			return '<div class="twoclick_social_bookmarks_post_' . $var_sPostID . ' social_share_privacy clearfix"></div><script type="text/javascript">' . $var_sJavaScript . '</script>';
		}
	}
}

/**
 * Changelog bei Pluginupdate ausgeben.
 *
 * @since 0.1
 */
if(!function_exists('twoclick_buttons_update_notice')) {
	function twoclick_buttons_update_notice() {
		$array_2CSMB_Data = get_plugin_data(__FILE__);
		$var_sUserAgent = 'Mozilla/5.0 (X11; Linux x86_64; rv:5.0) Gecko/20100101 Firefox/5.0 WorPress Plugin 2-Click Social Media Buttons (Version: ' . $array_2CSMB_Data['Version'] . ') running on: ' . get_bloginfo('url');
		$url_readme = 'http://plugins.trac.wordpress.org/browser/2-click-socialmedia-buttons/trunk/readme.txt?format=txt';
		$data = '';

		if(ini_get('allow_url_fopen')) {
			$data = file_get_contents($url_readme);
		} else {
			if(function_exists('curl_init')) {
				$cUrl_Channel = curl_init();
				curl_setopt($cUrl_Channel, CURLOPT_URL, $url_readme);
				curl_setopt($cUrl_Channel, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($cUrl_Channel, CURLOPT_USERAGENT, $var_sUserAgent);
				$data = curl_exec($cUrl_Channel);
				curl_close($cUrl_Channel);
			} // END if(function_exists('curl_init'))
		} // END if(ini_get('allow_url_fopen'))

		if($data) {
			$matches = null;
			$regexp = '~==\s*Changelog\s*==\s*=\s*[0-9.]+\s*=(.*)(=\s*' . preg_quote($array_2CSMB_Data['Version']) . '\s*=|$)~Uis';

			if(preg_match($regexp, $data, $matches)) {
				$changelog = (array) preg_split('~[\r\n]+~', trim($matches[1]));

				echo '</div><div class="update-message" style="font-weight: normal;"><strong>What\'s new:</strong>';
				$ul = false;
				$version = 99;

				foreach($changelog as $index => $line) {
					if(version_compare($version, $array_2CSMB_Data['Version'], ">")) {
						if(preg_match('~^\s*\*\s*~', $line)) {
							if(!$ul) {
								echo '<ul style="list-style: disc; margin-left: 20px;">';
								$ul = true;
							} // END if(!$ul)

							$line = preg_replace('~^\s*\*\s*~', '', $line);
							echo '<li>' . $line . '</li>';
						} else {
							if($ul) {
								echo '</ul>';
								$ul = false;
							} // END if($ul)

							$version = trim($line, " =");
							echo '<p style="margin: 5px 0;">' . htmlspecialchars($line) . '</p>';
						} // END if(preg_match('~^\s*\*\s*~', $line))
					} // END if(version_compare($version, TWOCLICK_SOCIALMEDIA_BUTTONS_VERSION,">"))
				} // END foreach($changelog as $index => $line)

				if($ul) {
					echo '</ul><div style="clear: left;"></div>';
				} // END if($ul)


				echo '</div>';
			} // END if(preg_match($regexp, $data, $matches))
		} else {
			/**
			 * Returning if we can't use file_get_contents or cURL
			 */
			return;
		} // END if($data)
	} // END function twoclick_buttons_update_notice()
} // END if(!function_exists('twoclick_buttons_update_notice'))

/**
 * Variablen registrieren.
 *
 * @since 0.4
 */
if(!function_exists('twoclick_buttons_init')) {
	function twoclick_buttons_init() {
		if(function_exists('register_setting')) {
			register_setting('twoclick_buttons-options', 'twoclick_buttons_settings');
		}

		/**
		 * Sprachdatei wählen
		 */
		if(function_exists('load_plugin_textdomain')) {
			load_plugin_textdomain('twoclick-socialmedia', false, dirname(plugin_basename( __FILE__ )) . '/l10n/');
		}
	}
}

/**
 * Optionen updaten ...
 *
 * @param array $array_Data
 * @since 0.4
 */
if(!function_exists('twoclick_buttons_update_options')) {
	function twoclick_buttons_update_options($array_Data) {
		$array_Options = array_merge((array) get_option('twoclick_buttons_settings'), $array_Data);

		update_option('twoclick_buttons_settings', $array_Options);
		wp_cache_set('twoclick_buttons_settings', $array_Options);

		return;
	}
}

/**
 * Link zur Adminseite in der Pluginübersicht hinzufügen.
 * @since 1.2.0
 */
function twoclick_buttons_settings_link($links, $file) {
 	if($file == '2-click-socialmedia-buttons/2-click-socialmedia-buttons.php' && function_exists('admin_url')) {
		$settings_link = '<a href="' . admin_url('options-general.php?page=twoclick-buttons-options') . '">' . __('Settings', 'twoclick-socialmedia') . '</a>';
		array_unshift( $links, $settings_link); // before the other links
	}

	return $links;
}

/**
 * Actions abfeuern.
 *
 * @since 0.1
 */
if(!is_admin()) {
	/**
	 * jQuery anfordern und bei Bedarf einbinden.
	 *
	 * @since 0.4
	 */
	function jquery_init() {
		wp_enqueue_script('jquery');
	}

	// Aktionen
	add_action('wp_head', 'twoclick_buttons_head');
	add_action('wp_footer', 'twoclick_buttons_footer');
	add_action('init', 'jquery_init');
}
/* Nur wenn User auch der Admin ist, sind die Adminoptionen zu sehen */
if(is_admin()) {
	add_action('admin_menu', 'twoclick_buttons_options');
	add_action('admin_init', 'twoclick_buttons_init');

	// Updatemeldung
	if(ini_get('allow_url_fopen') || function_exists('curl_init')) {
		add_action('in_plugin_update_message-' . plugin_basename(__FILE__), 'twoclick_buttons_update_notice');
	}
}

/**
 * Filter zum Blog hinzufügen.
 *
 * @since 0.1
 */
add_filter('the_content', 'twoclick_buttons');
add_filter('plugin_action_links', 'twoclick_buttons_settings_link', 9, 2);
?>