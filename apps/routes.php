<?php

$app->register('home')
    ->setTitle('Home')
    ->setDescription('Default Home Description')
    ->setTheme('default')
    ->addRoute('/home/:first/:second/', 'test/index', [
        'first' => 'first argument',
        'second' => 'second argument'
    ]);