<?php

namespace Ernio\Bankas;

use App\DB\DataBase;

class Json implements DataBase {

    private static $accObj;
    private $data;

    public static function get()
    {
        return self::$accObj ?? self::$accObj = new self;
    }
    
    private function __construct()
    {
        if (!file_exists(DIR . 'data/vartotojai.json')) {
            file_put_contents(DIR . 'data/vartotojai.json', json_encode([]));
        }
        $this->data = json_decode(file_get_contents(DIR . 'data/vartotojai.json'), 1);
    }

    public function __destruct()
    {
        file_put_contents(DIR . 'data/vartotojai.json', json_encode($this->data));
    }

    function create(array $userData) : void
    {
        $this->data[] = $userData;
    }
 
    function update(int $userId, array $userData) : void
    {
        foreach ($this->data as $key => $saskaita){
            if($saskaita['id'] == $userId){
                $this->data[$key] = $userData;
            }
        }
    }
 
    function delete(int $userId) : void
    {
        foreach ($this->data as $key => $saskaita){
            if($saskaita['id'] == $userId){
               unset($this->data[$key]);
            }
        }
    }
 
    function show(int $userId) : array
    {
        foreach ($this->data as $saskaita){
            if($saskaita['id'] == $userId){
                return $saskaita;
            }
        }
        return [];
    }
    
    function showAll() : array
    {
        return $this->data;
    }
}
