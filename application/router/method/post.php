<?php
$listrouter = array (
 '/backdoor/login'  => function() {
            _loadModule('csrftoken');
            $token = new csrf();
            $tokenValue=$token->assign();
             if((!isset($_POST['csrf_token'])) || ($_POST['csrf_token'] != $tokenValue)) {
               echo 'Session has die.refresh page and try again';
             }
             else {
               _loadModule('validator');
                    $vl = new validator();
                    $rule = array (
                         'username' => array (
                                                    'minlength' => array (
                                                                              'value'=>5,
                                                                              'error' =>'lon hon 5 ki tu'
                                                                            ),
                                                    'maxlength' => array (
                                                                              'value' =>10,
                                                                              'error' =>'must less than 4 ki tu'
                                                                            )
                                                      ),
                          'password' => array (
                                                    'minlength' =>array (
                                                                              'value' => 'notempty',
                                                                              'error' => 'password required'
                                                                              )
                                                          )
                                        );
                     if (count($vl->checkValid($_POST,$rule)) ==0)
                     {
                           _loadModule('database');
                           _loadModel('database');

                           $mysql = new database();
                           $user=$_POST['username'];
                           $password=hash('sha256',$_POST['password']);
                           $isValid = md_checkexist($mysql,array(
                             'user' =>$user,
                             'password' => $password
                           ),'admin');
                           if($isValid)  {
                             _loadModule('cookie');
                             $ck = new cookie();
                             $ck->setcookie('username',$_POST['username']);
                            $ck->setcookie('password',hash('sha256',$_POST['password']));
                             $returntrue= array(
                               'isvalid' =>true
                             );
                             echo json_encode($returntrue);
                           }
                           else  {echo 'username or password not correct';}
                           $mysql->disconnect();
                   }
                   else echo json_encode($vl->listerror);
             }
 },
 '/backdoor/addcat' => function () {
                                          _loadModule('validator');
                                          $vl = new validator();
                                          $rule=array(
                                            'name' => array(
                                              'minlength' => array(
                                                'value' =>'notempty',
                                                'error' =>'name required'
                                              )
                                            ),
                                            'category' =>array (
                                            'minlength' =>array(
                                              'value' =>'notempty',
                                              'error' =>'category required'
                                            )
                                           )
                                          );
                                          if (count($vl->checkValid($_POST,$rule)) ==0) {
                                            _loadModule('database');
                                            _loadModel('database');
                                            $mysql = new database();
                                            $namecat=$_POST['category'];
                                            if(!$namecat=='empty') {
                                            $namecat=$mysql->link()->real_escape_string($namecat);
                                            $query="SELECT `id` from `category` where `name`='{$namecat}'";
                                            $result=$mysql->query($query);
                                            $subcat= $result[0]['id'];
                                            $data=array(
                                              'name'  => $_POST['name'],
                                              'subcat' =>$subcat,
                                              'icon'  =>$_POST['icon']
                                            );
                                            $ahihi=md_add($mysql,$data,'category');
                                            if(gettype($ahihi)=='string') {
                                              echo $ahihi;
                                            }
                                            else {
                                              echo 'them '.$_POST['name'].' thanh cong';
                                            }
                                          }
                                          else {
                                            $data=array(
                                              'name'  => $_POST['name'],
                                              'icon'   =>$_POST['icon']
                                            );
                                            $ahihi=md_add($mysql,$data,'category');
                                            if(gettype($ahihi)=='string') {
                                              echo $ahihi;
                                            }
                                            else {
                                              echo 'them '.$_POST['name'].' thanh cong';
                                            }
                                          }
                                            $mysql->disconnect();
                                          }
                                          else {
                                            echo json_encode($vl->listerror);
                                          }
                                     },
'/backdoor/deletecat' => function () {

                              _loadModule('validator');
                              $vl = new validator();
                              $rule = array(
                                'category' => array(
                                  'minlength' => array (
                                  'value' => 'notempty',
                                  'error' => 'category required'
                                )
                                )
                              );
                              $error=$vl->checkValid($_POST,$rule);
                              if(!count($error) == 0) {
                                echo json_encode($vl->listerror);
                              }
                              else {
                                _loadModule('database');
                                _loadModel('database');
                                $mysql = new database();
                                $data = array(
                                  'name' =>$_POST['category']
                                );
                                $result=md_delete($mysql,$data,'category');
                                if(gettype($result)=='string') {
                                  echo $result;
                                }
                                else {
                                  echo 'xoa '.$_POST['category'].' thanh cong';
                                }
                                $mysql->disconnect();
                              }
},
'/backdoor/catedit' => function() {
                          _loadModule('validator');
                          $vl = new validator();
                          $data = array(
                            'nameedit' =>array(
                              'minlength' =>array (
                              'value' => 'notempty',
                              'error' => 'name required'
                            )
                          ),
                          'namecurrent' => array(
                            'minlength' => array(
                              'value' =>'notempty',
                              'error' => 'name required'
                            )
                          )
                          );
                         if(!count($vl->checkValid($_POST,$data))==0) {
                            echo json_encode($vl->listerror);
                         } else {
                           _loadModule('database');
                           _loadModel('database');
                           $mysql = new database();
                          $data = array(
                            'name' => $_POST['nameedit'],
                            'icon'   =>$_POST['icon']
                          );
                          $search = array(
                            'name' =>$_POST['namecurrent']
                          );
                          $result=md_edit($mysql,$data,$search,'category');
                          if(gettype($result)=='string') {
                            echo $result;
                          }
                          else {
                            echo 'Edit '.$_POST['nameedit'].' thanh cong';
                          }
                          $mysql->disconnect();
                         }
},
'/backdoor/addpost' => function() {
                _loadModule('validator' );
                $vl = new validator();
                $rule = array(
                  'content' => array(
                    'minlength' => array(
                      'value' => 'notempty',
                      'error' =>'content require'
                    )
                  ),
                  'category' => array(
                    'minlength' => array(
                      'value' =>'notempty',
                      'error' =>'content required'
                    )
                  ),
                  'title' => array(
                    'minlength' => array(
                      'value' => 10,
                      'error' => 'must be more than 10 character'
                    )
                  )
                );
                if(!count($vl->checkValid($_POST,$rule))==0) {
                  echo json_encode($vl->listerror);
                }
                else {
                  _loadModule('database');
                  _loadModel('database');
                  $mysql = new database();
                  $namecat=$mysql->link()->real_escape_string($_POST['category']);
                  $result=$mysql->query("SELECT `id` From `category` where `name`='$namecat'");

                  $nameid=$result[0]['id'];
                  $dataform = array (
                  'name' =>$_POST['title'],
                  'idcat' =>$nameid,
                  'content' => $_POST['content'],
                  'time' => date('Y-m-d H:i:s')
                );
                  $result=md_add($mysql,$dataform,'post');
                  if(gettype($result) =='string') {
                    echo $result;
                  } else {
                    echo 'them '.$_POST['title']. 'thanh cong';
                  }
                  $mysql->disconnect();
                }
},
'/backdoor/getpost' => function() {
                    _loadModule('validator');
                    $vl = new validator();
                    $rule =array(
                      'category' => array( 'minlength' => array('value'=>'notempty','error'=>'category needed'))
                    );
                    if( ! count($vl->checkValid($_POST,$rule)) == 0 ) {
                       echo json_encode( $vl->listerror);
                    } else {
                      _loadModule('database');
                      _loadModel('database');
                      $mysql = new database();
                      $array= array (
                      'name'
                    );
                    $idcat=$mysql->link()->real_escape_string($_POST['category']);
                    $result=$mysql->query("SELECT `id` From `category` where `name`='$idcat'");

                    $idcat=$result[0]['id'];
                    $search = array(
                      'idcat' => $idcat
                    );
                      $result=md_get($mysql,$array,$search,'post');
                      if(gettype($result) =='string') {
                        echo $result;
                      } else {
                        echo json_encode($result);
                      }
                    }
},
'/backdoor/getpostcontent' => function() {
                          _loadModule('validator');
                          $vl = new validator();
                          $rule =array (
                          'name' => array(
                            'minlength' => array(
                              'value' => 'notempty',
                              'error' => 'name required'
                            )
                          )
                        );
                        if(! count($vl->checkValid($_POST,$rule))==0) {
                           echo json_encode($vl->listerror);
                        } else {
                              _loadModule('database');
                              _loadModel('database');
                              $mysql = new database();
                              $array =array (
                              'content'
                            );
                            $search = array (
                            'name' => $_POST['name']
                          );
                            $result= md_get($mysql,$array,$search,'post');
                            if(gettype($result)=='string') {
                              echo $result;
                            } else {
                              echo json_encode($result);

                            }
                        }
},
'/backdoor/updatepost' => function () {
                  _loadModule('validator');
                  $vl = new validator();
                  $rule = array(
                    'content' => array(
                      'minlength' => array(
                        'value' => 'notempty',
                        'error' =>' content required'
                      )
                    ),
                    'nameedit' => array(
                      'minlength' =>array(
                        'value' =>'notempty',
                        'error' =>'nameedit required'
                      )
                    )
                  );
                  if(! count($vl->checkValid($_POST,$rule))==0) {
                    echo json_encode($vl->listerror);
                  }
                  else {
                    _loadModule('database');
                    _loadModel('database');
                    $mysql = new database();
                    $array = array(
                      'content' => $_POST['content'],
                      'name'  => $_POST['nameedit']
                    );
                    $search = array(
                      'name' => $_POST['name']
                    );
                    $result = md_edit($mysql,$array,$search,'post');
                    if(gettype($result)=='string') {
                      echo $result;
                    }
                    else {
                       echo 'Edit '.$_POST['name'].' thanh cong';
                    }
                  }
},
'/backdoor/deletepost' => function() {
                  _loadModule('database');
                  _loadModel('database');
                  $mysql = new database();
                  $array = array(
                    'name' => $_POST['name']
                  );
                  $result=md_delete($mysql,$array,'post');
                  if(gettype($result)=='string') {
                    echo $result;
                  }
                  else {
                     echo 'DELETE  '.$_POST['name'].' thanh cong';
                  }
},
'/backdoor/addsubgallery' => function() {
                _loadModule('validator');
                $vl = new validator();
                $rule = array(
                  'name' => array (
                    'minlength' => array(
                      'value' => 'notempty',
                      'error' => 'name required'
                    )
                  )
                );
                if(! count($vl->checkValid($_POST,$rule))==0) {
                        echo json_encode($vl->listerror);
                }
                else {
                  _loadModule('database');
                  _loadModel('database');
                  $mysql = new database();
                  $array =array (
                  'name' => $_POST['name']
                );
                  $result = md_add($mysql,$array,'galery');
                  if(gettype($result)=='string') {
                    echo $result;
                  }
                  else {
                     echo 'Them  '.$_POST['name'].' thanh cong';
                  }
                }
},
'/backdoor/addgallerypost' => function() {
                _loadModule('validator');
                $vl = new validator();
                print_r($_POST);
                $rule = array(
                  'name' => array (
                    'minlength' => array(
                      'value' => 'notempty',
                      'error' => 'name required'
                    )
                  ),
                  'idcat' => array(
                    'minlength' => array(
                      'value' => 'notempty',
                     'error' =>' name required'
                    )
                  )
                );
                if(!count($vl->checkValid($_POST,$rule))==0) {
                        echo json_encode($vl->listerror);
                }
                else {
                  _loadModule('database');
                  _loadModel('database');
                  $mysql = new database();
                  $array =array (
                  'imgurl' => $_POST['name'],
                  'subid' => $_POST['idcat']
                    );
                  $result = md_add($mysql,$array,'imagegalery');
                  if(gettype($result)=='string') {
                    echo $result;
                  }
                  else {
                     echo 'Them  '.$_POST['name'].' thanh cong';
                  }
                }
},
'/category/view' => function() {
                          if(!isset($_POST['id'])) {
                            echo 'error!try again';
                            exit();
                          } else {
                            $id = $_POST['id'];
                            _loadModule('database');
                            _loadModel('database');
                            $mysql = new database();
                            $array = array (
                                        '*'
                            );
                            $search = array (
                                        'idcat' =>$id
                          );
                            $result = md_get($mysql,$array,$search,'post');
                            if(gettype($result)=='string') {
                            echo "<div class='card-panel'>
                                    <h1 class='center-align truncate '>Chưa Có Bài Viết Nào</h1>
                                    </div>";
                            } else {
                              $data['post']=$result;
                              $data['mysql'] =$mysql;
                              _loadView('categorypost',$data);
                            }
                          }
},
'/readpost/likepost' =>function() {
      if(!isset($_POST['id'])) {
        exit();
      }
      else {
            _loadModule('database');
            _loadModel('database');
            $mysql = new database();
            $curentlike = md_get($mysql, array (
                                          'vote'
            ),                                            array (
                                          'id' =>$_POST['id']
          ),  'post');
          if(gettype($curentlike)!='string') {
            $like = $curentlike[0]['vote']+1;
            md_edit($mysql, array ( 'vote'=> $like),array('id' => $_POST['id']),'post');
          }
          $mysql->disconnect();
      }
}
);
_routing($listrouter);
 ?>
