<?php

/**
 * Class DB
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class DB
{
    private $table;

    const INT = 'int';
    const VARCHAR = 'varchar';
    const TEXT = 'text';
    const DATE = 'date';

    /** @var $statement PDOStatement */
    private $statement;

    public function __construct(PDOStatement $statement) {
        $this->statement = $statement;
    }

    public function single() {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function multiple() {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }
}