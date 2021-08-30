<?php


$workers = [
    ['id' => 1, 'name' => 'Admin','email' => 'Admin@gmail.com','pass' => md5('123')],
    ['id' => 2, 'name' => 'Antanas','email' => 'Antantas@gmail.com','pass' => md5('123')],
    ['id' => 3, 'name' => 'Rimas','email' => 'Rimas@gmail.com','pass' => md5('123')]
];
$workers = json_encode($workers);
file_put_contents(__DIR__.'/workers.json', $workers);
