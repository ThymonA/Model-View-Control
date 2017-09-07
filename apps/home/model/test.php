<?php

class test extends model
{
    function index($username, $param2) {
        echo blade()->run('home', [
            'username' => $username
        ]);
    }
}