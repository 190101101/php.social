<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$data = [];

for($i = 0; $i < 4; $i++){

    $data[] = [
        'section_title' => $faker->sentence(1),
        'section_text' => $faker->sentence(200),
        'section_created' => '2022-12-10 03:05:31',
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'section_title' => $value['section_title'],
        'section_text' => $value['section_text'],
        'section_created' => $value['section_created'],
    ];
}

dd(db()->store('section', [
    'section_title',
    'section_text',
    'section_created',
] , $store));

dd(byte(memory()));


