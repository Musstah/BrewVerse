<?php

namespace App\Controllers\coffee;

use App\Controllers\ErrorController;
use Framework\Database;
use Framework\Validation;



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
     * Store new coffee in DB
     *
     * @return void
     */
    public function store()
    {
        $allowedFields = [
            "name",
            "price",
            "img",
            "description",
            "origin",
            "brew",
            "farmInfo"
        ];

        // Takes two arrays and returns a new array if key is in both arrays
        // Array_flip() - turns keys into values and values into keys
        $newCoffeeData = array_intersect_key($_POST, array_flip($allowedFields));

        $newCoffeeData = array_map('sanitize', $newCoffeeData);

        inspectAndDie($newCoffeeData);
    }
}
