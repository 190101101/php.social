<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$theme = ['help', 'payment', 'other'];

$data = [];

for($i = 0; $i < 100; $i++){

    $data[] = [
        'contact_theme' => $theme[rand(0, 2)],
        'contact_email' => $faker->email,
        'contact_message' => $faker->sentence(rand(2, 5)),
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'contact_theme' => $value['contact_theme'],
        'contact_email' => $value['contact_email'],
        'contact_message' => $value['contact_message'],
    ];
}

dd(db()->store('contact', [
    'contact_theme',
    'contact_email',
    'contact_message',
] , $store));

dd(byte(memory()));



