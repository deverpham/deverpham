<?php
require_once(App.'/core/config.php');
      function f_meta()  {
        $metaAr = array(
          "<meta charset='utf-8'>\n",
          "\t<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n",
        );
         foreach ($metaAr as $meta ) {echo $meta;}
      };
      function f_lang() {
        global $config;
        print "lang={$config['lang']}";
      }
      function f_head($title,$css=null,$js=null) {
        print "<title>{$title}</title> \n";
        if($css) {
          _loadModule('device');
          $device=getdevice();
          $data = null;
          foreach ($css as $value) {
              if($device=='desktop')
                $data.=file_get_contents(App.'/assets/css/'.$value.'.min.css');
              else
                $data.=file_get_contents(App.'/assets/css/'.$value.'.min.css');
          }
          print "\t<style rel='stylesheet' type='text/css'>\n{$data}\t</style>\n";
        };
        $jsdata=null;
        if($js) {
          foreach  ($js as $vl) {
            $jsdata.=file_get_contents(App.'/assets/js/'.$vl.'.js');
          }
        }
        print "\t<script>\n{$jsdata}\t</script>\n";
      };
      function f_url() {
        global $config;
        return $config['url'];
      };
       function f_array2html($array,$tag,$class=null) {
            foreach($array as $value) {
              if(!(bool)$class)
                  print "<{$tag}>{$value}</{$tag}>";
              else
                  print "<{$tag} class='{$class}'>{$value}</{$tag}>";
            }
      };
      function f_array2list($array,$classul=null,$classli=null) {
                          ($classul==null) ? $classul : $classul="class='{$classul}'";
                          ($classli==null) ? $classli : $classli="class='{$classli}'";
                          print "<ul {$classul}>";
                          foreach($array as $main => $sub) {
                                    if(is_string($main)) {
                                             print "<li>{$main}
                                             <ul {$classli}>";
                                             f_array2html($array[$main],'li');
                                             print "</ul>
                                             </li>";
                                    }
                                    else print "<li>{$array[$main]}</li>";
                          }
                          print '</ul>';
      }
 ?>
