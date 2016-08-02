
<!DOCTYPE html>
<html>
  <head <?php f_lang(); ?>>
<?php f_meta(); ?>
<?php  f_head($data['title'],$data['css'],$data['js']); ?>
  </head>
  <body >
<?php
$token = new csrf();
?>
      <div class="row  valign-wrapper" style='height:90vh;'>
            <div class="col s12 l6 offset-l3 valign">
                <form  class="col s12 right-alert " id='loginForm'>
                  <input type="hidden" name="csrf_token" value="<?php echo $token->assign(); ?>">
                  <div class="row">
                    <h1 class='title'>Login Cpanel</h1>
                  </div>
                  <div class="row">
                          <div class="input-field col s12 m6">
                            <input  class=''  type="text" name="username" placeholder="UserName " >
                            <label for="username" data-error='' data-success=''></label>
                          </div>
                          <div class="input-field col s12 m6">
                            <input type="password" name="password" placeholder="Password">
                          </div>
                  </div>
                  <div class="row">
                    <button type="submit" class='btn col s4 offset-s4' ><i class=" large material-icons" >send</i></button>
                  </div>
                </form>
          </div>
  </div>
  </body>
</html>
