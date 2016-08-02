$(document).on('submit','form#loginForm',function() {
  var preload =$('#loginForm').find('i');
  var button =$('#loginForm').find('button');
   preload.addClass('preloader-wrapper active');
   button.attr("disabled",true);
  $data=$('#loginForm').serialize();
  var iscompelte=false;
  $.post('login',$data,function(data,status) {
          if(status) {
            preload.removeClass('preloader-wrapper active');
            button.attr("disabled",false);
            switch (status )  {
              case 'success' :
                                try {
                              data=$.parseJSON(data);
                                  }
                                  catch(err) {
                                    data['isvalid']=false;
                                  }
                              if(data['isvalid']) {
                                  Materialize.toast('Login successfull', 1000, 'alert-success',function() {
                                    window.location='/backdoor';
                                  });
                              }
                              else
                              {
                                alert(data);
                              }
                              break;
              case 'error'  :
                              alert('try again');
                              break;
              default :
                            alert(status);
            }
          }
  });
  return false;
});
