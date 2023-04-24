<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKE_FILE') && !defined('BLOCK_FILE')) { header("Location: ../index.php"); }
global $db, $prefix, $ab_config;
$total_ips = $db->sql_numrows($db->sql_query('SELECT * FROM `'.$prefix.'_nsnst_blocked_ips`'));
if(!$total_ips) { $total_ips = 0; }
$content  = '<div class="text-center"><img src="images/nukesentinel/nukesentinel_smaller.png" class="centered" height="19" width="140" alt="'._AB_WARNED.'" title="'._AB_WARNED.'" /><div class="text-center">'._AB_HAVECAUGHT.' '.intval($total_ips).' '._AB_SHAMEFULHACKERS.'</div></div>'."\n";
$content .= '<hr /><div class="text-center"><a href="https://www.ravenphpscripts.com" target="_blank">'._AB_NUKESENTINEL.'</a></div>'."\n";

?>