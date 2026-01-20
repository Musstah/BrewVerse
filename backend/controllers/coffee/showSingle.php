<?php

$config = require dirPath('config/db.php');
$db = new Database($config);

$id = $_GET['id'] ?? '';

$params = [
    'id' => $id
];


$coffee = $db->query('SELECT * FROM brewverse.coffee WHERE id = :id', $params)->fetch();
echo json_encode($coffee);

// inspect($coffee);
