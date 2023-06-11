<?php 
// use Respect\Validation\Validator;
require_once __DIR__ . '/../Constants/Helper.php';
class Product
{

    use Helper;
    private $header = ['id','name','state','zip','amount','quantity','item'];
    
    public function getData()
    {   
        $data = $this->getCsvData();
        return $data;
    }

    public function addProduct($data,$request){
        // If no data in file, sets id to 1
        if(isset($request['id']) && $request['id'] != '') {
            $id = $request['id'];
        } else {
            $id = count($data) == 0 ? 1 : ($data[count($data)-1]["id"] + 1);
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
        // $name = Validator::notEmpty()->alpha(' ')->Validatoralidate($request['name']);
        // if(!$name) {
        //     return ['Invalid field value for name.'];
        // }
        // $quantity = v::allOf(v::intVal(), v::positive(),v::notEmpty())->validate($request['quantity']);
        // if(!$quantity) {
        //     return ['Invalid field value for quantity.'];
        // }
        // $state = v::notEmpty()->alpha(' ')->validate($request['state']);
        // if(!$state) {
        //     return ['Invalid field value for state.'];
        // }
        // $amount = v::notEmpty()->regex('/^(?:[0-9]+(?:\.[0-9]{0,2})?)?$/')->validate($request['amount']);
        // if(!$amount) {
        //     return ['Invalid field value for amount.'];
        // }
        // if(isset($request['item'])) {

        //     $item = v::optional(v::alnum())->validate($request['item']);
        //     if(!$item) {
        //         return ['Invalid field value for item.'];
        //     }
        // }
        // if(isset($request['zip'])) {
        //     $zip = v::optional(v::length(5,5))->validate($request['zip']);
        //     if(!$zip) {
        //         return ['Invalid field value for zip.'];
        //     }
        // }
        return [];
    }
}