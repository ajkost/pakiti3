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

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->_id;
  }

  /**
   * @param mixed $id
   */
  public function setId($id)
  {
    $this->_id = $id;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->_name;
  }

  /**
   * @param mixed $name
   */
  public function setName($name)
  {
    $this->_name = $name;
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
