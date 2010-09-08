README:

1) Create your MySQL database
2) Import the "data.sql" file to the database
3) Edit the "common.php" file to configure (MySQL DB settings, the directory where you store binaries, etc.)


Recommendations:

Apache -- if you do not use Apache, you must build your own redirect file (i.e. what makes Packages go to pkg.php)
host with phpMyAdmin -- allows for easier management of the repo's database


Requirements:

PHP - tested on 5.2.13 and 5.3.0
MySQL - tested on 5.0.91 and 5.1.45

----------------
To add authenticated users:

1) Go to phpMyAdmin
2) Open "auth" table
3) Click on "Insert" to add a user, ensure to hash the 'token' field is MD5 hashed (also ensure you keep a plaintext copy of the tokens on your computer)

NOTE: Do not make any username that has another username in it (i.e. do not make 'johndoe' if the user 'john' already exists)

Example:
	id		- automatically generated number -- do not enter anything
	user	- the username
	token	- the password -- SELECT MD5 from the dropdown
	valid	- two choices: 0 or 1 (0 = false, 1 = true)

----------------
To add packages

1) Go to phpMyAdmin
2) Open "pkgs" table
3) Click on "Insert"

Example:
	appid	- your application id
	ver		- the current version number
	section	- where it is labeled in Preware/Quick Install
	arch	- the architecture (currently enabled: all, armv7, armv6, i686)
	maintainer	- what shows up as maintainer in Preware/Quick Install
	desc	- the description of the application as it shows up in Preware
	title	- the name as it will show up in Preware/Quick Install
	updated - the UNIX timestamp when you last updated the app -- you must set this -- it is what shows up as "Last Updated" in Preware
	bin		- the name of the binary (i.e. the IPK)
	permit	- a list of authorized users -- may be separated in any way you wish, be it space, semi colon, comma, etc.
	

Note, you can NOT have two apps by the same app id in the "pkg" table. This is by design.

----------------
To check who has accessed the feeds or packages -- for security:
1) Open phpMyAdmin
2) Open the "access" table to view access to the packages list OR "accessApp" to view the downloading of applications
----------------
How to revoke all access:
1) Open phpMyAdmin
2) Open the "auth" table and change "valid" to 0 for the user

----------------
How to revoke access to an app:
1) Open phpMyAdmin
2) Open the "pkgs" table and remove the username from the package row's "permit" field

----------------
How to add in Preware:
http://your.domain.com/path/to/repo/{username}/{token}		(i.e. http://repo.domain.com/bob/histoken)

----------------
How to add in webOS Quick Install:
http://your.domain.com/path/to/repo/{username}/{token}/Packages		(i.e. http://repo.domain.com/bob/histoken/Packages)

----------------
----------------
----------------
If you have any questions, contact us:		contact (-at-) appstuh (-dot-) com