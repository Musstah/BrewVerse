<?php

$config = require dirPath('config/db.php');
$db = new Database($config);

$pastry = $db->query('SELECT * FROM brewverse.pastries LIMIT 6')->fetchAll();
echo json_encode($pastry);
