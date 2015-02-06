<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
require(realpath(dirname(__FILE__)) . '/../../../common/Loader.php');

$pakiti = new Pakiti();
$pkg = new Pkg();

$pkg->setName("test_pkg");
$pkg->setRelease("release_BB");
$pkg->setVersion("1.1");

$pakiti->getManager("DbManager")->begin();
$pakiti -> getDao("Pkg") -> create($pkg);
$pakiti->getManager("DbManager")->commit();

$id = $pkg->getId();
$pkg2 = $pakiti -> getDao("Pkg") -> getById($id);
$pkg2 -> setVersion("1.8.9.0");
$pakiti -> getDao("Pkg") -> update($pkg2);
?>