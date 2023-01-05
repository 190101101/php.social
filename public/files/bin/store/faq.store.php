<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$data = [];

for($i = 0; $i < 100; $i++){

    $data[] = [
        'faq_text' => $faker->sentence(rand(10, 20)),
        'faq_subtext' => $faker->sentence(rand(20, 50)),
        'faq_created' => '2022-12-10 03:05:31',
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'faq_text' => $value['faq_text'],
        'faq_subtext' => $value['faq_subtext'],
        'faq_created' => $value['faq_created'],
    ];
}

dd(db()->store('faq', [
    'faq_text',
    'faq_subtext',
    'faq_created',
] , $store));

dd(byte(memory()));


