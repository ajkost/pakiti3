<?php
include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
include(realpath(dirname(__FILE__)) . '/../../../managers/DbManager.php');
include(realpath(dirname(__FILE__)) . '/../../../common/Pakiti.php');

$pakiti = new Pakiti();
$pkg = new Pkg();

//$pakiti->init();

$pkg->setName("test_pkg");
$pkg->setRelease("release123");
$pkg->setVersion("1.2.3");

//$pkgDao = new PkgDao($pakiti->getManager("DbManager"));

//$pkgDao->create($pkg);
echo "done";
?>