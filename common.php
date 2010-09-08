<?php
error_reporting(0);			// prevent it from outputting errors
/*
	Name: Common file
	This file stores common variables, such as your MySQL database credentials, as well as common function calls
	Copyright: Appstuh
	License: AGPLv3
*/

// MySQL DB info
$db = array(
	'db' => 'repo',			// your MySQL database name
	'user' => 'repo',		// your MySQL username
	'pass' => 'YOUR_PASS',	// your MySQL password
	'host' => 'localhost'	// your MySQL hostname
);

// File info
define(BINARY_DIR, '../');	// the relative location to your file binaries -- recommended to keep out of web accessible areas

// Repo info
define(REPO_NAME, 'Your Company Closed Beta Extranet');	// the name of the repo as it shows up in Preware