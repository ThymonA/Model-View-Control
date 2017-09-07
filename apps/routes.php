<?php

/**
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

$app->register('home')
    ->setTitle('Home')
    ->setDescription('Default Home Description')
    ->addRoute('/user/:username/', 'test/index', [
        'username' => 'test'
    ])
    ->addRoute('/', 'index')->setAsDefault()
    ->addRoute('/test/', 'test');

$app->register('admin')
    ->setTitle('Admin Dashboard')
    ->setDescription('Admin dashboard for managing webshop: ' . getCurrentHost())
    ->addRoute('/admin/', 'main')
    ->addRoute('/admin/signin/', 'signin');

