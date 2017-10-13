<?php

/**
 * Class model
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class model {

    private $table;
    private $pdo;

    function __construct() {
        $this->pdo = new PDO(config::db_type . ':host=' . config::db_server . ';dbname=' . config::db_database . ';charset' . config::db_charset, config::db_username, config::db_password, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING]);
    }

    public function table($table) {
        $stmt = $this->pdo->prepare('SHOW TABLES LIKE :tableName');
        $stmt->bindValue(':tableName', strtolower($table), PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount() > 0) {
            $this->table = strtolower($table);
            return new database($this);
        } else {
            breakMessage('model->table()', 'table ( ' . strtolower($table) . ' ) doesn\'t exist in ( ' . config::db_server . ' )\\' . config::db_database);
        }
    }

    public function get($variable = '') {
        return $this->{@$variable} ?? null;
    }
}