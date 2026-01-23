<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', 'register_doctors_acf_fields' );

function register_doctors_acf_fields() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( [
        'key'    => 'group_doctor_fields',
        'title'  => 'Данные врача',
        'fields' => [

            // Стаж врача
            [
                'key'          => 'field_doctor_experience',
                'label'        => 'Стаж врача (лет)',
                'name'         => 'doctor_experience',
                'type'         => 'number',
                'required'     => 1,
                'min'          => 0,
                'step'         => 1,
            ],

            // Цена
            [
                'key'      => 'field_doctor_price',
                'label'    => 'Цена приёма',
                'name'     => 'doctor_price',
                'type'     => 'number',
                'min'      => 0,
                'step'     => 1,
                'prepend'  => 'руб',
            ],

            // Рейтинг (0–5)
            [
                'key'           => 'field_doctor_rating',
                'label'         => 'Рейтинг',
                'name'          => 'doctor_rating',
                'type'          => 'select',
                'choices'       => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'default_value' => '0',
                'return_format' => 'value',
                'ui'            => 1,
            ],

        ],
        'location' => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'doctors',
                ],
            ],
        ],
    ] );

}
