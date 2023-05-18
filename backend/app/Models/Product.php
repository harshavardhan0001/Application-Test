<?php 
namespace App\Models;
use Helper;
use Respect\Validation\Validator as v;
class Product
{

    use Helper;
    private $csvFilePath = __DIR__.'/../../storage/data.csv';
    private $header = ['id','name','state','zip','amount','quantity','item'];
    
    public function getData()
    {   
        $data = $this->getCsvData();
        return $data;
    }

    public function addProduct($data,$request){
        if(count($data))
            $id = $data[count($data)-1]["id"] + 1;
        else {
            $id = 1;
        }
        $newRow = [];
        $newRow["id"] = $id;
        $newRow["name"] = $request["name"];
        $newRow["state"] = $request["state"];
        $newRow["zip"] = $request["zip"];
        $newRow["amount"] = $request["amount"];
        $newRow["quantity"] = $request["quantity"];
        $newRow["item"] = $request["item"];

        $data[] = array_values($newRow); // adds new product
        $this->writeToCsv(($data));
        return $data;
    }
    public function updateProduct($data,$index,$request){
        
        $data[$index] = $request; // update old product with new product
        $this->writeToCsv(($data));
        return $data;

    }
    public function deleteProduct($data,$index){
        
        array_splice($data, $index, 1); // delete's product by id
        $this->writeToCsv(($data));
        return $data;
       
    }

    public function validateProduct($request) {
        // Validate request parameters
        $validation = v::key('name', v::notEmpty()->alpha(' '))
            ->key('state', v::notEmpty()->alpha(' '))
            ->key('zip', v::allOf(v::intVal(), v::positive(),v::notEmpty(), v::digit(5)))
            ->key('amount', v::notEmpty()->regex('/^(?:[0-9]+(?:\.[0-9]{0,2})?)?$/'))
            ->key('quatity', v::allOf(v::intVal(), v::positive(),v::notEmpty()))
            ->key('item', v::alnum());

        $result = $validation->validate($request); // Validate the request data
        return $result;
    }
}