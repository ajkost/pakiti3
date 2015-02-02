<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
require(realpath(dirname(__FILE__)) . '/../../../common/Loader.php');

$pakiti = new Pakiti();
$pkg = new Pkg();

$pkg->setName("test_pkga");
$pkg->setRelease("release_beta_aa");
$pkg->setVersion("1.2.3.4");

$pakiti->getManager("DbManager")->begin();
$pakiti -> getDao("Pkg") -> create($pkg);
$pakiti->getManager("DbManager")->commit();

echo $pkg->getId();
echo "done";
?>