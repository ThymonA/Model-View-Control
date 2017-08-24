<?php

class home extends model
{
    public function index() {
        $application = new application();
        return 'test';
    }

    public function test($param = 'none') {
        return 'je zit nu op de test met param = ' . $param;
    }
}