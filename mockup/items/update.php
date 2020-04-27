<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Items.php';
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Items($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->TAG_ID) && !empty($data->PRODUCT_ID) && 
!empty($data->WH_ID)){ 
	
	$items->PRODUCT_ID = $data->PRODUCT_ID;
    $items->WH_ID = $data->WH_ID;
	$items->TAG_ID = $data->TAG_ID; 
	
	if($items->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Item was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update items."));
	}
	
} else {
	http_response_code(400);    
    echo json_encode(array("message" => "Unable to update items. Data is incomplete."));
}
?>