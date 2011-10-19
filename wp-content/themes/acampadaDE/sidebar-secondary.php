<?php
/**
 * The right, additional Sidebar containing the secondary widget areas.
 */
?>

<div id="sidebar-secondary">

<?php
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>

			<ul class="sidebar">
				<li class="search-input">
					<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
						<input class="search" type="text" value="" name="s" id="s" />
						<input type="submit" id="searchsubmit" value="Suchen" />
					</form>
				</li>
				<li>
					<?php if (is_user_logged_in() ) { //only logged in user can see this ?>
						<div class="clear">&nbsp;</div>
					<?php } else { ?>
						<div class="element">
							<h2>Du kannst dich gerne beteiligen.</h2>
							<p>Weitere Informationen, wie du dich beteiligen kannst, findest du hier:<br /><a href="http://acampadabln.tk/wie-kann-ich-mitmachen/">Wie kann ich mitmachen?</a></p>
							<a class="button" href="/regeln">Jetzt Registrieren</a>
						</div>
					<?php } ?>
				</li>
				<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
			</ul>

<?php endif; ?>

</div>
<!--end Sidebar Secondary-->