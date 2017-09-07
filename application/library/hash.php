<?php

/**
 * Class hash
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class hash
{
    public function test($input, $times) {
        $return = '';
        for($i = 0; $i < strlen($input); $i++) {
            $return .= chr(ord($input[$i]) + $times);
        }
        return $return;
    }
}