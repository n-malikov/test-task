<?php

require_once __DIR__ . '/wp-load.php';

if (!current_user_can('manage_options')) {
    die('Доступ запрещён');
}

$specializations = [
    ['name' => 'Терапевт',     'slug' => 'therapist'],
    ['name' => 'Хирург',       'slug' => 'surgeon'],
    ['name' => 'Психиатр',     'slug' => 'psychiatrist'],
    ['name' => 'Стоматолог',   'slug' => 'dentist'],
];

$cities = [
    ['name' => 'Москва',       'slug' => 'moscow'],
    ['name' => 'Новосибирск',  'slug' => 'novosibirsk'],
    ['name' => 'Екатеринбург', 'slug' => 'yekaterinburg'],
];

$doctors = [
    [
        'title' => 'Иванов Алексей Сергеевич',
        'slug' => 'ivanov-aleksey',
        'specs' => ['therapist'],
        'city' => 'moscow',
        'exp' => 12,
        'price' => 2200,
        'rating' => 4
    ],
    [
        'title' => 'Смирнова Ольга Викторовна',
        'slug' => 'smirnova-olga',
        'specs' => ['psychiatrist'],
        'city' => 'novosibirsk',
        'exp' => 9,
        'price' => 3400,
        'rating' => 5
    ],
    ['title' => 'Кузнецов Дмитрий Павлович',     'slug' => 'kuznetsov-dmitry',    'specs' => ['surgeon','therapist'],  'city' => 'moscow',       'exp' => 18, 'price' => 4500, 'rating' => 5],
    ['title' => 'Петрова Анна Игоревна',         'slug' => 'petrova-anna',        'specs' => ['dentist'],              'city' => 'yekaterinburg','exp' => 7,  'price' => 2800, 'rating' => 4],
    ['title' => 'Соколов Владимир Николаевич',   'slug' => 'sokolov-vladimir',    'specs' => ['therapist','dentist'],  'city' => 'novosibirsk',  'exp' => 15, 'price' => 2600, 'rating' => 4],
    ['title' => 'Морозова Екатерина Дмитриевна', 'slug' => 'morozova-ekaterina',  'specs' => ['psychiatrist'],         'city' => 'moscow',       'exp' => 11, 'price' => 3800, 'rating' => 5],
    ['title' => 'Лебедев Сергей Александрович',  'slug' => 'lebedev-sergey',      'specs' => ['surgeon'],              'city' => 'yekaterinburg','exp' => 14, 'price' => 4200, 'rating' => 4],
    ['title' => 'Новикова Мария Павловна',       'slug' => 'novikova-maria',      'specs' => ['therapist'],            'city' => 'novosibirsk',  'exp' => 6,  'price' => 2100, 'rating' => 3],
    ['title' => 'Федоров Игорь Михайлович',      'slug' => 'fedorov-igor',        'specs' => ['dentist','surgeon'],    'city' => 'moscow',       'exp' => 13, 'price' => 3900, 'rating' => 5],
    ['title' => 'Васильева Татьяна Юрьевна',     'slug' => 'vasileva-tatyana',    'specs' => ['psychiatrist','therapist'],'city' => 'yekaterinburg','exp' => 10,'price' => 3200, 'rating' => 4],
    ['title' => 'Зайцев Роман Олегович',         'slug' => 'zaytsev-roman',       'specs' => ['surgeon'],              'city' => 'moscow',       'exp' => 19, 'price' => 4800, 'rating' => 5],
    ['title' => 'Козлова Ирина Валерьевна',      'slug' => 'kozlova-irina',       'specs' => ['dentist'],              'city' => 'novosibirsk',  'exp' => 8,  'price' => 2700, 'rating' => 4],
    ['title' => 'Макаров Антон Евгеньевич',      'slug' => 'makarov-anton',       'specs' => ['therapist'],            'city' => 'yekaterinburg','exp' => 12, 'price' => 2300, 'rating' => 4],
    ['title' => 'Егорова Светлана Андреевна',    'slug' => 'egorova-svetlana',    'specs' => ['psychiatrist'],         'city' => 'moscow',       'exp' => 16, 'price' => 4100, 'rating' => 5],
    ['title' => 'Орлов Павел Викторович',        'slug' => 'orlov-pavel',         'specs' => ['surgeon','dentist'],    'city' => 'novosibirsk',  'exp' => 10, 'price' => 3700, 'rating' => 4],
    ['title' => 'Романова Юлия Сергеевна',       'slug' => 'romanova-yulia',      'specs' => ['therapist'],            'city' => 'moscow',       'exp' => 5,  'price' => 2000, 'rating' => 3],
    ['title' => 'Григорьев Максим Юрьевич',      'slug' => 'grigoryev-maxim',     'specs' => ['psychiatrist','surgeon'],'city' => 'yekaterinburg','exp' => 17,'price' => 4600, 'rating' => 5],
    ['title' => 'Волкова Дарья Константиновна',  'slug' => 'volkova-darya',       'specs' => ['dentist'],              'city' => 'novosibirsk',  'exp' => 9,  'price' => 2900, 'rating' => 4],
    ['title' => 'Алексеев Никита Владимирович',  'slug' => 'alekseev-nikita',     'specs' => ['therapist','psychiatrist'],'city' => 'moscow',   'exp' => 11, 'price' => 3100, 'rating' => 4],
    ['title' => 'Беляева София Артёмовна',       'slug' => 'belyaeva-sofia',      'specs' => ['surgeon'],              'city' => 'yekaterinburg','exp' => 13, 'price' => 4000, 'rating' => 5],
];


