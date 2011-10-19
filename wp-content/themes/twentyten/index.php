<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<span>
						<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</<?php echo $heading_tag; ?>>
				<p>Wir errichten ein Camp auf dem Alexanderplatz in Berlin. Ein Camp für ECHTE DEMOKRATIE. Helft uns, unser gemeinsames Camp zu errichten.</p>
				<p>Es dient als Treffpunkt für offene Diskussionen, zum Planen von Projekten oder zum Vorstellen von Projekten.</p>
				<p style="text-align:right;"><a href="/info/">...weiterlesen</a></p>
				<div class="greenbox">
					<p style="float:left; width:70%">Du kannst dich jederzeit beteiligen. <a href="/wie-kann-ich-mitmachen/">weitere Infos</a></p>
					<a style="float:right;" class="button" href="http://acampadabln.tk/wp-login.php?action=register">Hier anmelden!</a>
					<p class="clearer">&nbsp;</p>
				</div>

			<?php
			/* Run the loop to output the posts.
			 * If you want to overload this in a child theme then include a file
			 * called loop-index.php and that will be used instead.
			 */
			 get_template_part( 'loop', 'index' );
			?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
