<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_CONFIGURATION.": "._AB_DEFAULTBLOCKER;
include("header.php");
OpenTable();
OpenMenu(_AB_DEFAULTBLOCKER);
mastermenu();
CarryMenu();
configmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="xblocker_row[block_name]" value="other" />'."\n";
echo '<input type="hidden" name="xop" value="'.$op.'" />'."\n";
echo '<input type="hidden" name="op" value="ABConfigSave" />'."\n";
$blocker_row = abget_blocker("other");
$blocker_row['duration'] = $blocker_row['duration'] / 86400;
echo '<input type="hidden" name="xblocker_row[activate]" value="'.$blocker_row['activate'].'" />'."\n";
echo '<input type="hidden" name="xblocker_row[htaccess]" value="'.$blocker_row['htaccess'].'" />'."\n";
echo '<input type="hidden" name="xblocker_row[forward]" value="'.$blocker_row['forward'].'" />'."\n";
echo '<input type="hidden" name="xblocker_row[block_type]" value="'.$blocker_row['block_type'].'" />'."\n";
echo '<input type="hidden" name="xblocker_row[email_lookup]" value="'.$blocker_row['email_lookup'].'" />'."\n";
echo '<input type="hidden" name="xblocker_row[duration]" value="'.$blocker_row['duration'].'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" bgcolor="'.$bgcolor2.'" colspan="2"><strong>'._AB_DEFAULTBLOCKER.'</strong></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_015).' '._AB_TEMPLATE.':</td><td><select name="xblocker_row[template]">'."\n";
$templatedir = dir('abuse');
$templatelist = '';
while($func=$templatedir->read()) {
  if(substr($func, 0, 6) == 'abuse_') { $templatelist .= $func.' '; }
}
closedir($templatedir->handle);
$templatelist = explode(" ", $templatelist);
sort($templatelist);
for($i=0; $i < sizeof($templatelist); $i++) {
	if($templatelist[$i] != '') {
		$bl = str_ireplace('abuse_', '', $templatelist[$i]);
		$bl = str_ireplace('.tpl', '', $bl);
		$bl = str_replace('_', ' ', $bl);
		echo '<option';
		if($templatelist[$i] == $blocker_row['template']) { echo ' selected="selected"'; }
		echo ' value="' . $templatelist[$i] . '">' . ucfirst($bl) . '</option>' . "\n";
	}
}
echo '</select></td></tr>'."\n";
echo '<tr><td bgcolor="'.$bgcolor2.'">'.help_img(_AB_HELP_017).' '._AB_REASON.':</td><td><input type="text" name="xblocker_row[reason]" size="20" maxlength="20" value="'.$blocker_row['reason'].'" /></td></tr>'."\n";
echo '<tr><td align="center" colspan="2"><input type="submit" value="'._AB_SAVECHANGES.'" /></td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>