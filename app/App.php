<?php
namespace Ernio\Bankas;

use Ernio\Bankas\Controllers\BankController;
use Ernio\Bankas\Controllers\HomeController;
use Ernio\Bankas\Controllers\LoginController;


class App {

    public static function start()
    {
        self::router();
    }

    public static function router()
    {
        $url = str_replace(INSTALL, '', $_SERVER['REQUEST_URI']);
        $url = explode('/', $url);
        _d($url);

        if ('GET' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && '' === $url[0]) {
            return (new HomeController)->home();     
        }
        if ('GET' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'login' === $url[0]) {
            return (new LoginController)->showLogin();     
        }
        if ('GET' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'create' === $url[0]) {
            return (new BankController)->create();     
        }
        if ('POST' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'create' === $url[0]) {
            return (new BankController)->save();     
        }
        if ('POST' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'logout' === $url[0]) {
            return (new LoginController)->logout();     
        }
        if ('GET' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'accountlist' === $url[0]) {
            return (new BankController)->accountlist();     
        }
        $update = ['add-les','rem-les'];
        if ('POST' == $_SERVER['REQUEST_METHOD'] && 2 == count($url) && in_array($url[0], $update)) {
            return (new BankController)->update($url[0], $url[1]);
        }
        if ('POST' == $_SERVER['REQUEST_METHOD'] && 2 == count($url) && 'delete' === $url[0]) {
            return (new BankController)->delete($url[1]);
        } 
        if ('POST' == $_SERVER['REQUEST_METHOD'] && 1 == count($url) && 'login' === $url[0]) {
            return (new LoginController)->login(); 
        }     

    }  
    
    public static function view($name, $data = [])
    {
        extract($data);
        require DIR . "view/$name.php";
    }

    public static function redirect($url)
    {
        header('Location: '.URL.$url);
        die;
    }
    
    public static function addMessage(string $type, string $msg): void
    {
        $_SESSION['msg'][] = ['type' => $type, 'msg' => $msg];
    }

    public static function clearMessages(): void
    {
        $_SESSION['msg'] = [];
    }

    public static function showMessages(): void
    {
        $messages = $_SESSION['msg'];
        self::clearMessages();
        self::view('msg', ['messages' => $messages]);
    }

    public static function isLogged()
    {
        return isset($_SESSION['login']) && $_SESSION['login'] == 1; 
    }

}