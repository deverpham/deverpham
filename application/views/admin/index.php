<!DOCTYPE html>

<html <?php f_lang(); ?>>
  <head>
    <?php f_meta(); ?>
    <?php f_head($data['title'],$data['css'],$data['js']); ?>
    <script src="//cdn.ckeditor.com/4.5.10/full-all/ckeditor.js"></script>
  </head>
  <body>



    <nav class=''>
  <div class="nav-wrapper ">
    <a href="#!" class="brand-logo">Admin Cpanel</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="sass.html"><i class="material-icons left">search</i>Link with Left Icon</a></li>
      <li><a href="backdoor/logout"><i class="material-icons right">open_in_new</i>Logout</a></li>
    </ul>
  </div>
</nav>
<div class="content row">
  <div class='menu col s2'>
    <ul>
      <li>Dashboard</li>
      <li id='category'>Category</li>
      <li id='post'>Post</li>
      <li id='gallery'>gallery</li>
      <li id='profile'>profile</li>
      <li id='level'>level</li>
    </ul>

  </div>
  <div class="menu-content col s10">
  </div>

</div>

<div class="content-data  hide ">
            <div class="" menuid='category'>
              <div class="container" id='category'>
                <div class="row">
                  <div class="col s4">
                    <button type="button" name="button" class='new'>new</button>
                  </div>
                  <div class="col s4">
                    <button type="button" name="button" class='delete'>delete</button>
                  </div>
                  <div class="col s4">
                      <button type="button" name="button" class='edit'>edit</button>
                  </div>
                </div>
                <div class="row listcategory">
                    <?php
                    $mysql = $data['mysql'];
                    $result = $mysql->query('SELECT name from category');
                    foreach($result as $row) echo $row['name'].'-';
                     ?>
                </div>
              </div>
          </div>
          <div menuid='post' class='col s12'>
            <div class="row">
              <textarea name="editor1"></textarea>
            </div>
                  <div class="row">
                            <select class="browser-default col s4" name="category" id='postcategory'>
                              <?php foreach($result as $row) { ?>
                              <option value="<?php echo $row['name'];   ?>"><?php echo $row['name']; ?></option>
                              <?php } ?>
                              <option value="" selected>default</option>
                            </select>
                            <input type="text" name="titlepost" value="" id='titlepost'>
                            <button type="button" name="button" id='submitpost'>SUBMIT</button>
                            <button type="button" name="button" id='editpost'> EDIT</button>
                  </div>
          </div>
          <div menuid='gallery' class='col s12'>
                  <div class="row gallery">
                    <label for=""> TOOL FOR SUB GALLERY</label>
                    <button type="button" name="button" id='gallery-new'>new</button>
                  </div>
                  <div class="row post-gallery">
                    <select class='browser-default' id='galerypostname'>
                      <?php $result = $mysql->query('SELECT  id,name from galery');
                      foreach($result as $row) { ?>
                       <option value='<?php echo $row['id'] ?>'><?php echo $row['name'] ?></option>
                       <?php } ?>
                       <option  value='' selected></option>
                    </select >
                    <label for=""> Tool for POST GALLERY</label>
                    <button type="button" name="button" id='addnew'>new</button>
                  </div>
          </div>
          <div menuid="profile" class='col s12'>
                <form class="col s12" action="updateinfo" method="post" onsubmit='return false'>
                          <label for="name">name</label>
                          <input type="text" name="name" value="">
                          <label for="date">birthday</label>
                          <input type="date" name="birthday" value="">
                          <p>
                              <input type="checkbox" id="sex" name='sex'/>
                                <label for="sex">sex</label>
                          </p>
                          <label for="hobbies">Hobbies</label>
                          <textarea name="hobbies" rows="8" cols="40"></textarea>
                          <label for="personality">personality</label>
                          <textarea name="personality" rows="8" cols="40"></textarea>
                          <label for="address">address</label>
                          <input type="text" name="address" value="">
                          <label for="facebook">facebook</label>
                          <input type="text" name="facebook" value="">
                          <label for="email">email</label>
                          <input type="text" name="email" value="">
                          <label for="sykpe">skype</label>
                          <input type="text" name="skype" value="">
                          <label for="job">job</label>
                          <input type="text" name="job" value="">
                          <button type="submit" name="submit" id='savepersoninfo'>Save</button>
                </form>
          </div>
          <div menuid="level" class='col s12'>
            <form class="" action="index.html" method="post">
              <label for="name">name</label>
                  <input type="text" name="name" value="">
              <label for="percent">percent</label>
                  <input type="text" name="percent" value="">
              <label for="color">color</label>
                  <input type="text" name="color" value="">
                    <button type="button" name="button" class='addnew'>add new</button>
            </form>

          </div>
</div>
<!--menuright-->
<!--menuright-->
  </body>
</html>
