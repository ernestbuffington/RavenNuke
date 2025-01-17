<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = _AB_NUKESENTINEL.": "._AB_UNBLOCKIP;
include("header.php");
OpenTable();
OpenMenu(_AB_UNBLOCKIP);
mastermenu();
CarryMenu();
blockedipmenu();
CloseMenu();
CloseTable();
echo '<br />'."\n";
OpenTable();
if (!isset($sip)) $sip = '';
if (!isset($xIPs)) $xIPs = '';
if (!isset($xop)) $xop = '';
if (!isset($min)) $min = '';
if (!isset($column)) $column = '';
if (!isset($direction)) $direction = '';
echo '<form action="'.$admin_file.'.php" method="post">'."\n";
echo '<input type="hidden" name="op" value="ABBlockedIPDeleteSave" />'."\n";
echo '<input type="hidden" name="xIPs" value="'.$xIPs.'" />'."\n";
echo '<input type="hidden" name="xop" value="'.$xop.'" />'."\n";
echo '<input type="hidden" name="min" value="'.$min.'" />'."\n";
echo '<input type="hidden" name="sip" value="'.$sip.'" />'."\n";
echo '<input type="hidden" name="column" value="'.$column.'" />'."\n";
echo '<input type="hidden" name="direction" value="'.$direction.'" />'."\n";
echo '<table summary="" align="center" border="0" cellpadding="2" cellspacing="2">'."\n";
echo '<tr><td align="center" class="content">'._AB_UNBLOCKIPS.' '.$xIPs.'?</td></tr>'."\n";
echo '<tr><td align="center"><input type="submit" value="'._AB_UNBLOCKIP.'" /></td></tr>'."\n";
echo '<tr><td align="center">'._GOBACK.'</td></tr>'."\n";
echo '</table>'."\n";
echo '</form>'."\n";
CloseTable();
include("footer.php");

?>