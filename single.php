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

            <div class="entry-content">
                <?php the_content(); ?>
            </div><!-- .entry-content -->

        </article>
    </main><!-- .site-main -->

<?php
get_footer();
