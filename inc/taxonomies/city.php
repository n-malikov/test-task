<?php

add_action( 'init', 'register_doctor_city_taxonomy' );

function register_doctor_city_taxonomy() {

    $labels = [
        'name'                       => 'Города',
        'singular_name'              => 'Город',
        'search_items'               => 'Найти город',
        'popular_items'              => 'Популярные города',
        'all_items'                  => 'Все города',
        'edit_item'                  => 'Редактировать город',
        'update_item'                => 'Обновить город',
        'add_new_item'               => 'Добавить город',
        'new_item_name'              => 'Название нового города',
        'separate_items_with_commas' => 'Разделяйте города запятыми',
        'add_or_remove_items'        => 'Добавить или удалить город',
        'choose_from_most_used'      => 'Выбрать из популярных',
        'menu_name'                  => 'Города',
    ];

    register_taxonomy( 'doctor_city', [ 'doctors' ], [
        'labels'            => $labels,
        'public'            => true,
        'hierarchical'      => false,
        'show_admin_column' => true,
        'rewrite'           => [
            'slug'       => 'city',
            'with_front' => false,
        ],
        'show_in_rest'      => true,
    ] );

}
