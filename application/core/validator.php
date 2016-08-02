<?php
          class validator {
            private $data;
            public $listerror =array();
                  public function checkValid ($data,$rules) {
                    $this->data=$data;
                    foreach($rules as $cat =>$rule) {
                      if(isset($data[$cat]))  {
                            foreach ($rule as $row=>$value) {

                              if(method_exists($this,$row)) {
                                $this->$row($cat,$value);
                              }
                            }
                      }
                      else {
                        print "not exist $cat in list value";
                        exit();
                      }
                    }
                    return $this->listerror;
                  }
                  public function minlength($cat,$value) {
                    if ($value['value']=='notempty')
                    {
                      if($this->data[$cat]=='') $this->listerror[] = $value['error'];
                    }
                    else {
                       if((strlen($this->data[$cat]) <$value['value']))
                       {
                          $this->listerror[] = $value['error'];
                       }
                     }
                  }
                  public function maxlength($cat,$value) {
                     if(strlen($this->data[$cat]) >$value['value']) {
                       $this->listerror[] =$value['error'];
                     }
                  }
          }
 ?>
