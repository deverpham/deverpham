<?php
  function _loadView($view,$data=null) {
          require_once(App.'/views/'.$view.'.php');
  };
  function _loadModule($nameModule)
  {
    include_once(App.'/core/'.$nameModule.'.php');
  }
  function _loadModel($nameModel)
  {
    include_once(App.'/model/'.$nameModel.'.php');
  }
 ?>
