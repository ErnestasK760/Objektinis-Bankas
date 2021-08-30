<?php 
session_start();
define('INSTALL','/Projektas/Bankas/public/');
define('DIR', __DIR__.'/');
define('URL','http://localhost/Projektas/Bankas/public/');

require __DIR__.'/vendor/autoload.php';

function showMessages()
{
   return Ernio\Bankas\App::showMessages();

}