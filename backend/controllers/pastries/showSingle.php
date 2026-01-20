<?php

$config = require dirPath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';

$params = [
    'id' => $id
];



$pastry = $db->query('SELECT * FROM brewverse.pastries WHERE id =:id', $params)->fetch();
echo json_encode($pastry);

// inspect($coffee);
