<?php

namespace Ernio\Bankas\Login;

use App\DB\DataBase;

class Json {

    private static $accObj;
    private $data;

    public static function get()
    {
        return self::$accObj ?? self::$accObj = new self;
    }
    
    private function __construct()
    {
        if (!file_exists(DIR . 'data/workers.json')) {
            file_put_contents(DIR . 'data/workers.json', json_encode([]));
        }
        $this->data = json_decode(file_get_contents(DIR . 'data/workers.json'), 1);
    }

    public function __destruct()
    {
        file_put_contents(DIR . 'data/workers.json', json_encode($this->data));
    }

    function show(string $workerId) : array
    {
        foreach ($this->data as $worker){
            if($worker['email'] == $workerId){
                return $worker;
            }
        }
     return [];
    }
}