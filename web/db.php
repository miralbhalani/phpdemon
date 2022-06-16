<?php

class db {
  public function __construct() {
    pg_connect("postgresql://miralbhalani2:v2_3rsgz_aL7NJAfNkxCYWMFuX6X8X79@db.bit.io/miralbhalani2/phpdemo1");
  }
  


  function get($query, $cb = NULL){
    $pgres = pg_query($query);
    
    $data = array();
    
    if($cb != NULL) {
      while ($row = pg_fetch_assoc($pgres)) {
        $cb($row);
      }
    } else {
      while ($row = pg_fetch_assoc($pgres)) {
        $data[] = $row;
      }
    }
    
    return $data;
  }

  function getOne($query){
    $pgres = pg_query($query);
    return pg_fetch_assoc($pgres);
  }
}