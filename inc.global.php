<?php

require_once 'inc.config.php';

require_once 'lib/templatepower/class.TemplatePower.inc.php';

// DATABASES:
// NOTE: All settings are defined as constants in inc.config.php

// 1: Create a link to the MySQL server and store the MySQL link identifier in a variable named $DB
$DB = mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("Unable to connect to DB");
// 2: Select the MySQL database to use as defined by DB_NAME
mysql_select_db(DB_NAME,  $DB) or die("Unable to select Database : ".DB_NAME);


?>