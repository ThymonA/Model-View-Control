<?php

class model {

    private $database;
    private $pdo;
    private $statement;

    function __construct() {
        $this->pdo = new PDO(config::db_type . ':host=' . config::db_server . ';dbname=' . config::db_database . ';charset' . config::db_charset, config::db_username, config::db_password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    }

    protected function prepare($query) {
        if(is_string($query)) {
            $this->statement = $this->pdo->prepare($query);
            $this->database = new database($this->statement);
            return $this->database;
        } else {
            die('Query isn\'t a string');
        }
    }
}