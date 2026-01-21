<?php

namespace App\Controllers\pastries;

use Framework\Database;

class PastryController
{
    protected $db;
    public function __construct()
    {
        $config = require dirPath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {

        $pastries = $this->db->query('SELECT * FROM brewverse.pastries')->fetchAll();
        echo json_encode($pastries);
    }
}
