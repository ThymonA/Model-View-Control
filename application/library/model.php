<?php

class model {

    private $database;

    function __construct() {
        $this->database = new PDO(config::db_type . ':host=' . config::db_server . ';dbname=' . config::db_database . ';charset' . config::db_charset, config::db_username, config::db_password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    }
}