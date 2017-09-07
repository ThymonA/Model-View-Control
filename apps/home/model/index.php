<?php

class home extends model
{
    public function index() {
        echo blade()->run('home');
    }

    public function test($username = 'none') {
        echo blade()->run('home');
    }
}