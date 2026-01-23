<?php

add_action( 'init', 'register_doctor_specialization_taxonomy' );

function register_doctor_specialization_taxonomy() {

    $labels = [
        'name'              => 'Специализации',
        'singular_name'     => 'Специализация',
        'search_items'      => 'Найти специализацию',
        'all_items'         => 'Все специализации',
        'parent_item'       => 'Родительская специализация',
        'parent_item_colon' => 'Родительская специализация:',
        'edit_item'         => 'Редактировать специализацию',
        'update_item'       => 'Обновить специализацию',
        'add_new_item'      => 'Добавить специализацию',
        'new_item_name'     => 'Название новой специализации',
        'menu_name'         => 'Специализации',
    ];

    register_taxonomy( 'doctor_specialization', [ 'doctors' ], [
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => true,
        'show_admin_column' => true,
        'rewrite'           => [
            'slug'       => 'specialization',
            'with_front' => false,
        ],
        'show_in_rest'      => true,
    ] );
}
