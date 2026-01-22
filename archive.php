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

	<main id="primary" class="site-main container">

        <?php if ( have_posts() ) : ?>

            <div class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </div><!-- .page-header -->

            <div>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>">
                        <h2>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php the_post_thumbnail( 'medium' ); ?>
                        <?php the_excerpt(); ?>
                    </article>
                    <hr>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p>Записи не найдены.</p>
        <?php endif; ?>

	</main><!-- #main -->

<?php
get_footer();
