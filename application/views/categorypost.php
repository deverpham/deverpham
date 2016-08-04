<?php $post = $data['post'];
    foreach($post as $row) {
 ?>
<div class="row z-depth-2 margin-left-20" id='post'>
    <h4 class='col s12 post-title'>
      <span>
        <?php $catid=$row['idcat'];

        $array = array (
                              'icon'
        );
        $search = array (
                              'id' => $catid
        );
        $result=md_get($data['mysql'],$array,$search,'category');
            echo $result[0]['icon'];

          ?>
      </span>
      <span class='post-name z-depth-2'>  <?php echo $row['name']; ?></span>
    </h4>

    <time class='col s12'><?php echo $row['time']; ?></time>
    <div class="col s12 post-content ">
      <div class="post-noidung">
              <?php
              $string=strip_tags($row['content']);
              $coverthtml=$row['content'];
              if (strlen($string) > 1000) {
              $stringCut = substr($row['content'], 0, 1000);
              $stringCut=$stringCut.' ...';
              $doc = new DOMDocument();
              $internalErrors = libxml_use_internal_errors(true);
              $doc->loadHTML('<?xml version="1.0" encoding="UTF-8"?>'.$stringCut);
              libxml_use_internal_errors($internalErrors);
              $coverthtml = $doc->saveHTML();
              }
              echo $coverthtml;
              ?>
  </div>
              <p><a class="waves-effect waves-light btn green" href='/readpost/post?id=<?php echo $row['id'].'&name='.$row['name']; ?>'><i class="material-icons left">cloud</i>Đọc thêm</a></p>
    </div>
    <div class="row">
      <div class="col s6">
        <div class="col s6 textlikeviewparent">
          <span ><i class='material-icons post-view'>visibility</i> <span class='textlikeview'>: <?php echo $row['views'] ?></span></span>
        </div>
        <div class="col s6 textlikeviewparent">
          <span><i class='material-icons post-like'>thumb_up</i> <span class='textlikeview'>: <?php echo $row['vote'] ?></span></span>
        </div>
      </div>
    </div>
</div>
<?php } ?>


<script type="text/javascript">
    $(document).ready(function() {
      $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
      });
      $('time').each(function() {
        time = $(this).text();
        moment.locale('vi');
        time=moment(time).fromNow();
        $(this).text(time);
      });
    })
</script>
