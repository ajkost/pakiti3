<?php
# Copyright (c) 2011, CESNET. All rights reserved.
# 
# Redistribution and use in source and binary forms, with or
# without modification, are permitted provided that the following
# conditions are met:
# 
#   o Redistributions of source code must retain the above
#     copyright notice, this list of conditions and the following
#     disclaimer.
#   o Redistributions in binary form must reproduce the above
#     copyright notice, this list of conditions and the following
#     disclaimer in the documentation and/or other materials
#     provided with the distribution.
# 
# THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
# CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
# INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
# MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
# DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS
# BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
# EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
# TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
# DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
# ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
# OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY
# OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
# POSSIBILITY OF SUCH DAMAGE. 

class InstalledPkgDao {
  private $db;
  
  public function __construct(DbManager &$dbManager) {
    $this->db = $dbManager;  
  }
  
  /*******************
   * Public functions
   *******************/
  
  /*
   * Stores the installedPkg in the DB
   */
  public function create(Pkg $pkg, Host $host) {
    $this->db->query(
      "insert into InstalledPkg set
      	packageId='".$this->db->escape($pkg->getId())."'
      	hostId='".$this->db->escape($host->getId())."'
	");
  }
  
  /*
   * Get the installedPkg by its pkgId and hostId
   */
  public function get($hostId, $packageId) {
    return $this->db->queryObject("select 
	packageId, hostId
      from 
	installedpkg
      where packageId=".$this->db->escape($packageId)." and
        hostId=".$this->db->escape($hostId), "InstalledPkg");
  }

    /*
     * Get the list of installedPkg Ids by hostId
     */
    public function getIdsByHostId($hostId) {
        return $this->db->queryToMultiRow("select
	packageId
      from
	installedpkg
      where hostId=".$this->db->escape($hostId));
    }


  /*
   * Gets all installed packages for defined host
   */
  public function getInstalledPkgs(Host &$host, $orderBy, $pageSize, $pageNum) {
   // Because table contains only ids of the arch, host and pkg, we need to create special sql queries for each order
   $sql = "select hostId, pkgId, `version`, `release`, archId ";
   $where = "where hostId={$host->getId()}";
   switch ($orderBy) {
    case "arch":
      $sql .= "from InstalledPkg left join Arch on InstalledPkg.archId=Arch.id $where order by Arch.name";
      break;
    case "version":
      $sql .= "from InstalledPkg $where order by InstalledPkg.version, InstalledPkg.release";
      break;
    default:
      // oderByName by default
      $sql .= "from InstalledPkg left join Pkg on InstalledPkg.pkgId=Pkg.id $where order by Pkg.name";
    }
    if ($pageSize != -1 && $pageNum != -1) {
      $offset = $pageSize*$pageNum;
      $sql .= " limit $offset,$pageSize";
    }

    $installedPkgsDb =& $this->db->queryToMultiRow($sql);
    # Create objects
    $installedPkgs = array();
    if ($installedPkgsDb != null) {
      foreach ($installedPkgsDb as $installedPkgDb) {
	$installedPkg = new InstalledPkg();
	$installedPkg->setPkgId($installedPkgDb["pkgId"]);
	$installedPkg->setHostId($installedPkgDb["hostId"]);
	$installedPkg->setArchId($installedPkgDb["archId"]);
	$installedPkg->setVersion($installedPkgDb["version"]);
	$installedPkg->setRelease($installedPkgDb["release"]);
      
	array_push($installedPkgs, $installedPkg);
      }
    }
	    
    return $installedPkgs;
  }
 
 /*
   * Gets all installed packages for defined host
   * Returns an associated array. This function is used for the Feeder
   */
  public function getInstalledPkgsAsArray(Host &$host) {
   // Because table contains only ids of the arch, host and pkg, we need to create special sql queries for each order
   $sql = "select Pkg.name as pkgName, InstalledPkg.`version` as pkgVersion, InstalledPkg.`release` as pkgRelease,
    Arch.name as pkgArch from InstalledPkg, Pkg, Arch
    where InstalledPkg.pkgId=Pkg.id and InstalledPkg.archId=Arch.id and InstalledPkg.hostId={$host->getId()} order by Pkg.name";

    $installedPkgsDb =& $this->db->queryToMultiRow($sql);
    $installedPkgs = array();
    if ($installedPkgsDb != null) {
      foreach ($installedPkgsDb as $installedPkgDb) {
	$pkgTmp = array();
	$pkgTmp["pkgVersion"] = $installedPkgDb["pkgVersion"];
	$pkgTmp["pkgRelease"] = $installedPkgDb["pkgRelease"];
	$pkgTmp["pkgArch"] = $installedPkgDb["pkgArch"];

	$installedPkgs[$installedPkgDb["pkgName"]] = $pkgTmp;
      }
    }
    return $installedPkgs;
  }
  
  /*
   * Gets count of installed packages for defined host
   */
  public function getInstalledPkgsCount(Host &$host) {
    $sql = "select count(*) from InstalledPkg where hostId={$host->getId()}";  
    return $this->db->queryToSingleValue($sql);
  }
  
  /*
   * Update the installedPkg in the DB
   */
  public function update(InstalledPkg &$installedPkg) {
    $this->db->query(
      "update InstalledPkg set
      	version='".$this->db->escape($installedPkg->getVersion())."
      	release='".$this->db->escape($installedPkg->getRelease())."
      where pkgId=".$this->db->escape($installedPkg->getPkgId())." and 
	hostId=".$this->db->escape($installedPkg->getHostId())." and 
	archId=".$this->db->escape($installedPkg->getArchId()));
  }
  
  /*
   * Delete the installedPkg from the DB
   */
  public function delete($hostId, $pkgId) {
    $this->db->query(
      "delete from InstalledPkg where
	packageId=".$this->db->escape($pkgId)." and
	hostId=".$this->db->escape($hostId));
  }
}
?>
