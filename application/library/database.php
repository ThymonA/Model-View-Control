<?php

class database
{
    private $database;
    private $statement;

    public function __construct(PDOStatement $statement) {
        $this->statement = $statement;
    }

    public function bindSingle($param, $value) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($param, $value, $type);
        return $this;
    }

    public function bindArray($array) {
        foreach ($array as $key => $value) {
            if(substr($key, 0, 1) != ':') {
                $key = ':' . $key;
            }
            $this->bindSingle($key, $value);
        }
        return $this;
    }

    public function all() {
        $this->statement->execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function one() {
        $this->statement->execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    public function execute() {
        return $this->statement->execute();
    }
}