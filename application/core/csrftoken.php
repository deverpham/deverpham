<?php
$isstartsession=session_status();
if( $isstartsession!=2 ) {
session_start();
}
class csrf {
  private $tokenkey;
  private $tokenname;
   function __construct()  {
     _loadModule('config');
     global $config;
     $this->tokenkey=$config['csrf_key'];
     $this->tokenname=$config['csrf_name'];

   }
   private function create() {
          $_SESSION['expire']= time();
          $tokenValue= $_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']
          .$_SESSION['expire'].$this->tokenname;
          $tokenValue = hash('sha256',$tokenValue);
          $_SESSION[$this->tokenname]=$tokenValue;
   }
   public function assign() {

                if(isset($_SESSION[$this->tokenname])) {
                  if($_SESSION['expire'] + 30*60 < time()) {
                          session_unset();
                          session_destroy();
                          $this->create();
                  }
                }
                else {
                        $this->create();
                    }
            return $_SESSION[$this->tokenname];
 }
}

 ?>
