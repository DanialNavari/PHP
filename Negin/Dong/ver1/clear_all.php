<?php
require_once("func.php");

Query("DELETE * FROM `contacts` WHERE 1");
Query("DELETE * FROM `course` WHERE 1");
Query("DELETE * FROM `courserequest` WHERE 1");
Query("DELETE * FROM `log` WHERE 1");
Query("DELETE * FROM `payments` WHERE 1");
Query("DELETE * FROM `settings` WHERE 1");
Query("DELETE * FROM `transactions` WHERE 1");
Query("DELETE * FROM `users` WHERE 1");
Query("DELETE * FROM `vote` WHERE 1");
