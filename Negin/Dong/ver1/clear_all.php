<?php
require_once("func.php");

Query("TRUNCATE `contacts`");

Query("TRUNCATE `course`");

Query("TRUNCATE `courserequest`");

Query("TRUNCATE `log`");

Query("TRUNCATE `payments`");

Query("TRUNCATE `settings`");

Query("TRUNCATE `transactions`");

Query("TRUNCATE `users`");

Query("TRUNCATE `vote`");

setcookie("uid", "", time() - 2592000, "/");
