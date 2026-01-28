<?php

namespace App\Controllers\pastries;

use App\Controllers\ErrorController;
use Framework\Database;
use Framework\Validation;


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

    /**
     * Show single pastry
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


        $pastry = $this->db->query('SELECT * FROM brewverse.pastries WHERE id = :id', $params)->fetch();

        // Check if item exists in DB
        if (!$pastry) {
            ErrorController::notFound('Pastry not not found in DB');
            return;
        }
        echo json_encode($pastry);
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
            "ingredients",
        ];

        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);



        // Takes two arrays and returns a new array if key is in both arrays
        // Array_flip() - turns keys into values and values into keys
        $newPastryData = array_intersect_key($data, array_flip($allowedFields));


        $newPastryData = array_map('sanitize', $newPastryData);



        $requiredFields = [
            "name",
            "price",
            "description",
        ];

        $errors = [];

        foreach ($requiredFields as $field) {
            if (empty($newPastryData[$field]) || !Validation::string($newPastryData[$field])) {
                $errors[$field] = ucfirst($field) . ' is required';
            }
        }

        if (!empty($errors)) {
            echo json_encode($errors);
        } else {

            // Create array with newCoffeData 
            $fields = [];
            foreach ($newPastryData as $field => $value) {
                $fields[] = $field;
            }
            // Implode takes an array and turns it into string
            $fields = implode(', ', $fields);

            $values = [];
            foreach ($newPastryData as $field => $value) {
                // Convert empty strings to null
                if ($value === '') {
                    $newPastryData[$field] = null;
                }
                $values[] = ':' . $field;
            }
            $values = implode(', ', $values);



            $query = "INSERT INTO brewverse.pastries ({$fields}) VALUES ({$values})";
            $this->db->query($query, $newPastryData);

            echo json_encode([
                'success' => true,
                'message' => 'New pastry added successfully'
            ]);
        }
    }

    /**
     * Delete a pastry
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

        $pastry = $this->db->query("SELECT * FROM brewverse.pastries WHERE id = :id", $params)->fetch();

        if (!$pastry) {
            ErrorController::notFound('Pastry not found');
            return;
        }

        $this->db->query("DELETE FROM brewverse.pastries WHERE id = :id", $params);
        echo json_encode([
            'success' => true,
            'message' => 'Pastry deleted successfully'
        ]);
    }

    /**
     * Show the pastry edit form
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


        $pastry = $this->db->query('SELECT * FROM brewverse.pastries WHERE id = :id', $params)->fetch();

        // Check if item exists in DB
        if (!$pastry) {
            ErrorController::notFound('Pastry not not found in DB');
            return;
        }
        echo json_encode($pastry);
    }

    /**
     * Update a pastry
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

        $pastry = $this->db->query('SELECT * FROM brewverse.pastries WHERE id = :id', $params)->fetch();

        // Check if item exists in DB
        if (!$pastry) {
            ErrorController::notFound('Pastry not not found in DB');
            return;
        }

        $allowedFields = [
            "name",
            "price",
            "img",
            "description",
            "ingredients",
        ];

        // This takes raw content from POSTMAN and turns it into valid array
        $rawInput = file_get_contents('php://input');
        $data = json_decode($rawInput, true);
        $updateValues = [];

        $updateValues = array_intersect_key($data, array_flip($allowedFields));

        $updateValues = array_map('sanitize', $updateValues);


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

            $updateQuery = "UPDATE brewverse.pastries SET $updateFields WHERE id = :id";

            $updateValues['id'] = $id;
            $this->db->query($updateQuery, $updateValues);

            echo json_encode([
                'success' => true,
                'message' => 'Pastry editted successfully'
            ]);
        }
    }
}
