<?php
class DBObject {
  protected $mapping;
  protected $data;

  public function __construct($data) {
    foreach($this->mapping as $column) {
      $this->data[$column] = $data[$column];
    }
  }

  public function __get($param) {
    return $this->data[$param];
  }
}
