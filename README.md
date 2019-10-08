1. Open project folder. Go to admin/includes/init.php

2. Change constant SITE_ROOT ->
defined('SITE_ROOT') ? null : define('SITE_ROOT', 'C:' . DS . 'wamp64' . DS . 'www'. DS . 'krojac' . DS . 'webschool');

3. Create database web_school.

4. Import webschool/web_school.sql
