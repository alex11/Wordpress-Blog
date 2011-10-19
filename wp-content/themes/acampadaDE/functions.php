<?php

/* Make theme available for translation */
/* Translations can be filed in the /languages/ directory */
load_theme_textdomain( 'ari', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

/* Set the content width based on the theme's design and stylesheet. */
if ( ! isset( $content_width ) )
	$content_width = 495;

/* Tell WordPress to run ari_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'ari_setup' );

if ( ! function_exists( 'ari_setup' ) ):

function ari_setup() {

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style();
	
	/* This theme uses post thumbnails */
	add_theme_support( 'post-thumbnails' );

	/* Add default posts and comments RSS feed links to head */
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location. */
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'ari'),
		'secondary' => __( 'Secondary Navigation', 'ari'),
	) );

}
endif;

/* Calls jQuery and SmoothScroll im Footer  */
function ari_smoothscroll_init() {
    if ( !is_admin() ) {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/js/smoothscroll.js', array( 'jquery'), '1.0', true ); 
    }
}
// works also for WP < version 3.0
global $wp_version;
if ( version_compare($wp_version, "3.0alpha", "<") ) {
    add_action( 'init', 'ari_smoothscroll_init' );
} else {
    add_action( 'after_setup_theme', 'ari_smoothscroll_init' );
}

/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link. */
function ari_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'ari_page_menu_args' );


/* Sets the post excerpt length to 40 characters. */
function ari_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'ari_excerpt_length' );


/* Returns a "Continue Reading" link for excerpts */
function ari_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ari' ) . '</a>';
}

/* Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and ari_continue_reading_link(). */
function ari_auto_excerpt_more( $more ) {
	return ' &hellip;' . ari_continue_reading_link();
}
add_filter( 'excerpt_more', 'ari_auto_excerpt_more' );

/* Adds a pretty "Continue Reading" link to custom post excerpts. */
function ari_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ari_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'ari_custom_excerpt_more' );


if ( ! function_exists( 'ari_comment' ) ) :

/*  Search form custom styling */
function ari_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="'.get_bloginfo('url').'" >
    <input type="text" class="search-input" value="' . get_search_query() . '" name="s" id="s" />
    <input type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'ari') .'" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'ari_search_form' );

