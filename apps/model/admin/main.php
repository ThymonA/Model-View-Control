<?php

/**
 * Class admin
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class admin extends model
{
    public function main() {
        if(isset($_SESSION['username'], $_SESSION['hash'], $_SESSION['session_token'])) {

        } else {
            header('Location: ' . getCurrentHost() . 'admin/signin/');
        }
    }

    public function signin() {

    }
}