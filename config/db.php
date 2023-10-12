<?php

define('DSN', 'mysql:host=localhost;dbname=dbname;');
define('USER', 'user');
define('PASSWORD', 'pass');

$pdo = new PDO(DSN, USER, PASSWORD);
