<?php 

dd(byte(memory()));

$faker = Faker\Factory::create();

$data = [];

for($i = 0; $i < 100; $i++){

    $data[] = [
        'rule_text' => $faker->sentence(200),
        'rule_created' => '2022-12-10 03:05:31',
    ];
}

$store = [];
foreach($data as $key => $value){
    $store[] = [
        'rule_text' => $value['rule_text'],
        'rule_created' => $value['rule_created'],
    ];
}

dd(db()->store('rule', [
    'rule_text',
    'rule_created',
] , $store));

dd(byte(memory()));


