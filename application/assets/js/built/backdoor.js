!function(t){function e(n){if(a[n])return a[n].exports;var o=a[n]={exports:{},id:n,loaded:!1};return t[n].call(o.exports,o,o.exports,e),o.loaded=!0,o.exports}var a={};return e.m=t,e.c=a,e.p="",e(0)}([function(t,e){$(document).ready(function(){$(".menu li ").click(function(){var t=$(this).attr("id"),e="[menuid='"+t+"']",a=$(e).html();$(".menu-content").html(a);var n=$(".content-data .listcategory").html(),o=n.split("-");o.splice(o.length-1,1);for(var l="",c=0;c<=o.length-1;c++)l+="<option value="+o[c]+">"+o[c]+"</option>";l+="<option value= selected></option>",$("button.new").click(function(){$(".menu-content").append("\n                <div class='row'>\n                <div class='col s3'>\n                  <form class='row' onsubmit='return false;' id='formaddcat'>\n                    <label for='name'>name:</label>\n                      <input type='text' name='name' />\n\n                    <label for='icon'>icon:</label>\n                      <input type='text' name='icon'>\n\n                      <select class='browser-default' name='category'>\n                      "+l+"\n                      </select>\n                      <button id='addcat'>create</button>\n                  </form>\n                  </div>\n                  </div>\n                "),$("#addcat").click(function(){var t=$(this);$data=$("#formaddcat").serialize(),$(this).attr("disabled",!0),$.post("backdoor/addcat",$data,function(e,a){switch(a&&t.attr("disabled",!1),a){case"success":alert(e);break;case"success":alert(e);break;case"success":alert(e);break;case"success":alert(e);break;case"error":alert(e)}})})}),$("button.delete").click(function(){var t=$(".content-data .listcategory").html(),e=t.split("-");e.splice(e.length-1,1);for(var a="",n=0;n<=e.length-1;n++)a+="<option value="+e[n]+">"+e[n]+"</option>";a+="<option value='' selected></option>",$(".menu-content").append("\n      <div class='col s3'\n        <form  id='formdeletecat' onsubmit='return false;'>\n        <label>Select :</label>\n        <select class='browser-default' id='selectdeletecat' name='category'>\n        "+a+"\n        </select>\n\n        </form>\n\n        <button id='deletecat'>Delete</button>\n        </div>\n      "),$("#deletecat").click(function(){var t={category:$("#selectdeletecat").val()};$.post("/backdoor/deletecat",t,function(t,e){switch(e){case"success":alert(t);break;case"error":alert(t);break;default:alert(e)}})})}),$("button.edit").click(function(){hljs.initHighlightingOnLoad();var t=$(".content-data .listcategory").html(),e=t.split("-");e.splice(e.length-1,1);for(var a="",n=0;n<=e.length-1;n++)a+="<option value="+e[n]+">"+e[n]+"</option>";a+="<option value='' selected></option>",$(".menu-content").append("\n      <div class='col s3'\n        <form  id='formdeletecat' onsubmit='return false;'>\n        <label>Select :</label>\n        <select class='browser-default' id='editselectcat' name='category'>\n        "+a+"\n        </select>\n\n        </form>\n\n        <button id='editcat'>Edit</button>\n        </div>\n      "),$("#editcat").click(function(){value=$("#editselectcat").val(),$(this).parent().append("\n            <input id='namecatedit' value='"+value+"'>\n              <input type='text' name='icon'  id='iconahihi'>\n            <button id='saveedit'>save</button>\n          "),currentvalue=$("#editselectcat").val(),$("#saveedit").click(function(){icon=$("#iconahihi").val(),value=$("#namecatedit").val(),value={nameedit:value,namecurrent:currentvalue,icon:icon},$.post("/backdoor/catedit",value,function(t,e){switch(e){case"success":alert(t);break;case"error":alert(t)}})})})}),CKEDITOR.replace("editor1",{customConfig:"/application/assets/js/config.js"}),$("#submitpost").click(function(){n=CKEDITOR.instances.editor1.getData(),category=$("#postcategory").val(),title=$("#titlepost").val(),datasubmit={content:n,category:category,title:title},$.post("/backdoor/addpost",datasubmit,function(t,e){switch(e){case"success":alert(t);break;case"error":alert("try again")}})}),$("#editpost").click(function(){category=$("#postcategory").val(),n={category:category},$.post("backdoor/getpost",n,function(t,e){if(e){var a=[];try{a=$.parseJSON(t)}catch(n){a=!1}if(a===!1)alert(t);else{appendvalue="";for(c in a)appendvalue+="<option value='"+a[c].name+"'>"+a[c].name+"</option>";appendvalue+="<option value='' selected>--select--</option>",appendvalue="<select id='postofcat' class='browser-default'>"+appendvalue+"</select>",appendvalue+="<button id='deletepost' type='button'> DELETE</button>",appendvalue+="<button id='updatepost' type='button'>UPDATE</button>",$("#postcategory").parent().append(appendvalue),$("#postofcat").change(function(){$("#titlepost").val($(this).val()),""!=$(this).val()&&(t={name:$(this).val()},$.post("/backdoor/getpostcontent",t,function(t,e){e&&(t=JSON.parse(t),CKEDITOR.instances.editor1.setData(t[0].content))}))}),$("#updatepost").click(function(){datavlue={content:CKEDITOR.instances.editor1.getData(),name:$("#postofcat").val(),nameedit:$("#titlepost").val()},$.post("/backdoor/updatepost",datavlue,function(t,e){e&&alert(t)})}),$("#deletepost").click(function(){datavalue={name:$("#postofcat").val()},$.post("/backdoor/deletepost",datavalue,function(t,e){e&&alert(t)})})}}})}),$(".gallery #gallery-new").click(function(){$(".gallery").append("\n              <form onsubmit='return false' id='formaddnew'>\n                    <label>Name</label>\n                    <input type='text' name='name'>\n                    <button type='submit' id='addnew'>Add</button>\n              </form>\n              "),$("#addnew").click(function(){datavalue=$("#formaddnew").serialize(),$.post("/backdoor/addsubgallery",datavalue,function(t,e){e&&alert(t)})})}),$(".post-gallery #addnew").click(function(){$(".post-gallery").append("\n       <form onsubmit='return false' id='newpostgalery'>\n             <label>Name</label>\n             <input type='text' id='name'>\n             <button type='submit' id='addnewpost'>Add</button>\n       </form>\n       "),$("#addnewpost").click(function(){datavalue={idcat:$("#galerypostname").val(),name:$("#newpostgalery #name").val()},$.post("/backdoor/addgallerypost",datavalue,function(t,e){e&&alert(t)})})}),$("#savepersoninfo").click(function(){alert($(this).parent().serialize())})})})}]);