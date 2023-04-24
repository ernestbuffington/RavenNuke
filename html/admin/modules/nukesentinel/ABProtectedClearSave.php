<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$result = $db->sql_query("DELETE FROM `".$prefix."_nsnst_protected_ranges`");
$db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_protected_ranges`");
header("Location: ".$admin_file.".php?op=ABProtectedMenu");

?>