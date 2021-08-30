<?php 

namespace Ernio\Bankas;

class User {
    public $id, $name, $surname, $personalId, $balance, $acc;
    

    function __construct()
    {
        $this->id = rand(1000000000, 9999999999);
    }
    public static function getaccNum()
    {
        $acc = "LT01" . rand(0, 99) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999) . rand(1000, 9999);
        return $acc;
    }
}