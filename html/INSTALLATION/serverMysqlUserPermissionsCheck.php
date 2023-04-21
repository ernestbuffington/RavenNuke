<?php
require_once('classes/dbMysql.class.php');
global $dbhost, $dbname, $dbuname, $dbpass, $dbMysql;
$dbMysql = new dbMysql($dbhost, $dbname, $dbuname, $dbpass);
$dbMysql->addDefaultXhtmlTemplate('head');
$dbMysql->dbServerConnect();
$dbMysql->dbSelectDb();
$dbMysql->dbTableCreate();
$dbMysql->dbQueryInsert();
$dbMysql->dbQuerySelect();
$dbMysql->dbQueryUpdate();
$dbMysql->dbQueryDelete();
$dbMysql->dbTableDropSelective();
$dbMysql->dbServerDisconnect();
$dbMysql->addDefaultXhtmlTemplate('foot');
$dbMysql->destroy();
?>
