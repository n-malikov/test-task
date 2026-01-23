<?php
$specialties = get_the_terms( get_the_ID(), 'doctor_specialization' );

if ( $specialties && ! is_wp_error( $specialties ) ) {
    echo '<p>Специализация: ';
    echo esc_html( implode( ', ', wp_list_pluck( $specialties, 'name' ) ) );
    echo '</p>';
}
?>




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
    echo '<p>Город: ';
    echo esc_html( implode( ', ', wp_list_pluck( $cities, 'name' ) ) );
    echo '</p>';
}
?>