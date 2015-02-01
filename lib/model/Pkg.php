<?php

/**
 * @access public
 * @author Michal Prochazka
 */
class Pkg {
  private $_id;
  private $_name;
  private $_version;
  private $_release;

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

  /**
   * @return mixed
   */
  public function getVersion()
  {
    return $this->_version;
  }

  /**
   * @param mixed $version
   */
  public function setVersion($version)
  {
    $this->_version = $version;
  }

  /**
   * @return mixed
   */
  public function getRelease()
  {
    return $this->_release;
  }

  /**
   * @param mixed $release
   */
  public function setRelease($release)
  {
    $this->_release = $release;
  }


}
?>
