<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
	<title><?php global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ari' ), max( $paged, $page ) );
	?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="all" />
	<?php if (get_option('ari_dark-style') == 'checked') : ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dark.css" type="text/css">
	<?php endif; ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="header-color">&nbsp;</div>
<div id="wrap" class="clearfix">
	<div id="access" role="navigation">
			<a class="logo" href="<?php echo home_url(); ?>"><img width="180" height="31" src="<?php echo (get_option('ari_logo')) ? get_option('ari_logo') : get_template_directory_uri() . '/images/logo.png' ?>" alt="<?php bloginfo('name'); ?>" /></a>
			<?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
			<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
			<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
			<?php if (is_user_logged_in() ) { //only logged in user can see this ?>
				<a class="login" href="/wp-admin/post-new.php?post_type=post">+ Neuer Artikel</a>
			<?php } else { ?>
				<?php if (is_home()) { ?>
					<a class="login" href="/wp-admin" title="Login">Login</a>
			    <?php } else { ?>
			        <a class="login" href="<?php echo wp_login_url(get_permalink()); ?>">Login</a>
			    <?php } ?>
			<?php } ?>
	</div>
	<div class="clear">&nbsp;</div>
	<div id="sidebar-primary">

	<div class="image">
	<?php if (get_option('ari_image') ) : ?>
	<a href="<?php echo home_url(); ?>"><img src="<?php echo (get_option('ari_image')) ? get_option('ari_image') : get_template_directory_uri() . '/images/image-draft.png' ?>" alt="<?php bloginfo('name'); ?>" /></a>

	<?php else : ?>
	<img width="180" height="250" src="<?php echo (get_option('ari_image')) ? get_option('ari_image') : get_template_directory_uri() . '/images/image-draft.png' ?>" alt="<?php bloginfo('name'); ?>" />
	<?php endif; ?>
	</div><!--end Logo-->

	<?php get_sidebar('primary'); ?>

	</div>
	<!--end Sidebar One-->