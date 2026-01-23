<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package test-task
 */

get_header();
?>

    <main class="site-main">
        <article class="container">

            <h1><?php the_title(); ?></h1>

            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail'); ?>
            <?php endif; ?>

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

            <hr>
            <?php get_template_part( 'template-parts/doctor-card' ); ?>

        </article>
    </main><!-- .site-main -->

<?php
get_footer();
