<?php

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