<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$data = [];

for($i = 0; $i < 250; $i++){

    $data[] = [
        'comment_text' => $faker->sentence(200),
        'comment_created' => '2022-12-10 03:05:31',
        'comment_updated' => '2022-12-10 03:05:31',
        'user_id' => rand(1, 100),
        'article_id' => rand(1, 100),
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'comment_text' => $value['comment_text'],
        'comment_created' => $value['comment_created'],
        'comment_updated' => $value['comment_updated'],
        'user_id' => $value['user_id'],
        'article_id' => $value['article_id'],
    ];
}

dd(db()->store('comment', [
    'comment_text',
    'comment_created',
    'comment_updated',
    'user_id',
    'article_id',
] , $store));

dd(byte(memory()));


