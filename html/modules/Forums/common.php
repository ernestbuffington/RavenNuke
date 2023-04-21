<?php
/***************************************************************************
 *                                common.php
 *                            -------------------
 *   begin                : Saturday, Feb 23, 2001
 *   copyright            : (C) 2001 The phpBB Group
 *   email                : support@phpbb.com
 *
 *   $Id: common.php,v 1.74.2.25 2006/05/26 17:46:59 grahamje Exp $
 *
 ***************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 * Applied rules: Ernest Allen Buffington (TheGhost) 04/21/2023 5:47 PM
 * WrapVariableVariableNameInCurlyBracesRector (https://www.php.net/manual/en/language.variables.variable.php)
 * WhileEachToForeachRector (https://wiki.php.net/rfc/deprecations_php_7_2#each)
 ***************************************************************************/

if ( !defined('IN_PHPBB') )
{
	die("Hacking attempt");
}

global $board_config;
// based on http://forum.mamboserver.com/showthread.php?t=26406 article
$url_denied = array(
	'/bin', '/usr', '/etc', '/boot', '/dev', '/perl', '/initrd', '/lost+found', '/mnt', '/proc', '/root', '/sbin', '/cgi-bin', '/tmp', '/var',
	'ps%20', 'wget%20', 'uname%20-a', '/chgrp', 'chgrp%20', '/chown', 'chown%20', '/chmod', 'chmod%20', 'md%20', 'mdir', 'rm%20', 'rmdir%20', 'mv%20', 'tftp%20', 'ftp%20', 'telnet%20', 'ls%20',
	'gcc%20-o', 'cc%20', 'cpp%20', 'g++%20', 'python%20', 'tclsh8%20', 'nasm%20', 'perl%20', 'traceroute%20', 'nc%20', 'nmap%20', '%20-display%20', 'lsof%20',
	'.conf', '.htgroup', '.htpasswd', '.htaccess', '.history', '.bash_history',
	'/rksh', '/bash', '/zsh', '/csh', '/tcsh', '/rsh', '/ksh', '/icat', 'document.domain(',
	'/....', '..../', 'cat%20', '/*%0a.pl',
	'/server-status', 'chunked', '/mod_gzip_status',
	'cmdd=', 'path=http://', 'exec', 'passthru', 'cmd', 'fopen', 'exit', 'fwrite',
	'<script', '/script>', '<?', '?>', 'javascript://', 'img src=',
	'phpbb_root_path=', 'sql=', 'delete%20', '%20delete', 'drop%20', '%20drop', 'insert into', 'select%20', '%20select', 'union%20', '%20union', 'union(',
	'chr%20', 'chr(', 'http_', '_http', 'php_', '_php', '_global', 'global_', 'global[', '_globals', 'globals_', 'globals[', '_server', 'server_', 'server[',
	'$_request', '$_get', '$request', '$get',
);
$_server = isset($_SERVER) && !empty($_SERVER) ? '_SERVER' : 'HTTP_SERVER_VARS';
$_env = isset($_ENV) && !empty($_ENV) ? '_ENV' : 'HTTP_ENV_VARS';
if ( ($url_request = !empty(${$_server}['QUERY_STRING']) ? ${$_server}['QUERY_STRING'] : (!empty(${$_env}['QUERY_STRING']) ? ${$_env}['QUERY_STRING'] : getenv('QUERY_STRING'))) )
{
	$url_request = preg_replace('/([\s]+)/', '%20', strtolower($url_request));
	$url_checked = preg_replace('/[\n\r]/', '', str_replace($url_denied, '', $url_request));
	if ( $url_request != $url_checked )
	{
		die('Hack attempt');
	}
}
unset($_server);
unset($_env);

// Protect against GLOBALS tricks
if (isset($HTTP_POST_VARS['GLOBALS']) || isset($HTTP_POST_FILES['GLOBALS']) || isset($HTTP_GET_VARS['GLOBALS']) || isset($HTTP_COOKIE_VARS['GLOBALS']))
{
	die("Hacking attempt");
}

// Protect against HTTP_SESSION_VARS tricks
if (isset($HTTP_SESSION_VARS) && !is_array($HTTP_SESSION_VARS))
{
	die("Hacking attempt");
}

