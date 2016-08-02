<?php
class database   {
      private $link;
      function __construct() {
        $this->connect();
      }
          public function connect() {
            _loadModule('config');
            global $config;
            $info = $config['databaseinfo'];
            $this->link = mysqli_connect($info['host'],$info['username'],$info['password'],$info['database']);
            if(!$this->link) {
                echo 'error data : '.mysqli_connect_error();
                exit();
             }
          }
          public function link() {
            return $this->link;
          }
          public function disconnect() {
            $this->link->close();
          }
          public function query($string) {

              $result=$this->link->query($string);

              if($result->num_rows >0) {
                $return= array();
              while($row =$result->fetch_array(MYSQLI_ASSOC)) {
                $return[]=$row;
              }
              return $return;
            }
            else {
              return false;
            }
          }
          public function nquery($string) {
            $result=$this->link->query($string);
            return $result;
          }
}
 ?>
