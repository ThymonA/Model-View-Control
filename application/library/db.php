<?php

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