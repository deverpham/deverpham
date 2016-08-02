<?php
define ('methodFolder',dirname(__FILE__));
function _routerApp (  $requestUrl,$requestMethod) {
  global $link;
  $link=$requestUrl;
  $post = strpos($requestUrl,'?');
  if($post >=0 && gettype($post)=='integer' )
  {
    $post =strpos($requestUrl,'?');
    $link=substr($requestUrl,0,$post);
  }


    function _routing($list) {
      global $link;
      if(isset($list[$link]))
      {
              require_once(App.'/core/system.php');
               $list[$link]();
             }
      else
              echo 'not found';
    }
  switch((string)$requestMethod)  {
     case 'POST'  :
              require_once(methodFolder.'/method/post.php');
              break;
     case 'GET'  :
             require_once(methodFolder.'/method/get.php');
             break;
    case 'PUT'  :
            require_once(methodFolder.'/method/put.php');
            break;
    case 'DELETE' :
           require_once(methodFolder.'/method/delete.php');
           break;
    default :
          echo 'not recognize';
          break;
  }
}
function checksqli($value) {
  $isinject=strpos($value,"'");
  if(gettype($isinject)=='integer')
  {
    _loadView('error/sqli');
    exit();
  }

}
 ?>
