<div id="footer" class="clearfix">
	<div class="footer-image">
		<?php if (get_option('ari_footer-image') ) : ?>
			<a href="<?php echo home_url(); ?>"><img src="<?php echo (get_option('ari_footer-image')) ? get_option('ari_footer-image') : get_template_directory_uri() . '/images/footer-image-draft.png' ?>" alt="<?php bloginfo('name'); ?>" /></a>
		<?php else : ?>
			<img width="980" height="189" src="<?php echo (get_option('ari_footer-image')) ? get_option('ari_footer-image') : get_template_directory_uri() . '/images/footer-image-draft.png' ?>" alt="<?php bloginfo('name'); ?>" />
		<?php endif; ?>
	</div>
	<?php wp_nav_menu( array( 'container_class' => 'menu-footer', 'theme_location' => 'secondary' ) ); ?>
</div>
<!--end Footer-->

</div>
<!--end Wrap-->
<div id="footer-color">&nbsp;</div>

<?php wp_footer(); ?>

<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.alex11.org/stats/" : "http://www.alex11.org/stats/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://www.alex11.org/stats/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
</body>
</html>

