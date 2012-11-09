<?php
/*
 * Template Name: Homepage
 *
 * A custom homepage template
 *
 * @package BuddyPress
 * @subpackage BP_Default
 * @since BuddyPress (1.5)
 */

get_header(); ?>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_blog_page' ); ?>

		<div class="page" id="blog-page" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<h2 class="pagetitle"><?php the_title(); ?></h2>
				<?php if (is_user_logged_in() ) { //only logged in user can see this ?>

				<?php } else { ?>
					<?php /* Widgetized sidebar */
					    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('fullside-only-loggedout-homepage-widget-area') ) : ?>    	
					<?php endif; ?>
				<?php } ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="entry">

						<?php the_content( __( '<p class="serif">Read the rest of this page &rarr;</p>', 'buddypress' ) ); ?>

						<?php wp_link_pages( array( 'before' => '<div class="page-link"><p>' . __( 'Pages: ', 'buddypress' ), 'after' => '</p></div>', 'next_or_number' => 'number' ) ); ?>
						<?php edit_post_link( __( 'Edit this page.', 'buddypress' ), '<p class="edit-link">', '</p>'); ?>

					</div>

				</div>
				<div id="widget-first-full">
					<?php /* Widgetized sidebar */
				    	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('first-fullside-homepage-widget-area') ) : ?>    	
					<?php endif; ?>
				</div>
				<div class="clearer">&nbsp;</div>
				<div id="widget-left">
					<?php /* Widgetized sidebar */
				    	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('left-homepage-widget-area') ) : ?>    	
					<?php endif; ?>
				</div>
				<div id="widget-right">
					<?php /* Widgetized sidebar */
				    	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('right-homepage-widget-area') ) : ?>    	
					<?php endif; ?>
				</div>
				<div class="clearer">&nbsp;</div>
				<div id="widget-second-full">
					<?php /* Widgetized sidebar */
				    	if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('second-fullside-homepage-widget-area') ) : ?>    	
					<?php endif; ?>
				</div>

			<?php comments_template(); ?>

			<?php endwhile; endif; ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_blog_page' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>