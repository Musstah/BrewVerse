<?php

namespace App\Controllers\orders;

use App\Controllers\ErrorController;
use Framework\Database;
use Framework\Validation;



class OrdersController
{
    protected $db;
    public function __construct()
    {
        $config = require dirPath('config/db.php');
        $this->db = new Database($config);
    }


    /**
     * Show all orderss
     *
     * @return void
     */
    public function index()
    {
        $orders = $this->db->query('SELECT * FROM brewverse.orders')->fetchAll();
        echo json_encode($orders);
    }
}
