<?php

$app->register('home')
    ->setTitle('Home')
    ->setDescription('Default Home Description')
    ->addRoute('/category/test/:username/:second/', 'test/index', [
        'username' => 'test',
        'second' => 'second argument'
    ])
    ->addRoute('/', 'index')->setAsDefault()
    ->addRoute('/test/', 'test');

$app->register('admin')
    ->setTitle('Admin Dashboard')
    ->setDescription('Admin dashboard for managing webshop: ' . getCurrentHost())
    ->addRoute('/admin/', 'main')
    ->addRoute('/admin/signin/', 'signin');

