
<?php

define('DB_NAME', "wukxwqmk_bahar");
/** MySQL database username */

define('DB_USER', "wukxwqmk_admin");

/** MySQL database password */

define('DB_PASSWORD', "!&b@[7%358Sb");

/** MySQL hostname */

define('DB_HOST', "localhost");

/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8mb4');

$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}

