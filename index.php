<?php
/*

Define Router Folder;
*/



define('App',$_SERVER['DOCUMENT_ROOT'].'/application');
require_once (App.'/router/router.php');
require_once(App.'/core/config.php');
global $config;
  $requestUrl=$_SERVER['REQUEST_URI'];
  $requestMethod= $_SERVER['REQUEST_METHOD'];

_routerApp($requestUrl,$requestMethod);

/* routing */


 ?>
