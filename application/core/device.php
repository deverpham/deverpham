<?php
function getdevice() {
  $useragent=$_SERVER['HTTP_USER_AGENT'];
  $listmobile =array (
      'iphone',
      'mobile',
      'Android',
      'ipad',
      'Window Phone',
      'Tablet'
  );
  $found=false;
  foreach ($listmobile as $element) {
     if ((bool)stripos($useragent,$element) ==1)
     {
       $found=true;
       break;
     }
  }
   return ($found) ?  'mobile' :  'desktop';
}
 ?>
