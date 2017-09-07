<?php

/**
 * Class home
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class home extends model
{
    public function index() {
        echo blade()->run('home');
    }

    public function test($username = 'none') {
        echo blade()->run('home');
    }
}