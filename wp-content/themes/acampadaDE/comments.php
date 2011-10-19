<?php if ( post_password_required() ) : ?>
				<p><?php _e( 'This post is password protected. Enter the password to view any comments.', 'ari' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<div id="comments-content" class="clearfix">

<?php if ( have_comments() ) : ?>

			<h3 id="comments"><?php
			printf( _n( 'One Comment', 'Comments (%1$s)', get_comments_number(), 'ari' ),
			number_format_i18n( get_comments_number() ), '' . get_the_title() . '' );
			?></h3>

			<ol>
				<?php wp_list_comments( array( 'callback' => 'ari_comment' ) ); ?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
				<p class="alignleft"><?php previous_comments_link( __( '&larr; Older Comments', 'ari') ); ?></p>
				<p class="alignright"><?php next_comments_link( __( 'Newer Comments &rarr;', 'ari') ); ?></p>
<?php endif; // check for comment navigation ?>
			
<?php endif; // end have_comments() ?>
			<?php if (is_user_logged_in() ) { //only logged in user can see this ?>
				<p class="loginout" style="float:right; margin-top:11px; padding:0;"><a class="button mini" href="/wp-admin/post-new.php?post_type=post">+ Neuer Artikel</a></p>
			<?php } else { ?>
				<p class="loginout"><a class="button mini" href="/regeln">Registrieren</a> <a class="button mini" href="<?php echo wp_login_url(get_permalink()); ?>">Login</a></p>
			<?php } ?>

<?php comment_form(
array(
	'title_reply' => __( 'Leave a Reply', 'ari' ),
	'comment_notes_before' =>__( '<p class="comment-notes">Required fields are marked <span class="required">*</span></p>', 'ari'),
	'comment_notes_after' => '',
	'comment_field'  => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'ari' ) . '</label><br/><textarea id="comment" name="comment" rows="8" 	aria-required="true"></textarea></p>',
)
); ?>

</div>
<!--end Comments Content-->