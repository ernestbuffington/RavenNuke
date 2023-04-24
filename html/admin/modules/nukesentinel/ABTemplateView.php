<?php

/********************************************************************/
/* NukeSentinel™                                                    */
/* By: NukeScripts(tm) (https://www.nukescripts.coders.exchange)    */
/* Copyright © 2000-2023 by NukeScripts™                            */
/* See CREDITS.txt for ALL contributors                             */
/********************************************************************/

if(!defined('NUKESENTINEL_ADMIN')) { header('Location: ../../../' . $admin_file . '.php'); }
  $display_page = abview_template($template);
  $display_page = str_ireplace('</body>', '<hr noshade="noshade" />' . "\n" . '<div align="right">' . _AB_NUKESENTINEL . '</div>' . "\n" . '</body>', $display_page);
  die($display_page);

?>