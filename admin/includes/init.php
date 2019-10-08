<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www'. DS . 'krojac' . DS . 'webschool');

defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT . DS . 'admin' . DS . 'includes');

/* print_r(SITE_ROOT);
echo "<br>";
print_r(INCLUDES_PATH);
echo "<br>";

echo "<a href="."'".SITE_ROOT."'".">Web adress<a/>";
echo "<br>";
echo "<a href="."'".INCLUDES_PATH."'".">Admin<a/>"; */

require_once("functions.php");
require_once("Database.php");
require_once("DB_object.php");
require_once("User.php");
require_once("Photo.php");
require_once("Session.php");

