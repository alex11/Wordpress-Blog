<form name="<?php echo $this->getPlugin()->getSlug(); ?>_settings_form" id="<?php echo $this->getPlugin()->getSlug(); ?>_settings_form" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php settings_fields($this->getPlugin()->getSlug()); ?>

<table id="blog-table">
	<thead>
	<tr>
		<th class="blog-blog">Blog</th>
		<th class="blog-host">SSL Host</th>
		<th class="blog-ssl_admin">Force SSL Admin</th>
		<th class="blog-exclusive_https">Force SSL Exclusively</th>
		<th class="blog-remove_unsecure">Remove Unsecure Elements</th>
		<th class="blog-debug">Debug Mode</th>
		<th class="blog-proxy">Proxy</th>
		<th class="blog-admin_menu">Admin Menu Location</th>
	</tr>
	</thead>
	<tbody>
<?php
	global $wpdb;
	$blogs = $wpdb->get_col($wpdb->prepare("SELECT blog_id FROM " . $wpdb->blogs));
	foreach($blogs as $blog_id) {
		$ssl_host = ($this->getPlugin()->getSetting('ssl_host', $blog_id) != '' ?  $this->getPlugin()->getSetting('ssl_host', $blog_id) : get_site_url($blog_id, '', 'https'));
		$ssl_host = preg_replace('/http[s]?:\/\//', '', $ssl_host);
		$ssl_host = rtrim(str_replace(parse_url(get_site_url($blog_id, ''), PHP_URL_PATH), '', $ssl_host), '/');
?>
	<tr>
		<td class="blog-blog"><strong><?php echo preg_replace('/http[s]?:\/\//', '', get_site_url($blog_id)); ?></strong></td>
		<td class="blog-host"><input name="blog[<?php echo $blog_id; ?>][ssl_host]" type="text" class="regular-text code" value="<?php echo $ssl_host; ?>" /></td>
		<td class="blog-ssl_admin"><input type="hidden" name="blog[<?php echo $blog_id; ?>][ssl_admin]" value="0" /><input name="blog[<?php echo $blog_id; ?>][ssl_admin]" type="checkbox" value="1"<?php echo ((force_ssl_admin()) ? ' disabled="disabled" title="FORCE_SSL_ADMIN is true in wp-config.php"' : (($this->getPlugin()->getSetting('ssl_admin', $blog_id)) ? ' checked="checked"' : '') ); ?> /></td>
		<td class="blog-exclusive_https"><input type="hidden" name="blog[<?php echo $blog_id; ?>][exclusive_https]" value="0" /><input name="blog[<?php echo $blog_id; ?>][exclusive_https]" type="checkbox" value="1"<?php echo (($this->getPlugin()->getSetting('exclusive_https', $blog_id)) ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-remove_unsecure"><input type="hidden" name="blog[<?php echo $blog_id; ?>][remove_unsecure]" value="0" /><input name="blog[<?php echo $blog_id; ?>][remove_unsecure]" type="checkbox" value="1"<?php echo (($this->getPlugin()->getSetting('remove_unsecure', $blog_id)) ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-debug"><input type="hidden" name="blog[<?php echo $blog_id; ?>][debug]" value="0" /><input name="blog[<?php echo $blog_id; ?>][debug]" type="checkbox" value="1"<?php echo (($this->getPlugin()->getSetting('debug', $blog_id)) ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-proxy">
			<select name="blog[<?php echo $blog_id; ?>][ssl_proxy]">
				<option value="0"<?php echo ((! $this->getPlugin()->getSetting('ssl_proxy', $blog_id)) ? ' selected="selected"' : ''); ?>>No</option>
				<option value="auto"<?php echo (($this->getPlugin()->getSetting('ssl_proxy', $blog_id) === 'auto') ? ' selected="selected"' : ''); ?>>Auto</option>
				<option value="1"<?php echo (($this->getPlugin()->getSetting('ssl_proxy', $blog_id) == 1) ? ' selected="selected"' : ''); ?>>Yes</option>
			</select>
		</td>
		<td class="blog-admin_menu">
			<select name="blog[<?php echo $blog_id; ?>][admin_menu]">
				<option value="side"<?php echo (($this->getPlugin()->getSetting('admin_menu', $blog_id) === 'side') ? ' selected="selected"' : ''); ?>>Sidebar</option>
				<option value="settings"<?php echo (($this->getPlugin()->getSetting('admin_menu', $blog_id) === 'settings') ? ' selected="selected"' : ''); ?>>Settings</option>
			</select>
		</td>
	</tr>
<?php
	}

	$defaults = $this->getPlugin()->getSetting('network_defaults');
	if ( sizeof($defaults) == 0 ) {
		foreach( $this->getPlugin()->getSettings() as $setting => $default ) {
			$defaults[$setting] = $default;
		}
	}
?>

	<tr>
		<td class="blog-blog"><strong>New Site Defaults</strong></td>
		<td class="blog-host"><input name="blog_default[ssl_host]" type="text" class="regular-text code" value="<?php echo $defaults['ssl_host']; ?>" /></td>
		<td class="blog-ssl_admin"><input type="hidden" name="blog_default[ssl_admin]" value="0" /><input name="blog_default[ssl_admin]" type="checkbox" value="1"<?php echo ($defaults['ssl_admin'] ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-exclusive_https"><input type="hidden" name="blog_default[exclusive_https]" value="0" /><input name="blog_default[exclusive_https]" type="checkbox" value="1"<?php echo ($defaults['exclusive_https'] ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-remove_unsecure"><input type="hidden" name="blog_default[remove_unsecure]" value="0" /><input name="blog_default[remove_unsecure]" type="checkbox" value="1"<?php echo ($defaults['remove_unsecure'] ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-debug"><input type="hidden" name="blog_default[debug]" value="0" /><input name="blog_default[debug]" type="checkbox" value="1"<?php echo ($defaults['debug'] ? ' checked="checked"' : ''); ?> /></td>
		<td class="blog-proxy">
			<select name="blog_default[ssl_proxy]">
				<option value="0"<?php echo (! $defaults['ssl_proxy'] ? ' selected="selected"' : ''); ?>>No</option>
				<option value="auto"<?php echo ($defaults['ssl_proxy'] === 'auto' ? ' selected="selected"' : ''); ?>>Auto</option>
				<option value="1"<?php echo ($defaults['ssl_proxy'] === 1 ? ' selected="selected"' : ''); ?>>Yes</option>
			</select>
		</td>
		<td class="blog-admin_menu">
			<select name="blog_default[admin_menu]">
				<option value="side"<?php echo ($defaults['admin_menu'] === 'side' ? ' selected="selected"' : ''); ?>>Sidebar</option>
				<option value="settings"<?php echo ($defaults['admin_menu'] === 'settings' ? ' selected="selected"' : ''); ?>>Settings</option>
			</select>
		</td>
	</tr>
	</tbody>

</table>

<input type="hidden" name="action" value="wphttps-network" />

<p class="button-controls">
	<input type="submit" name="network-settings-save" value="Save Changes" class="button-primary" id="network-settings-save" />
	<img alt="Waiting..." src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="waiting submit-waiting" />
</p>
</form>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#<?php echo $this->getPlugin()->getSlug(); ?>_settings_form').submit(function() {
		$('#<?php echo $this->getPlugin()->getSlug(); ?>_settings_form .submit-waiting').show();
	}).ajaxForm({
		data: { ajax: '1'},
		success: function(responseText, textStatus, XMLHttpRequest) {
			$('#<?php echo $this->getPlugin()->getSlug(); ?>_settings_form .submit-waiting').hide();
			$('#message-body').html(responseText).fadeOut(0).fadeIn().delay(5000).fadeOut();
		}
	});
});
</script>