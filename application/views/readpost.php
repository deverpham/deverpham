<?php $icon=''; ?>
<!DOCTYPE html>
<html <?php f_lang(); ?>>
  <head>
    <?php f_meta(); ?>
    <?php f_head($data['title'],$data['css'],$data['js']); ?>
  </head>
  <body>

<?php require_once('header.php') ?>
      <div class="body-content row">
        <?php require_once('left-nav.php'); ?>
          <div class="col s10 right-content " >
                <?php $post = $data['post'];
                    foreach($post as $row) {
                 ?>
                <div class="row z-depth-2 margin-left-20" id='post'>
                    <h4 class='col s12 post-title'>
                      <span class='postcaticon'>
                        <?php $catid=$row['idcat'];

                        $array = array (
                                              'icon'
                        );
                        $search = array (
                                              'id' => $catid
                        );
                        $result=md_get($data['mysql'],$array,$search,'category');
                            echo $result[0]['icon'];
                            $icon=$result[0]['icon'];

                          ?>
                      </span>
                      <span class='post-name z-depth-2'>  <?php echo $row['name']; ?></span>
                    </h4>
                    <time class='col s12'><?php echo $row['time']; ?></time>

                      <div class="col s3">

                        <div class="col s6 textlikeviewparent">
                          <span ><i class='material-icons post-view'>visibility</i> <span class='textlikeview'>: <?php echo $row['views'] ?></span></span>
                        </div>
                        <div class="col s6 textlikeviewparent">
                          <span><i class='material-icons post-like'>thumb_up</i> <span class='textlikeview'>: <?php echo $row['vote'] ?></span></span>
                        </div>
                        </div>
                    <div class="col s12 post-content ">
                      <div class="post-noidung">
                              <?php
                              echo $row['content'];
                              ?>
                  </div>
                    </div>

                </div>
                <?php } ?>
                <div class="row z-depth-2 margin-left-20" id='postincategory'>
                  <h4>Các bài viết cùng chuyên mục</h4>
                  <div class="row">
                  <div class="col s6">
                     <ul class="tabs">
                       <li class="tab col s3"><a href="#newpost">Mới Hơn</a></li>
                       <li class="tab col s3"><a class="active" href="#oldpost">Cũ Hơn</a></li>
                     </ul>

                   </div>
                   <div id="newpost" class="col s12">

                     <?php $result=$data['mysql']->query(" SELECT `name`,`id`
                                                                                 FROM `post`
                                                                                 WHERE `idcat`=$catid AND `id` > {$post[0]['id']}
                     ");
                                 if($result) {
                                   foreach($result as $row) {
                                     print "<p><a href='/readpost/post?id={$row['id']}&name={$row['name']}'>{$row['name']}</a></p>";
                                   }

                                 }
                     ?>


                   </div>
                   <div id="oldpost" class="col s12">
                     <?php $result=$data['mysql']->query(" SELECT `name`,`id`
                                                                                 FROM `post`
                                                                                 WHERE `idcat`=$catid AND `id` < {$post[0]['id']}
                     ");
                                 if($result) {
                                   foreach($result as $row) {
                                     print "<p><a href='/readpost/post?id={$row['id']}&name={$row['name']}'>{$row['name']}</a></p>";
                                   }

                                 }
                     ?>
                   </div>
                   </div>

                  </div>
          </div>
      </div>
      <div class="footer">

      </div>

  </body>
</html>
