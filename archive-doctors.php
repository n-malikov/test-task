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

                    <div class="doctor-card">

                        <h2>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <?php
                        $experience = get_field( 'doctor_experience' );
                        $price      = get_field( 'doctor_price' );
                        $rating     = get_field( 'doctor_rating' );
                        ?>

                        <?php if ( $experience !== null ) : ?>
                            <p>Стаж: <?php echo esc_html( $experience ); ?> лет</p>
                        <?php endif; ?>

                        <?php if ( $price ) : ?>
                            <p>Цена приёма: <?php echo esc_html( $price ); ?> руб</p>
                        <?php endif; ?>

                        <?php if ( $rating !== null ) : ?>
                            <p>Рейтинг: <?php echo esc_html( $rating ); ?> / 5</p>
                        <?php endif; ?>


                        <?php
                        $cities = get_the_terms( get_the_ID(), 'doctor_city' );

                        if ( $cities && ! is_wp_error( $cities ) ) {
                            echo '<p class="doctor-cities">';
                            echo esc_html( implode( ', ', wp_list_pluck( $cities, 'name' ) ) );
                            echo '</p>';
                        }
                        ?>

                        <?php
                        $specialties = get_the_terms( get_the_ID(), 'doctor_specialization' );

                        if ( $specialties && ! is_wp_error( $specialties ) ) :
                            ?>
                            <ul class="doctor-specialties">
                                <?php foreach ( $specialties as $specialization ) : ?>
                                    <li>
                                        <a href="<?php echo esc_url( get_term_link( $specialization ) ); ?>">
                                            <?php echo esc_html( $specialization->name ); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <hr>
                    </div>

                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <p>Записи не найдены.</p>
        <?php endif; ?>

    </main><!-- #main -->

<?php
get_footer();
