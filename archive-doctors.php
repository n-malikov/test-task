<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package test-task
 */

get_header();

// все текущие GET-параметры
$current_get = wp_unslash( $_GET );

// получаем параметры фильтров
$specialization = isset( $current_get['specialization'] ) ? sanitize_text_field( $current_get['specialization'] ) : '';
$city           = isset( $current_get['city'] ) ? sanitize_text_field( $current_get['city'] ) : '';
$sort           = isset( $current_get['sort'] ) ? sanitize_text_field( $current_get['sort'] ) : '';
$paged          = max( 1, get_query_var( 'paged' ) );

// формируем tax_query
$tax_query = [ 'relation' => 'AND' ];

if ( $specialization ) {
    $tax_query[] = [
        'taxonomy' => 'doctor_specialization',
        'field'    => 'slug',
        'terms'    => $specialization,
    ];
}

if ( $city ) {
    $tax_query[] = [
        'taxonomy' => 'doctor_city',
        'field'    => 'slug',
        'terms'    => $city,
    ];
}

// сортировка
$meta_key = '';
$order    = 'DESC';

switch ( $sort ) {
    case 'rating':
        $meta_key = 'doctor_rating';
        $order    = 'DESC';
        break;

    case 'price':
        $meta_key = 'doctor_price';
        $order    = 'ASC';
        break;

    case 'experience':
        $meta_key = 'doctor_experience';
        $order    = 'DESC';
        break;
}

// основной запрос
$args = [
    'post_type'      => 'doctors',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'tax_query'      => count( $tax_query ) > 1 ? $tax_query : '',
];

if ( $meta_key ) {
    $args['meta_key'] = $meta_key;
    $args['orderby']  = 'meta_value_num';
    $args['order']    = $order;
}

$query = new WP_Query( $args );

// данные для фильтров
$specialties = get_terms( [
    'taxonomy'   => 'doctor_specialization',
    'hide_empty' => true,
] );

$cities = get_terms( [
    'taxonomy'   => 'doctor_city',
    'hide_empty' => true,
] );

$form_get = $current_get;
unset( $form_get['paged'], $form_get['page'] );
?>

    <main id="primary" class="site-main container">

        <h1><?php post_type_archive_title(); ?></h1>

        <form method="get" class="doctors-filters">

            <?php
            // сохраняем все сторонние GET-параметры
            foreach ( $form_get as $key => $value ) {
                if ( in_array( $key, [ 'specialization', 'city', 'sort' ], true ) ) {
                    continue;
                }

                if ( is_array( $value ) ) {
                    foreach ( $value as $v ) {
                        echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $v ) . '">';
                    }
                } else {
                    echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $value ) . '">';
                }
            }
            ?>

            <select name="specialization">
                <option value="">Все специализации</option>
                <?php foreach ( $specialties as $term ) : ?>
                    <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $specialization, $term->slug ); ?>>
                        <?php echo esc_html( $term->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="city">
                <option value="">Все города</option>
                <?php foreach ( $cities as $term ) : ?>
                    <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $city, $term->slug ); ?>>
                        <?php echo esc_html( $term->name ); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <select name="sort">
                <option value="">Без сортировки</option>
                <option value="rating" <?php selected( $sort, 'rating' ); ?>>По рейтингу</option>
                <option value="price" <?php selected( $sort, 'price' ); ?>>По цене</option>
                <option value="experience" <?php selected( $sort, 'experience' ); ?>>По стажу</option>
            </select>

            <button type="submit">Применить</button>

        </form>

        <?php if ( $query->have_posts() ) : ?>

            <div>
                <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                    <div class="doctor-card">

                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('thumbnail'); ?>
                        <?php endif; ?>

                        <h2><?php the_title(); ?></h2>

                        <?php the_excerpt(); ?>

                        <?php get_template_part( 'template-parts/doctor-card' ); ?>

                        <a href="<?php the_permalink(); ?>">Подробнее</a>

                        <hr>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php
            $pagination_args = $current_get;
            $pagination_args['paged'] = '%#%';

            echo paginate_links( [
                'total'   => $query->max_num_pages,
                'current' => $paged,
                'format'  => '?paged=%#%',
                'add_args'=> array_diff_key( $current_get, array_flip( [ 'paged', 'page' ] ) ),
            ] );
            ?>

        <?php else : ?>
            <p>Врачи не найдены.</p>
        <?php endif; ?>

    </main><!-- #main -->

<?php
wp_reset_postdata();
get_footer();
