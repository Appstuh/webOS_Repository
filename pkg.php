<?php
require_once('common.php');

// MySQL stuff
$conn = mysql_connect($db['host'], $db['user'], $db['pass']);
mysql_select_db($db['db']);
// Log access
mysql_query("INSERT INTO access (ipaddr, user, time) VALUES ('" . $_SERVER['REMOTE_ADDR'] . "', '" . mysql_real_escape_string($_GET['user']) . "', NOW())");

// Authenticate
$query = mysql_query("SELECT * FROM auth WHERE valid=1 AND user='" . mysql_real_escape_string($_GET['user']) . "' AND token=md5('" . $_GET['token'] . "')");
if (mysql_num_rows($query) !== 1) exit(); // if they aren't a real user -- or have incorrect credentials -- kill the output

// Get the packages this user is allowed to get
$query = mysql_query("SELECT * FROM pkgs WHERE permit LIKE '%" . mysql_real_escape_string($_GET['user']) . "%'");

$text = "";

while ($row = mysql_fetch_array($query)) { // each package (app)
	$filename = $row['appid'] . "_" . $row['ver'] . "_" . $row['arch'] . ".ipk";
	$text .= "Package: " . $row['appid'] . "\n";
	$text .= "Version: " .  $row['ver'] . "\n";
	$text .= "Section: " .  $row['section'] . "\n";
	$text .= "Architecture: " .  $row['arch'] . "\n";
	$text .= "Maintainer: " .  $row['maintainer'] . "\n";
	$text .= "Size: " .  filesize("../" . $row['bin']) . "\n";
	$text .= "Source: { \"LastUpdated\":\"" . $row['updated'] . "\", \"Title\": \"" . $row['title'] . "\", \"FullDescription\": \"" . $row['desc'] . "\", \"Type\":\"Application\", \"Category\":\"" .  $row['section'] . "\", \"Feed\": \"" . REPO_NAME . "\" }\n";
	$text .= "Filename: " .  $filename . "\n";
	$text .= "Description: " .  $row['title'] . "\n";
	$text .= "\n\n";
}

// Output the entire "Packages" file that works with Preware and WebOS Quick Install
echo $text;
mysql_close($conn);
?>