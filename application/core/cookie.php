    <?php
    class cookie {
      private $info;
      private $name;
      private $data;
            function __construct() {
              global $config;
              $this->info =$config['cookie'];
              $this->name=$this->info['name'];
              $this->encryptname();
            }
      function encryptname() {
        $this->name=md5($this->name);
      }
      private function isexist() {
            if(isset($_COOKIE[$this->name]))
            {
              if($_COOKIE[$this->name]=='')
                        {
                          unset($_COOKIE[$this->name]);
                          return false;}
                  else {
                    return true;
                  }
            }
           else   return false;
      }
      function getdata() {
        if ($this->isexist()) {
          return $this->decrypt($_COOKIE[$this->name]);;
        }
      }
      function setcookie($name,$value) {
        $returnvalue='';
        if(!$this->isexist()) {
          $returnvalue= array(
            $name => $value
          );
          setcookie($this->name,$this->encrypt(json_encode($returnvalue)),$this->info['duration']*60*60 + time(),'/');
          $_COOKIE[$this->name]=$this->encrypt(json_encode($returnvalue));
        }
        else {
          $array=(array)json_decode($this->getdata());
          $isfound=false;
          foreach($array as $key=>$keyvalue)
          {
             if($key==$name) {
               $isfound=true;
               $array[$key]=$value;
               break;
             }
          }
          if(!$isfound) {
            $array[$name]=$value;
          }
          $returnvalue=$array;
          setcookie($this->name,$this->encrypt(json_encode($returnvalue)),$this->info['duration']*60*60 + time(),'/');
          $_COOKIE[$this->name]=$this->encrypt(json_encode($returnvalue));
        }
      }
      function destroy() {
        setcookie($this->name,'remove',time()-3600,'/');
        $_COOKIE[$this->name]='remove';
      }
      function encrypt($value) {
        $returnvalue=openssl_encrypt($value,$this->info['ssl_method'],$this->info['ssl_key']);
        return $returnvalue;
      }
      function decrypt($value) {
        $returnvalue=openssl_decrypt($value,$this->info['ssl_method'],$this->info['ssl_key']);
        return $returnvalue;
      }
      function ishave($name) {
        $array=(array)json_decode($this->getdata());
        return array_key_exists($name,$array);
      }
      function getvalue($key) {
        $array=(array)json_decode($this->getdata());
        return $array[$key];
      }

    }
     ?>
