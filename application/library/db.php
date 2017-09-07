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

    public function __construct($table) {
        $this->table = $table;
        return $this;
    }
}