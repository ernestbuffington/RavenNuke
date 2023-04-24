<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header("Location: ../../../".$admin_file.".php"); }
$pagetitle = "NukeSentinel(tm): Error Loading Functions";
include("header.php");
title($pagetitle);
OpenTable();
echo 'It appears that NukeSentinel(tm) has not been configured correctly.  The
most common cause is that you either have an error in the syntax that is
including includes/nukesentinel.php from your mainfile.php, or you have not
added the NukeSentinel(tm) code to your mainfile.php.  Details for including this
code are included in the download package in the <strong>Edits_For_Core_Files</strong> directory.';
CloseTable();
include("footer.php");

?>