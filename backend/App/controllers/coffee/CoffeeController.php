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
     * @param array $params
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

        $requiredFields = [
            "name",
            "price",
            "description",
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newCoffeeData[$field]) || !Validation::string($newCoffeeData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            echo json_encode($errors);
        } else {

            // Create array with newCoffeData 
            $fields = [];
            foreach ($newCoffeeData as $field => $value) {
                $fields[] = $field;
            }
            // Implode takes an array and turns it into string
            $fields = implode(', ', $fields);

            $values = [];
            foreach ($newCoffeeData as $field => $value) {
                // Convert empty strings to null
                if ($value === '') {
                    $newCoffeeData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);



            $query = "INSERT INTO brewverse.coffee ({$fields}) VALUES ({$values})";
            $this->db->query($query, $newCoffeeData);

            echo json_encode([
                'success' => true,
                'message' => 'New coffee added successfully'
            ]);
        }
    }

    /**
     * Delete a coffee
     *
     * @param array $params
     * @return void
     */
    public function destroy($params)
    {
        $id = $params['id'];

        $params = [
            'id' => $id
        ];

        $coffee = $this->db->query("SELECT * FROM brewverse.coffee WHERE id = :id", $params)->fetch();

        if (!$coffee) {
            ErrorController::notFound('Coffee not found');
            return;
        }

        $this->db->query("DELETE FROM brewverse.coffee WHERE id = :id", $params);
        echo json_encode([
            'success' => true,
            'message' => 'Coffee deleted successfully'
        ]);
    }

    /**
     * Show the coffee edit form
     *
     * @param array $params
     * @return void
     */
    public function edit($params)
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
     * Update a coffee
     * 
     * @param array $params
     * @return void
     */
    public function update($params)
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

        $allowedFields = [
            "name",
            "price",
            "img",
            "description",
            "origin",
            "brew",
            "farmInfo"
        ];

        // This takes raw content from POSTMAN and turns it into valid array
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);
        $updateValues = [];

        $updateValues = array_intersect_key($data, array_flip($allowedFields));

        $updateValues = array_map('sanitize', $updateValues);

        inspectAndDie($updateValues);

        $requiredFields = [
            "name",
            "price",
            "description",
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($updateValues[$field]) || !Validation::string($updateValues[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }
        if (!empty($errors)) {
            echo json_encode($errors);
            exit;
        } else {
            // Submit to db
            $updateFields = [];
            foreach (array_keys($updateValues) as $field) {
                $updateFields[] = "{$field} = :{$field}";
            }
            $updateFields = implode(', ', $updateFields);

            $updateQuery = "UPDATE brewverse.coffee SET $updateFields WHERE id = :id";

            $updateValues['id'] = $id;
            $this->db->query($updateQuery, $updateValues);

            echo json_encode([
                'success' => true,
                'message' => 'Coffee editted successfully'
            ]);
        }
    }
}
