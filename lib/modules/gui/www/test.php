<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
require(realpath(dirname(__FILE__)) . '/../../../common/Loader.php');

$pakiti = new Pakiti();
$pkg = new Pkg();

//$pakiti->init();

$pkg->setName("test_pkg");
$pkg->setRelease("release123");
$pkg->setVersion("1.2.3");

$pakiti->getManager("DbManager")->begin();

//$pakiti->getDao("PkgDao")->create($pkg);

//$tag = new Tag();
//$tag -> setName("tagName");
//$tag -> setDescription("tagDescript");
$pakiti -> getDao("Pkg") -> create($pkg);



$pakiti->getManager("DbManager")->commit();
//$pkgDao = new PkgDao($pakiti->getManager("DbManager"));

//$pkgDao->create($pkg);
echo "done";
?>