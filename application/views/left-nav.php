<div class="col s2 leftmenuedit" style='  transition: all 0.5s;'>


  <div class="col s2 left-menu z-depth-2  fixed">
    <ul>
      <?php $category = $data['category'];
                      foreach($category as $row) {
              ?>

      <li catid='<?php echo $row['id']; ?>' onclick="routercat(this)">
        <span class='iconcat' ><?php echo $row['icon'] ?></span>
        <span class='itemtext'><?php echo $row['name'] ?></span>
        </li>
            <?php } ?>
    </ul>
    <a class="btn-floating btn-large " id='toggle-menu'>
      <i class="material-icons">skip_previous</i>
    </a>
  </div>
            </div>
