<?php

/**
 * Class test
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class test extends model
{
    function index($username, $param2) {
        echo blade()->run('home', [
            'username' => $username
        ]);
    }
}