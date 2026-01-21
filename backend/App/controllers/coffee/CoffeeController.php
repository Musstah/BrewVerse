<?php

namespace App\Controllers\coffee;

use App\Controllers\ErrorController;
use Framework\Database;



class CoffeeController
{
    protected $db;
    public function __construct()
    {
        $config = require dirPath('config/db.php');
        $this->db = new Database($config);
    }


    /**
     * Show all coffees
     *
     * @return void
     */
    public function index()
    {

        $coffee = $this->db->query('SELECT * FROM brewverse.coffee')->fetchAll();
        echo json_encode($coffee);
    }

    /**
     * Show single coffee
     *
     * @return void
     */
    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];


        $coffee = $this->db->query('SELECT * FROM brewverse.coffee WHERE id = :id', $params)->fetch();

        // Check if item exists in DB
        if (!$coffee) {
            ErrorController::notFound('Coffee not not found in DB');
            return;
        }
        echo json_encode($coffee);
    }

    /**
     * Creates new coffee in DB
     *
     * @return void
     */
    public function create()
    {
        echo 'Create coffee';
    }
}
