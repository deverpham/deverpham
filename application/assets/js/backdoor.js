$(document).ready(function() {

   $('.menu li ').click(function() {
     var id = $(this).attr('id');
     var target="[menuid='"+id+"']";
     var html = $(target).html();
     $('.menu-content').html(html);
     var data=$('.content-data .listcategory').html();
     var listcat = data.split('-');
     listcat.splice(listcat.length-1,1);
     var option='';
     for(var i=0;i<=listcat.length-1;i++) {
        option+= "<option value="+listcat[i]+">"+listcat[i]+"</option>";
     }
     option+="<option value= selected></option>";
     $('button.new').click(function() {
              $('.menu-content').append(`
                <div class='row'>
                <div class='col s3'>
                  <form class='row' onsubmit='return false;' id='formaddcat'>
                    <label for='name'>name:</label>
                      <input type='text' name='name' />

                    <label for='icon'>icon:</label>
                      <input type='text' name='icon'>

                      <select class='browser-default' name='category'>
                      `+option+
                      `
                      </select>
                      <button id='addcat'>create</button>
                  </form>
                  </div>
                  </div>
                `);
                $('#addcat').click(function() {
                  var $this=$(this);
                  $data=$('#formaddcat').serialize();
                    $(this).attr('disabled',true);
                  $.post('backdoor/addcat',$data,function(data,status) {
                    if(status) {
                      $this.attr('disabled',false);
                    }
                    switch(status) {
                      case 'success' :
                            alert(data);
                            break;

                      case 'success' :
                            alert(data);
                            break;

                      case 'success' :
                            alert(data);
                            break;

                      case 'success' :
                            alert(data);
                            break;

                      case 'error' :
                        alert(data);
                        break;
                      };
                  });
                });
     });

$('button.delete').click(function() {
  var data=$('.content-data .listcategory').html();
  var listcat = data.split('-');
  listcat.splice(listcat.length-1,1);
  var option='';
  for(var i=0;i<=listcat.length-1;i++) {
     option+= "<option value="+listcat[i]+">"+listcat[i]+"</option>";

  }
  option+="<option value='' selected></option>";
    $('.menu-content').append(`
      <div class='col s3'
        <form  id='formdeletecat' onsubmit='return false;'>
        <label>Select :</label>
        <select class='browser-default' id='selectdeletecat' name='category'>
        `+option+`
        </select>

        </form>

        <button id='deletecat'>Delete</button>
        </div>
      `);
    $('#deletecat').click(function() {
       var dataform = {
         'category' : $('#selectdeletecat').val()
       }
       $.post('/backdoor/deletecat',dataform,function(data,status) {
             switch (status) {
               case 'success':
                                alert(data);
                                break;
              case 'error' :
                                alert(data);
                                break;
              default :
                        alert(status);
             }
       })

    })
});
//delete button/
$('button.edit').click(function() {
     hljs.initHighlightingOnLoad();
    var data=$('.content-data .listcategory').html();
    var listcat = data.split('-');
    listcat.splice(listcat.length-1,1);
    var option='';
    for(var i=0;i<=listcat.length-1;i++) {
       option+= "<option value="+listcat[i]+">"+listcat[i]+"</option>";

    }
    option+="<option value='' selected></option>";
    $('.menu-content').append(`
      <div class='col s3'
        <form  id='formdeletecat' onsubmit='return false;'>
        <label>Select :</label>
        <select class='browser-default' id='editselectcat' name='category'>
        `+option+`
        </select>

        </form>

        <button id='editcat'>Edit</button>
        </div>
      `);
      $('#editcat').click(function(){
        value=$('#editselectcat').val();

        $(this).parent().append(`
            <input id='namecatedit' value='`+value+`'>
              <input type='text' name='icon'  id='iconahihi'>
            <button id='saveedit'>save</button>
          `);

          currentvalue = $('#editselectcat').val();
          $('#saveedit').click(function(){
            icon=$('#iconahihi').val();
            value=$('#namecatedit').val();
            value ={
              'nameedit' :value,
              'namecurrent' :currentvalue,
              'icon' : icon
            };
            $.post('/backdoor/catedit',value,function(data,status) {
                  switch (status) {
                    case 'success':
                             alert(data)
                              break;
                    case 'error':
                            alert(data);
                            break;
                  }
            });
          });
      })
});

//for post menu

CKEDITOR.replace( 'editor1', {
  customConfig: '/application/assets/js/config.js'
});


$('#submitpost').click(function() {
  data=CKEDITOR.instances.editor1.getData();
  category=$('#postcategory').val();
  title =$('#titlepost').val();
  datasubmit={
    'content' :data,
    'category' :category,
    'title' : title
  };

  $.post('/backdoor/addpost',datasubmit,function(data,status) {
            switch (status) {
              case 'success':
                      alert(data);
                      break;
              case 'error' :
                    alert('try again');
                    break;
            }
  });
});
$('#editpost').click(function() {
  category =$('#postcategory').val();
  data= {
    'category' :category
  };
  $.post('backdoor/getpost',data,function(data,success) {
            if(success) {
              var returnvalue=[];


              try {
            returnvalue=$.parseJSON(data);
                }
                catch(err) {
                  returnvalue=false;
                }
                if(returnvalue===false) {
                  alert(data)
                }
                else {
                  appendvalue='';
                  for(i in returnvalue) {

                    appendvalue+="<option value='"+returnvalue[i]['name']+"'>"+returnvalue[i]['name']+"</option>"
                  }
                  appendvalue+="<option value='"+"' selected>"+'--select--'+"</option>"
                  appendvalue="<select id='postofcat' class='browser-default'>"+appendvalue+"</select>";
                  appendvalue+="<button id='deletepost' type='button'> DELETE</button>";
                  appendvalue+="<button id='updatepost' type='button'>UPDATE</button>";
                  $('#postcategory').parent().append(appendvalue);

                   //while for onchange
                   $('#postofcat').change(function() {
                     $('#titlepost').val($(this).val());
                        if($(this).val()!='') {
                          data = {
                            'name' : $(this).val()
                          };
                          $.post('/backdoor/getpostcontent',data,function(data,success) {
                                     if(success) {
                                       data =JSON.parse(data);
                                       CKEDITOR.instances.editor1.setData(data[0]['content']);
                                     }
                          });
                        }
                   });
                   $('#updatepost').click(function() {
                          datavlue = {
                            'content' :CKEDITOR.instances.editor1.getData(),
                            'name' : $('#postofcat').val(),
                            'nameedit' : $('#titlepost').val()
                          };
                          $.post('/backdoor/updatepost',datavlue,function(data,success) {
                                  if(success) {
                                    alert(data);
                                  }
                          });
                   });
                   $('#deletepost').click(function() {
                     datavalue = {
                       'name' : $('#postofcat').val()
                     };
                     $.post('/backdoor/deletepost',datavalue,function(data,success) {
                        if(success) {
                          alert(data);
                        }
                     });
                   });
                }
            }
          });

  });
    // gallery div
    $('.gallery #gallery-new').click(function() {

            $('.gallery').append(`
              <form onsubmit='return false' id='formaddnew'>
                    <label>Name</label>
                    <input type='text' name='name'>
                    <button type='submit' id='addnew'>Add</button>
              </form>
              `);
        $('#addnew').click(function() {
              datavalue=$('#formaddnew').serialize();

              $.post('/backdoor/addsubgallery',datavalue,function(data,success) {
                 if(success) {
                        alert(data);
                 }
              });
        });

   });
   $('.post-gallery #addnew').click(function() {
     $('.post-gallery').append(`
       <form onsubmit='return false' id='newpostgalery'>
             <label>Name</label>
             <input type='text' id='name'>
             <button type='submit' id='addnewpost'>Add</button>
       </form>
       `);
       $('#addnewpost').click(function() {
             datavalue = {
               'idcat' : $('#galerypostname').val(),
               'name' : $('#newpostgalery #name').val()
             }
             $.post('/backdoor/addgallerypost',datavalue,function(data,success) {
                if(success) {
                       alert(data);
                }
             });
       });
     });
     $('#savepersoninfo').click(function() {
       alert($(this).parent().serialize());
     });
   });

});
