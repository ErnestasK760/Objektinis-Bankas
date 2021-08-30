<?php

namespace Ernio\Bankas\Controllers;

use Ernio\Bankas\App;
use Ernio\Bankas\Json;
use Ernio\Bankas\User;


class BankController
{

    private $settings = 'Json';
    // private $settings = 'Maria';

    private function get()
    {
        $db = 'Ernio\\Bankas\\' . $this->settings;
        return $db::get();
    }
    public function __construct()
    {
        if (!App::isLogged()){
            App::redirect('login');
        }
    }
    public function login()
    {
        return App::view('login');
    }
    public function logout()
    {
        return App::view('logout');
    }
    public function create()
    {
        return App::view('create');
    }
    public function accountlist()
    {
        $vartotojai = $this->get()->showAll();
        return App::view('accountlist', ['vartotojai' => $vartotojai]);
    }


    public function update($action, $id)
    {
        $saskaita = $this->get()->show($id);
        if ('add-les' == $action && $_POST['count'] >= 0 && is_numeric($_POST['count'])){
            $saskaita['balance'] += round($_POST['count'],2);
            App::addMessage('success', 'Sėkmingai pridėta lėšų');
        }else if ('rem-les' == $action && $_POST['count'] >= 0 && is_numeric($_POST['count'])){
            if ($_POST['count'] > $saskaita['balance']){
            App::addMessage('danger', 'Įvyko klaida');
            }else{
            $saskaita['balance'] -= round($_POST['count'],2);
            App::addMessage('success', 'Sėkmingai nuskaičiuota lėšų');
            }
        }else {
            App::addMessage('danger', 'Įvyko klaida');
        }

        $this->get()->update($id, $saskaita);
        App::redirect('accountlist');
    }
    public function delete($id)
    {
        $this->get()->delete($id);
        App::addMessage('success', 'Sąskaita sėkmingai pašalinta');
        App::redirect('accountlist');
    }
    public function save()
    {
        if (!empty($_POST)) {
            if (strlen($_POST['name']) < 3  || strlen($_POST['surname']) < 3) {
                App::addMessage('danger', 'Per trumpi Vardas/Pavardė');
                App::redirect('create');
            } else if (!BankController::validASMK($_POST['personalId'])) {
                App::addMessage('danger', 'Blogai įvestas asmens kodas');
                App::redirect('create');
            } else if ($this->personalId($_POST['personalId']) == false){
                App::addMessage('danger', 'Blogai įvestas asmens kodas');
                App::redirect('create');
            }

            $user = new User();
            $user->name = ($_POST['name'] ?? 0);
            $user->surname = ($_POST['surname'] ?? 0);
            $user->personalId = ($_POST['personalId'] ?? 0);
            $user->balance = ($_POST['balance'] ?? 0);
            $user->acc = ($_POST['acc'] ?? 0);
            $data =  json_decode(json_encode($user), 1);
            Json::get()->create($data);
            App::addMessage('success', 'Sąskaita sekmingai sukurta');
            App::redirect('');
        }
    }

    public static function validASMK($s)
    {
        if (!is_numeric($s) || strlen($s) != 11) {
            return false;
        }
        $d = 0;
        $e = 0;
        $b = 1;
        $c = 3;
        for ($i = 0; $i < 10; $i++) {
            $a = $s[$i];
            $d = $d + ($b * $a);
            $e = $e + ($c * $a);
            $b++;
            if ($b == 10) $b = 1;
            $c++;
            if ($c == 10) $c = 1;
        }
        $d = $d % 11;
        $e = $e % 11;
        if ($d == 10) {
            $i = ($e == 10) ? 0 : $e;
        } else {
            $i = $d;
        }
        return ($s[10] == $i) ? true : false;
    }

    public function showingallSas()
    {
        $vartotojai = $this->get()->showAll();
        $for = 1;
        foreach ($vartotojai as $array) {
            echo
            '<tr class="text-center">
              <th scope="row">' . $for . '</th>
              <td class="td-allaccountlist">' . $array['name'] . '</td>
              <td class="td-allaccountlist">' . $array['surname'] . '</td>
              <td class="td-allaccountlist">' . $array['acc'] . '</td>
              <td class="text-center">' . round($array['balance'],2) . '</td>
              <td class="text-center">
                    <div class="btndiv-allaccountlist">
                        <form action='.URL.'add-les/'.$array["id"].' method="post">
                        <input name = "count" class="input-allaccountlist">
                        <button type="submit" class="btn btn-primary btn-sm mx-1 mb-1">Pridėti lėšų</button>
                        </form>
                        <form action='.URL.'rem-les/'.$array["id"].' method="post">
                        <input name = "count" class="input-allaccountlist">
                        <button type="submit" class="btn btn-secondary btn-sm mx-1 mb-1">Atimti lėšas</button>
                        </form>
                        <form action='.URL.'delete/'.$array["id"].' method="post">
                        <button type="submit" class="btn btn-danger btn-sm mx-4">Pašalinti sąskaitą</button>
                        </form>
                    </div>
                </td>
            </tr>';
            $for++;
        }
    }
    public function personalId($personalId)
    {
        $vartotojai = $this->get()->showAll();
        foreach ($vartotojai as $array){
            if ($personalId == $array['personalId']){
                return false;
            }
        }
    return true;
    }
}
