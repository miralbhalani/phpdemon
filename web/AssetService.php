<?php

require('./db.php');
require('./queryBuilder.php');

class AssetService extends db {

  public function GetAll($queryParams, $cb = NULL) {
    $query = searchableQueryBuilder($queryParams, "assets");

    return parent::get($query, $cb);
  }

  public function getOne($id) {
    $query = "select * from assets where id = {$id}";
    return parent::getOne($query);
  }

  public function insert($data) {
    return pg_insert('assets', $data, PG_DML_ESCAPE);
  }

  public function update($data, $id) {
    return pg_update($db, 'assets', ['id' => $id], $data);
  }

  public function delete($id) {
    return pg_delete($db, 'assets', ['id' => $id]);
  }
}

?>