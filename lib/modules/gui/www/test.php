<?php
include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
include(realpath(dirname(__FILE__)) . '/../../../managers/DbManager.php');

$pkg = new Pkg();
$dbManager = new DbManager();

$pkg->setName("test_pkg");
$pkg->setRelease("release123");
$pkg->setVersion("1.2.3");

$pkgDao = new PkgDao($dbManager);

$pkgDao->create($pkg);
echo "done";
?>