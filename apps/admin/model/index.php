<?php

class admin extends model
{
    public function main() {
        if(isset($_SESSION['username'], $_SESSION['hash'], $_SESSION['session_token'])) {

        } else {
            header('Location: ' . getCurrentHost() . 'admin/signin/');
        }
    }

    public function signin() {
        return 'signin page';
    }
}