$tax_spec = 'doctor_specialization';
$tax_city = 'doctor_city';

// специализации
foreach ($specializations as $item) {
    if (!term_exists($item['name'], $tax_spec)) {
        wp_insert_term($item['name'], $tax_spec, ['slug' => $item['slug']]);
    }
}

// города
foreach ($cities as $item) {
    if (!term_exists($item['name'], $tax_city)) {
        wp_insert_term($item['name'], $tax_city, ['slug' => $item['slug']]);
    }
}

// term_id по slug
$term_cache_spec = [];
foreach ($specializations as $item) {
    $term = get_term_by('slug', $item['slug'], $tax_spec);
    if ($term && !is_wp_error($term)) {
        $term_cache_spec[$item['slug']] = (int)$term->term_id;
    }
}

$term_cache_city = [];
foreach ($cities as $item) {
    $term = get_term_by('slug', $item['slug'], $tax_city);
    if ($term && !is_wp_error($term)) {
        $term_cache_city[$item['slug']] = (int)$term->term_id;
    }
}

// врачи
foreach ($doctors as $doc) {
    $existing = get_page_by_path($doc['slug'], OBJECT, 'doctors');
    if ($existing) {
        continue;
    }

    $post_id = wp_insert_post([
        'post_title'   => $doc['title'],
        'post_name'    => $doc['slug'],
        'post_type'    => 'doctors',
        'post_status'  => 'publish',
        'post_content' => 'Врач с опытом работы ' . $doc['exp'] . ' лет.',
    ], true);

    if (is_wp_error($post_id)) {
        continue;
    }

    // специализации
    if (!empty($doc['specs'])) {
        $term_ids = [];
        foreach ((array)$doc['specs'] as $slug) {
            if (isset($term_cache_spec[$slug])) {
                $term_ids[] = $term_cache_spec[$slug];
            }
        }
        if ($term_ids) {
            wp_set_object_terms($post_id, $term_ids, $tax_spec, false);
        }
    }

    // город
    if (!empty($doc['city']) && isset($term_cache_city[$doc['city']])) {
        wp_set_object_terms($post_id, [$term_cache_city[$doc['city']]], $tax_city, false);
    }

    // ACF
    if (function_exists('update_field')) {
        if (isset($doc['exp']))    update_field('field_doctor_experience', (int)$doc['exp'],    $post_id);
        if (isset($doc['price']))  update_field('field_doctor_price',     (int)$doc['price'],   $post_id);
        if (isset($doc['rating'])) update_field('field_doctor_rating',    (int)$doc['rating'],  $post_id);
    }
}

die('Скрипт выполнен: добавлены специализации, города и 20 врачей');