<?php

/**
 * @access public
 * @author Michal Prochazka
 */
class Pkg {
  private $_id;
  private $_name;

  public function Pkg() {
  }
  
  public function getId() {
    return $this->_id;
  }

  public function getName() {
    return $this->_name;
  }

  public function setId($val) {
    $this->_id = $val;
  }

  public function setName($val) {
    $this->_name = $val;
  }
}
?>