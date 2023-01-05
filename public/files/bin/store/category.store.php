<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$data = [];

for($i = 0; $i < 12; $i++){

    $data[] = [
        'category_title' => $faker->sentence(1),
        'category_text' => $faker->sentence(10),
        'category_created' => '2022-12-10 03:05:31',
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'category_title' => $value['category_title'],
        'category_text' => $value['category_text'],
        'category_created' => $value['category_created'],
    ];
}

dd(db()->store('category', [
    'category_title',
    'category_text',
    'category_created',
] , $store));

dd(byte(memory()));
