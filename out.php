<?php
require_once('common.php');

// MySQL stuff
$conn = mysql_connect($db['host'], $db['user'], $db['pass']);
mysql_select_db($db['db']);
// Log access
mysql_query("INSERT INTO accessApp (ipaddr, user, time, appid, ver) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', '" . mysql_real_escape_string($_GET['user']) . "', NOW(), '" . mysql_real_escape_string($_GET['appid']) . "', '" . mysql_real_escape_string($_GET['ver']) . "')");

// Authenticate
$query = mysql_query("SELECT * FROM auth WHERE valid=1 AND user='" . mysql_real_escape_string($_GET['user']) . "' AND token=md5('" . $_GET['token'] . "')");
if (mysql_num_rows($query) !== 1) exit(); // if they aren't a real user -- or have incorrect credentials -- kill the output

// Check if the person is allowed to download the app
$query = mysql_query("SELECT * FROM pkgs WHERE appid='" . mysql_real_escape_string($_GET['appid']) . "' AND ver='" . mysql_real_escape_string($_GET['ver']) . "' AND arch='" . mysql_real_escape_string($_GET['arch']) . "' AND permit LIKE '%" . mysql_real_escape_string($_GET['user']) . "%'");
if (mysql_num_rows($query) !== 1) exit(); // if not, kill the output

// get the file so we can send it to the user
$row = mysql_fetch_array($query);

$filename = $_GET['appid'] . "_" . $_GET['ver'] . "_" . $_GET['arch'] . ".ipk";	// formats as com.domain.app_1.0.0_all.ipk

header('Content-Description: File Transfer');
header("X-Powered-By: Appstuh Repo 1.0");
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header("Content-type: application/octet-stream");
header('Content-Disposition: attachment; filename="' . $filename . '"'); 
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . filesize(BINARY_DIR . $row['bin']));
ob_clean();
flush();

// output the binary file to the download client
readfile(BINARY_DIR . $row['bin']);
?>