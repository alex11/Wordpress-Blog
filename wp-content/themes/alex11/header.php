<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="https://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
	<head profile="https://gmpg.org/xfn/11">
		<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ) ?>; charset=<?php bloginfo( 'charset' ) ?>" />
		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>
		<link rel="icon" href="/wp-content/uploads/2011/10/favicon.ico" type="image/x-icon">
		<link rel="image_src" href="https://www.alex11.org/wp-content/uploads/2011/11/Facebook_Share_Image.png" />

		<?php do_action( 'bp_head' ) ?>

		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ) ?>" />

		<?php
			if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			wp_head();
		?>
	</head>

	<body <?php body_class() ?> id="bp-default">
		<?php do_action( 'bp_before_header' ) ?>

		<div id="header">
			<div id="header-content">
				<h1 id="logo" role="banner"><a href="<?php echo home_url(); ?>" title="<?php _ex( 'Home', 'Home page banner link title', 'buddypress' ); ?>"><span style="display:none;"><?php bp_site_name(); ?></span></a></h1>

				<div id="search-bar" role="search">
					<form action="<?php echo bp_search_form_action() ?>" method="post" id="search-form">
						<label for="search-terms" class="accessibly-hidden"><?php _e( 'Search for:', 'buddypress' ); ?></label>
						<input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />
						<?php echo bp_search_form_type_select() ?>
						<input type="submit" name="search-submit" id="search-submit" value="<?php _e( 'Search', 'buddypress' ) ?>" />
						<?php wp_nonce_field( 'bp_search_form' ) ?>
					</form>
					
					<a href="http://twitter.com/#!/search/%23occupyberlin%20OR%20%23alex11%20OR%20%23edj%20OR%20%23occupygermany%20OR%20%40acampadabln" class="community twitter">&nbsp;</a>
					<a href="https://www.facebook.com/aCAMPadaBLN" class="community fb">&nbsp;</a>
					<a href="https://www.alex11.org/feed/" class="community rss">&nbsp;</a>
					
					<?php do_action( 'bp_search_login_bar' ) ?>
				</div>
				<div class="clearer">&nbsp;</div>
				<div id="navigation" role="navigation">
					<?php wp_nav_menu( array( 'container' => false, 'menu_id' => 'nav', 'theme_location' => 'primary', 'fallback_cb' => 'bp_dtheme_main_nav' ) ); ?>
				</div>
			</div>
			<div class="clearer">&nbsp;</div>

			<?php do_action( 'bp_header' ) ?>
			<div class="bottom-shadow">&nbsp;</div>
		</div><!-- #header -->

		<?php do_action( 'bp_after_header' ) ?>
		<div id="wrapper">

		<?php do_action( 'bp_before_container' ) ?>
		<div id="info-area">
		<?php if (is_user_logged_in() ) { //only logged in user can see this ?>
			
		<?php } else { ?>
			
			<p>Willkommen auf alex11. Ein offenes BlogCamp, ein Camp im Internet. Mache und diskutiere Vorschläge und Initiativen. <a href="/info">Hier erfährst du mehr</a></p>
			<p class="linkbar">Es ist dein/unser Blog, also hau rein und <a href="/sei-dabei">registriere dich</a> oder melde dich an &darr; </p>
		<?php } ?>
		</div>
		<div id="container">
