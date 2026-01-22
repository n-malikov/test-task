<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test-task
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<div class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</div><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :

				the_title();

			endwhile;

			the_posts_navigation();

		else :

            // content none

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
