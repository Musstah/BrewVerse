<?php

use Framework\Database;

$config = require dirPath('config/db.php');
$db = new Database($config);

$pastries = $db->query('SELECT * FROM brewverse.pastries LIMIT 6')->fetchAll();
echo json_encode($pastries);
