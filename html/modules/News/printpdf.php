<?php
/**
 * @package dompdf
 * DOMPDF is a CSS 2.1 compliant HTML to PDF converter
 * @link    https://github.com/dompdf/dompdf
 * @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */
if (!defined('MODULE_FILE')) die('You can\'t access this file directly...');

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$options = $dompdf->getOptions();
$options->setDefaultFont('Courier');
$dompdf->setOptions($options);

$module_name = basename(dirname(__FILE__));

get_lang($module_name);

if (isset($_GET['id'])) {
	$id = intval($_GET['id']);
	require_once('mainfile.php');

global $db, $prefix, $nukeurl, $slogan, $sitename;

$result = $db->sql_query('SELECT catid, sid, aid, time, title, hometext, bodytext, informant, notes FROM '.$prefix.'_stories where sid=\''.$id.'\'');
$numrows = $db->sql_numrows($result);
$row = $db->sql_fetchrow($result);
$catid = intval($row['catid']);
$sid = stripslashes($row['sid']);
$aaid = stripslashes($row['aid']);
$time = $row['time'];
$title = stripslashes($row['title']);
$hometext = stripslashes($row['hometext']);
$bodytext = stripslashes($row['bodytext']);
$informant = stripslashes($row['informant']);
$notes = stripslashes($row['notes']);
$articleurl = $nukeurl.'/modules.php?name=News&file=article&sid='.$sid.'';
define('OUTPUT_FILE', $title.'-articles'.$sid.'.pdf');
if(empty($bodytext)) {
    $bodytext = $hometext.$notes;
} else {
    $bodytext = $hometext.$bodytext.$notes;
}
$output = $sitename.'<br/><br/>'.'Posted By '.$aaid.' '.$time.'<br/><br/>'.$title.'<br/>'.$bodytext.'<br/>Link: '.$articleurl;
$dompdf->loadHtml($output);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream(OUTPUT_FILE);
}else{
echo 'There was an error';
}
