<?php

$config = require dirPath('config/db.php');
$db = new Database($config);

$pastry = $db->query('SELECT * FROM pastries LIMIT 6')->fetchAll();


inspect($pastry);
