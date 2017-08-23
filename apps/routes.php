<?php

$app->register('home')
    ->setTitle('Home')
    ->setDescription('Default Home Description')
    ->setTheme('default')
    ->addRoute('/category/test/:first/:second/', 'test/index', [
        'first' => 'first argument',
        'second' => 'second argument'
    ])
    ->addRoute('/', 'index')->setAsDefault()
    ->addRoute('/test/', 'test');