<?php get_header(); ?>

<div id="main">
	<div id="content">
	<h1 class="archive"><?php printf( __( 'Category Archives for <strong>%s</strong>', 'ari' ), '' . single_cat_title( '', false ) . '' ); ?></h1>

		<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) )
						echo '<div class="archive-meta">' . $category_description . '</div>';

				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
		?>
			
	</div>
	<!--end Content-->

<?php get_sidebar('secondary'); ?>

</div>
<!--end Main-->

<?php get_footer(); ?>