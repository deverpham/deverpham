<?php
$listrouter =array(


  '/' => function() {
                              $data = array(
                                'title' => 'DeverPham - Web Developer | Game Developer | Guitarist | Photographer',
                                'css'  => array(
                                  'index'
                                ),
                                'js'   => array (
                                'jquery',
                                'mt.min',
                                'moment',
                                'index'
                              )
                              );

                              _loadModule('frontend');
                              _loadModule('database');
                              _loadModel('database');
                             $mysql = new database();
                             $data['category']=$mysql->query('SELECT *
                                                                                  FROM   `category`
                                                                                  ');
                            $data['post'] =$mysql->query(' SELECT *
                                                                                 FROM `post`
                                                                                 ORDER BY `time` DESC
                                                                                 ');
                            $data['mysql'] = $mysql;

                               _loadView('index',$data);
    },
  '/backdoor' => function() {
                            _loadModule('cookie');
                            $ck = new cookie();
                           if (!$ck->ishave('username')) {
                             header('location:/backdoor/login');
                           }
                           else {
                             _loadModule('database');
                             _loadModel('database');
                             $password=$ck->getvalue('password');
                             $username=$ck->getvalue('username');
                             $mysql = new database();
                             if(!md_checkexist($mysql,array(
                               'user' =>$username,
                               'password' =>$password
                             ),'admin')) {
                               header('location:/backdoor/login');
                             }
                           }
                             $data = array (
                             'title'  => 'Cpanel My Life  | Dever Pham',
                             'css'  =>  array(
                                      'backdoor'
                                ),
                                'js'    => array(
                                      'jquery',
                                      'mt.min',
                                      'backdoor'
                                ),
                                'mysql' =>$mysql
                             );
                             _loadModule('frontend');
                              _loadView('admin/index',$data);

    },
  '/backdoor/login' => function () {
                                        $data = array (
                                        'title'  => 'Cpanel My Life -Login  | Dever Pham',
                                        'css'  =>  array(
                                                 'admin.login'
                                           ),
                                           'js'    => array(
                                                 'jquery',
                                                 'mt.min',
                                                 'admin.login'
                                           )
                                        );
                                        _loadModule('frontend');
                                        _loadModule('csrftoken');
                                        _loadModule('cookie');
                                        $ck  = new cookie();
                                        if($ck->ishave('username') ){
                                          //header('Location:/backdoor');
                                         _loadModule('database');
                                         _loadModel('database');
                                         $mysql = new database();
                                         $datainfo = array(
                                           'user' =>$ck->getvalue('username'),
                                           'password' =>$ck->getvalue('password')
                                         );
                                         if(md_checkexist($mysql,$datainfo,'admin')) {
                                           header('Location:/backdoor');
                                         }
                                         $mysql->disconnect();
                                        }
                                        _loadView('admin/login',$data);
  },
  '/backdoor/logout' => function() {
                                  _loadModule('cookie');
                                  $ck = new cookie();
                                  $ck->destroy();
                                  header('location:login');
  },
  '/readpost/post'  => function() {
                    $id=$_GET['id'];
                    if(!$id) {
                      header('location:/');
                    }
                    else {
                        checksqli($id);
                        _loadModule('database');
                        _loadModel('database');
                        $mysql = new database();
                        $array = array (
                        '*'
                      );
                      $search = array(
                        'id' =>$id
                      );
                        $result=md_get($mysql,$array,$search,'post');
                        if(gettype($result)=='string') {
                          _loadView('error/404page');
                        }
                        else {
                          $view=$result[0]['views']+1;
                          md_edit($mysql,array(
                            'views' => $view
                          ),array(
                            'id'=>$id
                          ),'post');
                          $data = array(
                            'title' =>$_GET['name'],
                            'css' => array (
                                              'readpost'
                            ),
                            'js' => array(
                                              'jquery',
                                              'mt.min',
                                              'moment',
                                              'readpost'
                              )
                          );
                          _loadModule('frontend');
                         $data['category']=$mysql->query('SELECT *
                                                                              FROM   `category`
                                                                              ');
                        $data['mysql'] = $mysql;
                          $data['post']=$result;
                          _loadView('readpost',$data);
                        }
                        $mysql->disconect();
                    }
  }
);
_routing($listrouter);
 ?>
