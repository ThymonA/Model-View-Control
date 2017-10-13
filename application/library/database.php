<?php

/**
 * Class database
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class database
{
    /** @var $pdo PDO */
    private $pdo;
    private $database;
    /** @var $statement PDOStatement */
    private $statement;
    private $table;
    private $query;

    public function __construct(model $model) {
        if($model->get('pdo') instanceof PDO) {
            $this->pdo = $model->get('pdo');
        } else {
            breakMessage('database->__construct()', 'can\'t get PDO connection from model');
        }
        $this->table = $model->get('table');
    }

    public function get($columns = [], $where = []) {
        $query = 'select ';

        // search for specific columns
        if(is_array($columns) && count($columns) > 0) {
            for ($i = 0; $i < count($columns); $i++) {
                if(($i + 1) == count($columns)) {
                    $query .= $columns[$i] . ' ';
                } else {
                    $query .= $columns[$i] . ', ';
                }
            }
        } else if(is_array($columns)) {
            $query .= '* ';
        } else if(is_string($columns)) {
            $query .= $columns . ' ';
        } else {
            breakMessage('database->get()', 'variable $columns must be a array or single string');
        }

        $query .= 'from ' . $this->table;

        // search for specific value
        $whereParams = [];
        if(is_array($where) && count($where) > 0) {
            $query .= ' where ';
            foreach ($where as $key => $value) {
                array_push($whereParams, ['key' => strtolower(':' . $key), 'value' => $value]);
                if(count($whereParams) == count($where)) {
                    $query .= $key . ' = :' . strtolower($key);
                } else {
                    $query .= $key . ' = :' . strtolower($key) . ' AND ';
                }
            }
            $this->statement = $this->pdo->prepare($query);
            foreach($whereParams as $_where) {
                $this->bind($_where['key'], $_where['value']);
            }
            $this->statement->execute();
            return new DB($this->statement);
        } else if(is_array($where)) {
            $this->statement = $this->pdo->prepare($query);
            $this->statement->execute();
            return new DB($this->statement);
        } else {
            return [];
        }
    }

    public function delete($where = []) {
        if(is_array($where)) {
            $query = 'delete from `' . $this->table . '` where ';
            $bindBundle = [];
            $count = count($where);
            foreach ($where as $key => $value) {
                if(is_string($key) && is_string($value)) {
                    if($count == 1) {
                        $query .= '`' . $key .= '` = ' . strtolower(':' . $key);
                    } else {
                        $query .= '`' . $key .= '` = ' . strtolower(':' . $key) . ' and ';
                    }
                    $bindBundle[strtolower(':' . $key)] = $value;
                } else if(is_string($key) && is_array($value)) {
                    $query .= '(';
                    for($i = 0; $i < count($value); $i++) {
                        if(($i + 1) == count($value)) {
                            $query .= '`' . $key . '` = ' . strtolower(':' . $key . ($i + 1));
                        } else {
                            $query .= '`' . $key . '` = ' . strtolower(':' . $key . ($i + 1)) . ' OR ';
                        }
                        $bindBundle[strtolower(':' . $key . ($i + 1))] = $value[$i];
                    }
                    if($count == 1) {
                        $query .= ')';
                    } else {
                        $query .= ') AND ';
                    }
                } else {
                    return false;
                    break;
                }
                $count--;
            }
            try {
                $this->statement = $this->pdo->prepare($query);
                foreach ($bindBundle as $key => $value) {
                    $this->bind($key, $value);
                }
                return $this->statement->execute();
            } catch (PDOException $exception) {
                return false;
            }
        } else {
            return false;
        }
    }

    private function bind($param, $value, $type = null){
        if (is_null($type)) {
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
        }
        $this->statement->bindValue($param, $value, $type);
    }
}