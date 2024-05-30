
<?php

define('DB_NAME', "bahar");
/** MySQL database username */

define('DB_USER', "root");

/** MySQL database password */

define('DB_PASSWORD', "");

/** MySQL hostname */

define('DB_HOST', "localhost");

/** Database Charset to use in creating database tables. */

define('DB_CHARSET', 'utf8mb4');

//$con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}

