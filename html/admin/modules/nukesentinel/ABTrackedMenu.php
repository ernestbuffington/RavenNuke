<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_TRACKEDIPMENU;
include("header.php");
$ip_sets = abget_configs();
OpenTable();
OpenMenu(_AB_TRACKEDIPMENU);
mastermenu();
CarryMenu();
trackedmenu();
CloseMenu();
CloseTable();
include("footer.php");

?>