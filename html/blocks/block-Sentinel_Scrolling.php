<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKE_FILE') && !defined('BLOCK_FILE')) { header("Location: ../index.php"); }
global $prefix, $db, $user, $admin, $ab_config, $nsnst_const;
$content = '';
$result = $db->sql_query('SELECT `ip_addr`, `reason` FROM `'.$prefix.'_nsnst_blocked_ips` ORDER BY `date` DESC LIMIT 0,20');
$numrows = $db->sql_numrows($result);
	if ($numrows == 0) {
		$content = _BLOCKPROBLEM2;
	} else {
	$content .= '<script type="text/javascript" src="includes/nukesentinel4.js"></script>'."\n";
	$content .= '<div class="text-center">'._AB_LISTBANNEDIPS.'</div><hr />'."\n";
	$content .= '<div class="centered"><div id="marqueecontainer" style="position:relative; height:150px; overflow:hidden;" onmouseover="copyspeed=pausespeed" onmouseout="copyspeed=marqueespeed">';
	$content .= '<div id="vmarquee" style="position: absolute; width: 98%;">'."\n";
	$content .= '<div class="ul-box"><ul class="rn-ul">'."\n";
	while (list($ip_addr, $ip_reason) = $db->sql_fetchrow($result)) {
	  if((is_admin($admin) AND $ab_config['display_link']==1) OR ((is_user($user) OR is_admin($admin)) AND $ab_config['display_link']==2) OR $ab_config['display_link']==3) {
		$lookupip = str_replace('*', '0', $ip_addr);
		$content .= '<li><a href="'.$ab_config['lookup_link'].$lookupip.'" target="_blank">'.$ip_addr.'</a>';
	  } else {
		$content .= '<li>'.$ip_addr;
	  }
	  if((is_admin($admin) AND $ab_config['display_reason']==1) OR ((is_user($user) OR is_admin($admin)) AND $ab_config['display_reason']==2) OR $ab_config['display_reason']==3) {
		$result2 = $db->sql_query('SELECT `reason` FROM `'.$prefix.'_nsnst_blockers` WHERE `blocker`=\''.$ip_reason.'\' LIMIT 0,1');
		list($reason) = $db->sql_fetchrow($result2);
		//$reason = str_replace('Abuse-','',$reason);
		$content .= '<ul class="ul-circle"><li>'.$reason.'</li></ul>';
	  }
	  $content .= '</li>'."\n";
	}
	$content .= '</ul></div></div></div></div>'."\n";
	$content .= '<hr /><div class="text-center"><a href="https://www.ravenphpscripts.com" target="_blank">'._AB_NUKESENTINEL.'</a></div>'."\n";
}
?>