<?php

class home
{
    public function index() {
        echo 'je zit nu op de index';
    }

    public function test($param = 'none') {
        echo 'je zit nu op de test met param = ' . $param;
    }
}