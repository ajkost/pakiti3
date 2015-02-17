<?php
//error_reporting( E_ALL );
//ini_set( "display_errors", 1 );

include(realpath(dirname(__FILE__)) . '/../../../model/Pkg.php');
include(realpath(dirname(__FILE__)) . '/../../../dao/PkgDao.php');
require(realpath(dirname(__FILE__)) . '/../../../common/Loader.php');

$pakiti = new Pakiti();
$pkg = new Pkg();

$pkg->setName("test1_pkg2");
$pkg->setVersion("11.11");
$pkg->setRelease("release1_BB");
$pkg->setArch("x64");

$pakiti->getManager("DbManager")->begin();
//$pkg2 = $pakiti -> getDao("Pkg") -> getPkg("test1_pkg2","11.11","release1_BB","x64");
$ids = array(40,42);
$arr=$pakiti -> getDao("Pkg") -> getPkgsByPkgIds($ids);
//$pakiti->getManager("DbManager")->commit();

//$ar = $pakiti->getManager("DbManager")->queryToMultiRow("select id as _id, name as _name, version as _version, arch as _arch, `release` as _release      from `pkg`");
print_r(array_values($arr));



//echo $pkg2->getId();


echo "done";
?>