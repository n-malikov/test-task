<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', 'register_doctors_post_type' );

function register_doctors_post_type() {

    $labels = array(
        'name'               => 'Врачи',
        'singular_name'      => 'Врач',
        'menu_name'          => 'Врачи',
        'add_new'            => 'Добавить врача',
        'add_new_item'       => 'Добавить нового врача',
        'edit_item'          => 'Редактировать врача',
        'new_item'           => 'Новый врач',
        'view_item'          => 'Просмотр врача',
        'search_items'       => 'Найти врача',
        'not_found'          => 'Врачи не найдены',
    );

    register_post_type( 'doctors', [
        'labels'        => $labels,
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => [ 'slug' => 'doctors' ],
        'menu_icon'     => 'dashicons-id',
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
        'show_in_rest'  => true,
    ] );
}
