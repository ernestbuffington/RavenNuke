<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$clearresult = $db->sql_query("SELECT * FROM `".$prefix."_nsnst_blocked_ips`");
while($clearblock = $db->sql_fetchrow($clearresult)) {
  $db->sql_query("DELETE FROM `".$prefix."_nsnst_blocked_ips` WHERE `ip_addr`='".$clearblock['ip_addr']."'");
  $db->sql_query("OPTIMIZE TABLE `".$prefix."_nsnst_blocked_ips`");
  if($ab_config['htaccess_path'] != "") {
    if($ab_config['htaccess_path'] != "") { $ipfile = file($ab_config['htaccess_path']); }
    $ipfile = implode("", $ipfile);
    $i = 1;
    while($i <= 3) {
      $tip = substr($clearblock['ip_addr'], -2);
      if($tip == ".*") { $clearblock['ip_addr'] = substr($clearblock['ip_addr'], 0, -2); }
      $i++;
    }
    $testip = "deny from ".$clearblock['ip_addr']."\n";
    $ipfile = str_replace($testip, "", $ipfile);
    $doit = fopen($ab_config['htaccess_path'], "w");
    fwrite($doit, $ipfile);
    fclose($doit);
  }
}
header("Location: ".$admin_file.".php?op=ABBlockedIPMenu");

?>