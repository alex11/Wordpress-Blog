		</div> <!-- #container -->

		<?php do_action( 'bp_after_container' ) ?>
		<?php do_action( 'bp_before_footer' ) ?>

		<div id="footer">
			<div id="footer-image"><img src="/wp-content/uploads/2011/10/footer-image-asamblea.png" alt="asamblea group"/></div>
			<?php if ( is_active_sidebar( 'first-footer-widget-area' ) || is_active_sidebar( 'second-footer-widget-area' ) || is_active_sidebar( 'third-footer-widget-area' ) || is_active_sidebar( 'fourth-footer-widget-area' ) ) : ?>
				<div id="footer-widgets">
					<?php get_sidebar( 'footer' ) ?>
				</div>
			<?php endif; ?>

			<?php do_action( 'bp_footer' ) ?>
		</div><!-- #footer -->

		<?php do_action( 'bp_after_footer' ) ?>

		<?php wp_footer(); ?>
	</div>

	<script type="text/javascript">
		var pkBaseURL = (("https:" == document.location.protocol) ? "https://www.alex11.org/stats/" : "https://www.alex11.org/stats/");
		document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
	<script type="text/javascript">
		try {
			var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
			piwikTracker.trackPageView();
			piwikTracker.enableLinkTracking();
			} catch( err ) {}
	</script><noscript><p><img src="https://www.alex11.org/stats/piwik.php?idsite=1" style="border:0" alt="" /></p></noscript>
	</body>

</html>