<?php

$config = require dirPath('config/db.php');
$db = new Database($config);

$coffee = $db->query('SELECT * FROM coffee LIMIT 6')->fetchAll();


inspect($coffee);