if (ini_get('register_globals') == '1' || strtolower(ini_get('register_globals')) == 'on')
{
    // PHP4+ path
    $not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path', 'name', 'admin', 'nukeuser', 'user', 'no_page_header', 'cookie', 'db', 'prefix', 'cancel');
    //$not_unset = array('HTTP_GET_VARS', 'HTTP_POST_VARS', 'HTTP_COOKIE_VARS', 'HTTP_SERVER_VARS', 'HTTP_SESSION_VARS', 'HTTP_ENV_VARS', 'HTTP_POST_FILES', 'phpEx', 'phpbb_root_path');

    // Not only will array_merge give a warning if a parameter
    // is not an array, it will actually fail. So we check if
    // HTTP_SESSION_VARS has been initialised.
    if (!isset($HTTP_SESSION_VARS) || !is_array($HTTP_SESSION_VARS))
    {
        $HTTP_SESSION_VARS = array();
    }

    // Merge all into one extremely huge array; unset
    // this later
    $input = array_merge($HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_COOKIE_VARS, $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_ENV_VARS, $HTTP_POST_FILES);

    unset($input['input']);
    unset($input['not_unset']);

    foreach (array_keys($input) as $var) {
      if (!in_array($var, $not_unset))
     {
       unset(${$var});
     }
    }
    unset($input);
}

if ($_POST != $HTTP_POST_VARS) {
    $HTTP_POST_VARS =& $_POST;
    $HTTP_GET_VARS =& $_GET;
    $HTTP_COOKIE_VARS =& $_COOKIE;
}

//
// Define some basic configuration arrays this also prevents
// malicious rewriting of language and otherarray values via
// URI params
//
$board_config = array();
$userdata = array();
$theme = array();
$images = array();
$lang = array();
$nav_links = array();
$dss_seeded = false;
$gen_simple_header = FALSE;
$phpEx = 'php';
include_once($phpbb_root_path . 'config.'.$phpEx);

if( !defined("PHPBB_INSTALLED") )
{
        header("Location: modules.php?name=Forums&file=install");
	exit;
}

if (defined('FORUM_ADMIN')) {
    //include("../../../db/db.php");
    include_once("../includes/constants.php");
    include_once("../includes/template.php");
    include_once("../includes/sessions.php");
    include_once("../includes/auth.php");
    include_once("../includes/functions.php");
} else {
    include_once("modules/Forums/includes/constants.php");
    include_once("modules/Forums/includes/template.php");
    include_once("modules/Forums/includes/sessions.php");
    include_once("modules/Forums/includes/auth.php");
    include_once("modules/Forums/includes/functions.php");
    include_once("db/db.php");
}
// We do not need this any longer, unset for safety purposes
unset($dbpasswd);

//
// Obtain and encode users IP
//
// I'm removing HTTP_X_FORWARDED_FOR ... this may well cause other problems such as
// private range IP's appearing instead of the guilty routable IP, tough, don't
// even bother complaining ... go scream and shout at the idiots out there who feel
// "clever" is doing harm rather than good ... karma is a great thing ... :)
//
$client_ip = ( !empty($HTTP_SERVER_VARS['REMOTE_ADDR']) ) ? $HTTP_SERVER_VARS['REMOTE_ADDR'] : ( ( !empty($HTTP_ENV_VARS['REMOTE_ADDR']) ) ? $HTTP_ENV_VARS['REMOTE_ADDR'] : getenv('REMOTE_ADDR') );
$user_ip = encode_ip($client_ip);

//
// Setup forum wide options, if this fails
// then we output a CRITICAL_ERROR since
// basic forum information is not available
//
$sql = "SELECT *
	FROM " . CONFIG_TABLE;
if( !($result = $db->sql_query($sql)) )
{
	message_die(CRITICAL_ERROR, "Could not query config information", "", __LINE__, __FILE__, $sql);
}

while ( $row = $db->sql_fetchrow($result) )
{
	$board_config[$row['config_name']] = $row['config_value'];
}
include($phpbb_root_path . 'attach_mod/attachment_mod.'.$phpEx);


//
// Show 'Board is disabled' message if needed.
//
if( $board_config['board_disable'] && !defined("IN_ADMIN") && !defined("IN_LOGIN") )
{
	message_die(GENERAL_MESSAGE, 'Board_disable', 'Information');
}

?>
