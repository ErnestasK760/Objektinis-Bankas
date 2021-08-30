<?php


namespace Ernio\Bankas\Controllers;

use Ernio\Bankas\App;

class LoginController
{
    private $settings = 'Json';
    // private $settings = 'Maria';

    private function get()
    {
        $db = 'Ernio\\Bankas\\Login\\' . $this->settings;
        return $db::get();
    }
    public function showLogin()
    {
        return App::view('login');
    }
    public function login()
    {
        
        $email = $_POST['email'] ?? '';
        $pass = md5($_POST['pass']) ?? '';
        $saskaita = $this->get()->show($email);
        if (empty($saskaita)){
            App::addMessage('danger', 'Kažkas blogai');
            App::redirect('login');
        }
        if ($saskaita['pass'] == $pass) {
            $_SESSION['login'] = 1;
            $_SESSION['name'] = $saskaita['name'];
            App::addMessage('success', 'Sėkmingai prisijungta');
            App::redirect('accountlist');
        }
        App::addMessage('danger','Kažkas blogai');
        App::redirect('login');  
    }

    public function logout()
    {
        if  (isset($_SESSION['login'])) {
        unset($_SESSION['login'], $_SESSION['name']);
        App::addMessage('success','Sėkmingai atsijungta');
        }
        App::redirect('login');
    }
}
