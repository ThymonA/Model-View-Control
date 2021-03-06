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
        echo blade()->run('default.header');
        echo blade()->run('home.main');
        echo blade()->run('default.footer');
    }

    public function test($username = 'none') {
        echo blade()->run('default.header');
        echo blade()->run('home.main');
        echo blade()->run('default.footer');
    }
}