<?php 

db()->create('user', [
    'user_email' => 'apsi@mail.ru',
    'user_login' => 'apsi',
    'user_password' => '111',
    'user_gender' => 'male',
    'user_level' => 99,
]);

db()->create('user', [
    'user_email' => 'caiser@mail.ru',
    'user_login' => 'caiser',
    'user_password' => '111',
    'user_gender' => 'male',
    'user_level' => 1,
]);

db()->create('user', [
    'user_email' => 'cookie@mail.ru',
    'user_login' => 'cookie',
    'user_password' => '111',
    'user_gender' => 'male',
    'user_level' => 1,
]);

db()->create('user', [
    'user_email' => 'admin@mail.ru',
    'user_login' => 'admin',
    'user_password' => '111',
    'user_gender' => 'male',
    'user_level' => 1,
]);

$faker = Faker\Factory::create();

$gender = ['male' , 'female'];

$data = [];

for($i = 0; $i < 100; $i++){

    $data[] = [
        'user_email' => $faker->email,
        'user_login' => $faker->userName,
        'user_password' => $faker->userName,
        'user_gender' => $gender[rand(0, 1)],
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'user_email' => $value['user_email'],
        'user_login' => $value['user_login'],
        'user_password' => $value['user_password'],
        'user_gender' => $value['user_gender'],
    ];
}

dd(db()->store('user', [
    'user_email',
    'user_login',
    'user_password',
    'user_gender',
] , $store));
