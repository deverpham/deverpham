<?php
      function md_checkexist($link,$array,$table) {
        $data='';
        $i=0;
          foreach ($array as $key => $value) {
                  $value=$link->link()->real_escape_string($value);
                    $data.="`$key` = '$value'";
                    if($i < count($array)-1) { $data.= ' AND ';}
                   $i++;
          };
          $data="SELECT * from `$table`  WHERE ".$data;
          $result  = $link->query($data);
          if($result)  return true;
          else return false;
      };
      function md_add($link,$array,$table) {
        $query='';
        $lkey='';
        $lvalue='';
        $i=0;
        foreach($array as $key =>$value ) {
          $value = $link->link()->real_escape_string($value);
          $lkey.="`$key`";
          $lvalue.="'$value'";
          if($i < count($array)-1) {
            $lkey.= ', ';
            $lvalue.= ',';
          }
         $i++;
        }
        $query= "INSERT INTO `$table` ($lkey) VALUES ($lvalue)";
        $result =$link->nquery($query);
        if($result) return true;
        else return mysqli_error($link->link());
      };
      function md_delete($link,$array,$table) {
        $query='';
        $i=0;
        foreach ($array as $key => $value) {
                $value=$link->link()->real_escape_string($value);
                  $query.="`$key` = '$value'";
                  if($i < count($array)-1) { $query.= ' AND ';}
                 $i++;
        };
        $query= "DELETE FROM  `$table` where".$query;
        $result =$link->nquery($query);
        if($result) return true;
        else return mysqli_error($link->link());
      };
      function md_edit($link,$array,$search,$table) {
        $query='';
        $searchvalue='';
        $i=0;
        foreach ($array as $key => $value) {
                $value=$link->link()->real_escape_string($value);
                  $query.="`$key` = '$value'";
                  if($i < count($array)-1) { $query.= ' , ';}
                 $i++;
        };
        $i=0;
        foreach ($search as $key => $value) {
                $value=$link->link()->real_escape_string($value);
                  $searchvalue.="`$key` = '$value'";
                  if($i < count($search)-1) { $searchvalue.= ' AND ';}
                 $i++;
        };

        $query= "UPDATE   `$table` set".$query.' where '.$searchvalue;
        $result =$link->nquery($query);

        if($result) return true;
        else return mysqli_error($link->link());
      };
      function md_get($link,$array,$search,$table) {
        $query='';
        $searchvalue='';
        $i=0;
        foreach ($array as  $value) {
          if($value!='*') {
                $value=$link->link()->real_escape_string($value);
                  $query.=" `$value`";
                  if($i < count($array)-1) { $query.= ',';}
                 $i++;
               }
          else {
            $query='*';
          }
        };

        $i=0;
        foreach ($search as $key => $value) {
                $value=$link->link()->real_escape_string($value);
                  $searchvalue.="`$key` = '$value'";
                  if($i < count($array)-1) { $searchvalue.= ' AND ';}
                 $i++;
        };
        $query= "SELECT $query from   `$table` where $searchvalue";

        $result =$link->query($query);
        if($result) return $result;
        else return mysqli_error($link->link());
      }
 ?>