/* Template for comments and pingbacks. */
function ari_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-gravatar"><?php echo get_avatar( $comment, 50 ); ?></div>
		
		<div class="comment-body">
		<div class="comment-meta commentmetadata"><?php printf( __( '%s <span class="says">says</span>', 'ari' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?> <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'ari' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( 'Edit &rarr;', 'ari' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<?php comment_text(); ?>
		
		<?php if ( $comment->comment_approved == '0' ) : ?>
		<p class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'ari' ); ?></p>
		<?php endif; ?>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		
		</div>
		<!--comment Body-->
		
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ari' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'ari'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/* Register widgetized areas, including two sidebars and four widget-ready columns in the footer. */
function ari_widgets_init() {
	// Primary Widget area (left, fixed sidebar)
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'ari' ),
		'id' => 'primary-widget-area',
		'description' => __( 'Here you can put one or two of your main widgets (like an intro text, your page navigation or some social site links) in your left sidebar. The sidebar is fixed, so the widgets content will always be visible, even when scrolling down the page.', 'ari' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Secondary Widget area (right, additional sidebar)
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'ari' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'Here you can put all the additional widgets for your right sidebar.', 'ari' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
/* Register sidebars by running ari_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'ari_widgets_init' );

/* Removes the default styles that are packaged with the Recent Comments widget. */
function ari_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'ari_remove_recent_comments_style' );

if ( ! function_exists( 'ari_posted_on' ) ) :
/* Prints HTML with meta information for the current post—date/time and author. */
function ari_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'ari' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'ari' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

/* Custom Ari Social Links Widget */
class Ari_SocialLinks_Widget extends WP_Widget {
	function Ari_SocialLinks_Widget() {
		$widget_ops = array(
			'classname' => 'widget_social_links',
			'description' => 'A list with your social profile links' );
		$this->WP_Widget('social_links', 'Ari Social Links', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		
		$rss_title = empty($instance['rss_title']) ? ' ' : apply_filters('widget_rss_title', $instance['rss_title']);	
		$rss_url = empty($instance['rss_url']) ? ' ' : apply_filters('widget_rss_url', $instance['rss_url']);
		$twitter_title = empty($instance['twitter_title']) ? ' ' : apply_filters('widget_twitter_title', $instance['twitter_title']);	
		$twitter_url = empty($instance['twitter_url']) ? ' ' : apply_filters('widget_twitter_url', $instance['twitter_url']);	
		$fb_title = empty($instance['fb_title']) ? ' ' : apply_filters('widget_fb_title', $instance['fb_title']);
		$fb_url = empty($instance['fb_url']) ? ' ' : apply_filters('widget_fb_url', $instance['fb_url']);
		$googleplus_title = empty($instance['googleplus_title']) ? ' ' : apply_filters('widget_googleplus_title', $instance['googleplus_title']);
		$googleplus_url = empty($instance['googleplus_url']) ? ' ' : apply_filters('widget_googleplus_url', $instance['googleplus_url']);
		$flickr_title = empty($instance['flickr_title']) ? ' ' : apply_filters('widget_flickr_title', $instance['flickr_title']);
		$flickr_url = empty($instance['flickr_url']) ? ' ' : apply_filters('widget_flickr_url', $instance['flickr_url']);
		$vimeo_title = empty($instance['vimeo_title']) ? ' ' : apply_filters('widget_vimeo_title', $instance['vimeo_title']);
		$vimeo_url = empty($instance['vimeo_url']) ? ' ' : apply_filters('widget_vimeo_url', $instance['vimeo_url']);
		$xing_title = empty($instance['xing_title']) ? ' ' : apply_filters('widget_xing_title', $instance['xing_title']);
		$xing_url = empty($instance['xing_url']) ? ' ' : apply_filters('widget_xing_url', $instance['xing_url']);
		$linkedin_title = empty($instance['linkedin_title']) ? ' ' : apply_filters('widget_linkedin_title', $instance['linkedin_title']);
		$linkedin_url = empty($instance['linkedin_url']) ? ' ' : apply_filters('widget_linkedin_url', $instance['linkedin_url']);
		$delicious_title = empty($instance['delicious_title']) ? ' ' : apply_filters('widget_delicious_title', $instance['delicious_title']);
		$delicious_url = empty($instance['delicious_url']) ? ' ' : apply_filters('widget_delicious_url', $instance['delicious_url']);
		
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; };
		echo '<ul>';
	if($rss_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $rss_url .'" class="rss" target="_blank">'. $rss_title .'</a></li>'; }
		if($twitter_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $twitter_url .'" class="twitter" target="_blank">'. $twitter_title .'</a></li>'; }
		if($fb_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $fb_url .'" class="facebook" target="_blank">'. $fb_title .'</a></li>'; }
		if($googleplus_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $googleplus_url .'" class="googleplus" target="_blank">'. $googleplus_title .'</a></li>'; }
		if($flickr_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $flickr_url .'" class="flickr" target="_blank">'. $flickr_title .'</a></li>'; }
		if($vimeo_title == ' ') { echo ''; } else {  echo  '  <li class="widget_sociallinks"><a href=" '. $vimeo_url .'" class="vimeo" target="_blank">'. $vimeo_title .'</a></li>'; }
		if($xing_title == ' ') { echo ''; } else {  echo  '  <li class="widget_sociallinks"><a href=" '. $xing_url .'" class="xing" target="_blank">'. $xing_title .'</a></li>'; }
		if($linkedin_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $linkedin_url .'" class="linkedin" target="_blank">'. $linkedin_title .'</a></li>'; }
		if($delicious_title == ' ') { echo ''; } else {  echo  '<li class="widget_sociallinks"><a href=" '. $delicious_url .'" class="delicious" target="_blank">'. $delicious_title .'</a></li>'; }
		echo '</ul>';
		echo $after_widget;
		
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		$instance['rss_title'] = strip_tags($new_instance['rss_title']);
		$instance['rss_url'] = strip_tags($new_instance['rss_url']);
		$instance['twitter_title'] = strip_tags($new_instance['twitter_title']);
		$instance['twitter_url'] = strip_tags($new_instance['twitter_url']);
		$instance['fb_title'] = strip_tags($new_instance['fb_title']);
		$instance['fb_url'] = strip_tags($new_instance['fb_url']);
		$instance['googleplus_title'] = strip_tags($new_instance['googleplus_title']);
		$instance['googleplus_url'] = strip_tags($new_instance['googleplus_url']);
		$instance['flickr_title'] = strip_tags($new_instance['flickr_title']);
		$instance['flickr_url'] = strip_tags($new_instance['flickr_url']);
		$instance['vimeo_title'] = strip_tags($new_instance['vimeo_title']);
		$instance['vimeo_url'] = strip_tags($new_instance['vimeo_url']);		
		$instance['xing_title'] = strip_tags($new_instance['xing_title']);
		$instance['xing_url'] = strip_tags($new_instance['xing_url']);
		$instance['linkedin_title'] = strip_tags($new_instance['linkedin_title']);
		$instance['linkedin_url'] = strip_tags($new_instance['linkedin_url']);
		$instance['delicious_title'] = strip_tags($new_instance['delicious_title']);
		$instance['delicious_url'] = strip_tags($new_instance['delicious_url']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args(
		(array) $instance, array( 
			'title' => '',
			'rss_title' => '',
			'rss_url' => '',
			'twitter_title' => '',
			'twitter_url' => '',
			'fb_title' => '',
			'fb_url' => '',
			'googleplus_title' => '',
			'googleplus_url' => '',
			'flickr_title' => '',
			'flickr_url' => '',
			'vimeo_title' => '',
			'vimeo_url' => '',
			'xing_title' => '',
			'xing_url' => '',
			'linkedin_title' => '',
			'linkedin_url' => '',
			'delicious_title' => '',
			'delicious_url' => ''
		) );
		$title = strip_tags($instance['title']);	
		$rss_title = strip_tags($instance['rss_title']);
		$rss_url = strip_tags($instance['rss_url']);
		$twitter_title = strip_tags($instance['twitter_title']);
		$twitter_url = strip_tags($instance['twitter_url']);
		$fb_title = strip_tags($instance['fb_title']);
		$fb_url = strip_tags($instance['fb_url']);
		$googleplus_title = strip_tags($instance['googleplus_title']);
		$googleplus_url = strip_tags($instance['googleplus_url']);
		$flickr_title = strip_tags($instance['flickr_title']);
		$flickr_url = strip_tags($instance['flickr_url']);
		$vimeo_title = strip_tags($instance['vimeo_title']);
		$vimeo_url = strip_tags($instance['vimeo_url']);
		$xing_title = strip_tags($instance['xing_title']);
		$xing_url = strip_tags($instance['xing_url']);
		$linkedin_title = strip_tags($instance['linkedin_title']);
		$linkedin_url = strip_tags($instance['linkedin_url']);
		$delicious_title = strip_tags($instance['delicious_title']);
		$delicious_url = strip_tags($instance['delicious_url']);
?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('rss_title'); ?>"><?php _e( 'RSS Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('rss_title'); ?>" name="<?php echo $this->get_field_name('rss_title'); ?>" type="text" value="<?php echo esc_attr($rss_title); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('rss_url'); ?>"><?php _e( 'RSS  URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('rss_url'); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" type="text" value="<?php echo esc_attr($rss_url); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('twitter_title'); ?>"><?php _e( 'Twitter Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_title'); ?>" name="<?php echo $this->get_field_name('twitter_title'); ?>" type="text" value="<?php echo esc_attr($twitter_title); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('twitter_url'); ?>"><?php _e( 'Twitter  URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" type="text" value="<?php echo esc_attr($twitter_url); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('fb_title'); ?>"><?php _e( 'Facebook Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('fb_title'); ?>" name="<?php echo $this->get_field_name('fb_title'); ?>" type="text" value="<?php echo esc_attr($fb_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('fb_url'); ?>"><?php _e( 'Facebook URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('fb_url'); ?>" name="<?php echo $this->get_field_name('fb_url'); ?>" type="text" value="<?php echo esc_attr($fb_url); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('googleplus_title'); ?>"><?php _e( 'Google+ Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('googleplus_title'); ?>" name="<?php echo $this->get_field_name('googleplus_title'); ?>" type="text" value="<?php echo esc_attr($googleplus_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('googleplus_url'); ?>"><?php _e( 'Google+ URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('googleplus_url'); ?>" name="<?php echo $this->get_field_name('googleplus_url'); ?>" type="text" value="<?php echo esc_attr($googleplus_url); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('flickr_title'); ?>"><?php _e( 'Flickr Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_title'); ?>" name="<?php echo $this->get_field_name('flickr_title'); ?>" type="text" value="<?php echo esc_attr($flickr_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('flickr_url'); ?>"><?php _e( 'Flickr URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('flickr_url'); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" type="text" value="<?php echo esc_attr($flickr_url); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('vimeo_title'); ?>"><?php _e( 'Vimeo Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('vimeo_title'); ?>" name="<?php echo $this->get_field_name('vimeo_title'); ?>" type="text" value="<?php echo esc_attr($vimeo_title); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('vimeo_url'); ?>"><?php _e( 'Vimeo URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('vimeo_url'); ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" type="text" value="<?php echo esc_attr($vimeo_url); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('xing_title'); ?>"><?php _e( 'Xing Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('xing_title'); ?>" name="<?php echo $this->get_field_name('xing_title'); ?>" type="text" value="<?php echo esc_attr($xing_title); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('xing_url'); ?>"><?php _e( 'Xing URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('xing_url'); ?>" name="<?php echo $this->get_field_name('xing_url'); ?>" type="text" value="<?php echo esc_attr($xing_url); ?>" /></label></p>		
			<p><label for="<?php echo $this->get_field_id('linkedin_title'); ?>"><?php _e( 'LinkedIn Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkedin_title'); ?>" name="<?php echo $this->get_field_name('linkedin_title'); ?>" type="text" value="<?php echo esc_attr($linkedin_title); ?>" /></label></p>		
			<p><label for="<?php echo $this->get_field_id('linkedin_url'); ?>"><?php _e( 'LinkedIn URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkedin_url'); ?>" name="<?php echo $this->get_field_name('linkedin_url'); ?>" type="text" value="<?php echo esc_attr($linkedin_url); ?>" /></label></p>	
			<p><label for="<?php echo $this->get_field_id('delicious_title'); ?>"><?php _e( 'Delicious Text:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('delicious_title'); ?>" name="<?php echo $this->get_field_name('delicious_title'); ?>" type="text" value="<?php echo esc_attr($delicious_title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('delicious_url'); ?>"><?php _e( 'Delicious URL:', 'ari' ); ?> <input class="widefat" id="<?php echo $this->get_field_id('delicious_url'); ?>" name="<?php echo $this->get_field_name('delicious_url'); ?>" type="text" value="<?php echo esc_attr($delicious_url); ?>" /></label></p>

<?php
	}
}

// register Ari SocialLinks Widget
add_action('widgets_init', create_function('', 'return register_widget("Ari_SocialLinks_Widget");'));

/* Ari Theme-Options Page */
function themeoptions_admin_menu()
{
	// here's where we add the theme options page link to the dashboard sidebar
	add_theme_page("Theme Options", __('Theme Options', 'ari'), 'edit_themes', basename(__FILE__), 'themeoptions_page');
}

function themeoptions_page() {
	if ( isset( $_POST['update_themeoptions'] ) ) { themeoptions_update(); }  //check options update
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br /></div>
		<h2><?php _e('Theme Options', 'ari'); ?></h2>

		<form method="POST" action="">
			<input type="hidden" name="update_themeoptions" value="true" />
			<!--
			<table class="form-table" style="margin-bottom: 50px;">
			<h3><?php _e('Switch to the dark theme version', 'ari'); ?></h3>
			<tr valign="top">
				<th scope="row"><label for="dark-style"><?php _e('Ari dark theme version', 'ari'); ?></label></th>
				<td><input type="checkbox" name="dark-style" id="dark-style" <?php echo get_option('ari_dark-style'); ?> /><?php _e(' check the box, if you want to use the dark theme version', 'ari'); ?></h4></td>
			</tr>
 			</table>
			-->
			<table class="form-table" style="margin-bottom: 50px;">
			<h3><?php _e('Change the Theme Colors', 'ari'); ?></h3>
			<p class="description"><?php _e('(You can find out the HEX value of any color with the <a href="http://chir.ag/projects/name-that-color/" target="_blank">Name that Color</a> online-tool)', 'ari'); ?></p>
			<tr valign="top">
				<th scope="row"><label for="background-color"><?php _e('Background Color', 'ari'); ?></label></th>
				<td><input type="text" name="background-color" id="background-color" size="32" value="<?php echo get_option('ari_background-color'); ?>"/> <span class="description"><?php _e(' e.g. #FFFFFF or white (default color: white)', 'ari'); ?></span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="header-color"><?php _e('Header Color', 'ari'); ?></label></th>
				<td><input type="text" name="header-color" id="header-color" size="32" value="<?php echo get_option('ari_header-color'); ?>"/> <span class="description"><?php _e(' e.g. #D93D1A or red (default color: red)', 'ari'); ?></span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="elements-color"><?php _e('Elements', 'ari'); ?></label></th>
				<td><input type="text" name="elements-color" id="elements-color" size="32" value="<?php echo get_option('ari_elements-color'); ?>"/> <span class="description"><?php _e(' e.g. #F2CA52 or Orange (default color: orange)', 'ari'); ?></span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="elements-font-color"><?php _e('Elements Font Color (Hover)', 'ari'); ?></label></th>
				<td><input type="text" name="elements-font-color" id="elements-font-color" size="32" value="<?php echo get_option('ari_elements-font-color'); ?>"/> <span class="description"><?php _e(' e.g. #4C4C4C or black (default color: black)', 'ari'); ?></span></td>
			</tr>
  			<tr valign="top">
				<th scope="row"><label for="link-color"><?php _e('Link Color', 'ari'); ?></label></th>
				<td><input type="text" name="link-color" id="link-color" size="32" value="<?php echo get_option('ari_link-color'); ?>"/> <span class="description"><?php _e(' e.g. #5A7302 or green (default link color: green)', 'ari'); ?></span></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="link-color-hover"><?php _e('Link Color Hover', 'ari'); ?></label></th>
				<td><input type="text" name="link-color-hover" id="link-color-hover" size="32" value="<?php echo get_option('ari_link-color-hover'); ?>"/> <span class="description"><?php _e(' e.g. #D93D1A or red (default link color hover: red)', 'ari'); ?></span></td>
			</tr>			
			<tr valign="top">
				<th scope="row"><label for="text-color"><?php _e('Text Color', 'ari'); ?></label></th>
				<td><input type="text" name="text-color" id="text-color" size="32" value="<?php echo get_option('ari_text-color'); ?>"/> <span class="description"><?php _e(' e.g. #4C4C4C (default text color: black)', 'ari'); ?></span></td>
			</tr>
 			</table>
			
			<table class="form-table" style="margin-bottom: 10px;">
			<h3><?php _e('Use a Logo', 'ari'); ?></h3>
			<tr valign="top">
				<th scope="row"><label for="logo"><?php _e('Logo URL', 'ari'); ?></label></th>
				<td><input type="text" name="logo" id="logo" value="<?php echo get_option('ari_logo'); ?>"/><br/><span
                            class="description"> <a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('Upload your logo', 'ari'); ?></a> <?php _e(' using the WordPress Media Library and insert the URL here<br/>(the maximum logo size is: 180 x 31 Pixel)', 'ari'); ?> </span><br/><br/><img src="<?php echo (get_option('logo')) ? get_option('logo') : get_template_directory_uri() . '/images/logo.png' ?>"
                     alt=""/></td>
			</tr>
			</table>
			
			<table class="form-table" style="margin-bottom: 10px;">
			<h3><?php _e('Use an image', 'ari'); ?></h3>
			<tr valign="top">
				<th scope="row"><label for="image"><?php _e('Image URL', 'ari'); ?></label></th>
				<td><input type="text" name="image" id="image" value="<?php echo get_option('ari_image'); ?>"/><br/><span
                            class="description"> <a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('Upload your image', 'ari'); ?></a> <?php _e(' using the WordPress Media Library and insert the URL here<br/>(the maximum image size is: 180 x 250 Pixel)', 'ari'); ?> </span><br/><br/><img src="<?php echo (get_option('image')) ? get_option('image') : get_template_directory_uri() . '/images/image-draft.png' ?>"
                     alt=""/></td>
			</tr>
			</table>
			
			<table class="form-table" style="margin-bottom: 10px;">
			<h3><?php _e('Use a footer image', 'ari'); ?></h3>
			<tr valign="top">
				<th scope="row"><label for="footer-image"><?php _e('footer-image URL', 'ari'); ?></label></th>
				<td><input type="text" name="footer-image" id="footer-image" value="<?php echo get_option('ari_footer-image'); ?>"/><br/><span
                            class="description"> <a href="<?php echo home_url(); ?>/wp-admin/media-new.php" target="_blank"><?php _e('Upload your footer-image', 'ari'); ?></a> <?php _e(' using the WordPress Media Library and insert the URL here<br/>(the maximum footer-image size is: 980 x 205 Pixel)', 'ari'); ?> </span><br/><br/><img src="<?php echo (get_option('footer-image')) ? get_option('footer-image') : get_template_directory_uri() . '/images/footer-image-draft.png' ?>"
                     alt=""/></td>
			</tr>
			</table>
			
			<p><input type="submit" name="search" value="<?php _e('Update Options', 'ari'); ?>" class="button button-primary" /></p>
		</form>

	</div>
	<?php
}

add_action('admin_menu', 'themeoptions_admin_menu');

// Update options
function themeoptions_update(){

	if (isset($_POST['dark-style'])=='on') { $display = 'checked'; } else { $display = ''; }
	update_option('ari_dark-style', $display);
	update_option('ari_background-color', 	$_POST['background-color']);
	update_option('ari_header-color', 	$_POST['header-color']);
	update_option('ari_elements-color', 	$_POST['elements-color']);
	update_option('ari_elements-font-color', 	$_POST['elements-font-color']);
	update_option('ari_link-color', 	$_POST['link-color']);
	update_option('ari_link-color-hover', 	$_POST['link-color-hover']);
	update_option('ari_text-color', 	$_POST['text-color']);
	update_option('ari_logo', 	$_POST['logo']);
	update_option('ari_image', 	$_POST['image']);
	update_option('ari_footer-image', 	$_POST['footer-image']);
	
}


// Custom CSS-Styles for Background, Text-Color and Link Colors
function insert_custom_css(){
?>
<style type="text/css">
<?php if (get_option('ari_background-color') ) { ?>body, .menu li a:link, .menu li a:visited, a:link.login, a:visited.login { background-color: <?php echo get_option('ari_background-color'); ?>; }
	a.button:link, a.button:visited, .tec-calendar-buttons a, p.meta span.category a:link, p.meta span.category a:visited, p.meta span.category a:hover, p.meta span.category a:focus, p.meta span.category a:active, ul#menu-footer li a:link, ul#menu-footer li a:visited { color: <?php echo get_option('ari_background-color'); ?>; }
<?php } ?>
<?php if (get_option('ari_header-color') ) { ?>#header-color { background-color: <?php echo get_option('ari_header-color'); ?>; } <?php } ?>
<?php if (get_option('ari_elements-color') ) { ?>.element, #access .menu li.current_page_item a:link, #access .menu li.current_page_item a:visited, #access .menu li.current-menu-item a:link, #access .menu li.current-menu-item a:visited, #access .menu li a:hover, #access .menu li a:focus, #access .menu li a:active, #access a:hover.login, #access a:focus.login, #access a:active.login, a.tec-button-off, div.wpcf7-validation-errors, span.wpcf7-not-valid-tip { background-color: <?php echo get_option('ari_elements-color'); ?>; } <?php } ?>
<?php if (get_option('ari_elements-font-color') ) { ?>.element, #access .menu li.current_page_item a:link, #access .menu li.current_page_item a:visited, #access .menu li a:hover, #access .menu li a:focus, #access .menu li a:active, #access a:hover.login, #access a:focus.login, #access a:active.login { color: <?php echo get_option('ari_elements-font-color'); ?>; } <?php } ?>
<?php if (get_option('ari_text-color') ) { ?>body, #content h2 a:link, #content h2 a:visited, #access .menu li a:link, #access .menu li a:visited, #access a:link.login, #access a:visited.login { color: <?php echo get_option('ari_text-color'); ?>; } <?php } ?>
<?php if (get_option('ari_link-color') ) { ?>a:link, a:visited { color:<?php echo get_option('ari_link-color'); ?>; }
	a.button:link, a.button:visited, #searchsubmit:hover, form#commentform p.form-submit input#submit:hover, input.wpcf7-submit:hover, a.tec-button-on, #tec-content a:link.ical, #tec-content a:visited.ical, .tec-calendar td.tec-present .daynum, .tec-tooltip .tec-event-title, p.meta span.category a:link, p.meta span.category a:visited { background:<?php echo get_option('ari_link-color'); ?>; }
<?php } ?>
<?php if (get_option('ari_link-color-hover') ) { ?>a:hover, a:focus, a:active, ul#menu-footer li a:hover, ul#menu-footer li a:focus, ul#menu-footer li a:active { color:<?php echo get_option('ari_link-color-hover'); ?>; }
	a.button:hover, a.button:focus, a.button:active, .tec-calendar-buttons a:hover, .tec-calendar-buttons a:focus, .tec-calendar-buttons a:active, #tec-content a:hover.ical, #tec-content a:focus.ical, #tec-content a:active.ical, p.meta span.category a:hover, p.meta span.category a:focus, p.meta span.category a:active { background-color:<?php echo get_option('ari_link-color-hover'); ?> !important; }
<?php } ?>
</style>
<?php
}

add_action('wp_head', 'insert_custom_css');

/* Remove the default CSS style from the WP image gallery */
add_filter('gallery_style', create_function('$a', 'return "
<div class=\'gallery\'>";'));