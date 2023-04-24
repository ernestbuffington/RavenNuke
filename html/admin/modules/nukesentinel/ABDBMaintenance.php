<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
if(is_god()) {
  $pagetitle = _AB_NUKESENTINEL.": "._AB_DBMAINTENANCE;
  include("header.php");
  OpenTable();
  OpenMenu(_AB_DBMAINTENANCE);
  mastermenu();
  CarryMenu();
  databasemenu();
  CloseMenu();
  CloseTable();
  include("footer.php");
} else {
  header("Location: ".$admin_file.".php?op=ABMain");
}

?>