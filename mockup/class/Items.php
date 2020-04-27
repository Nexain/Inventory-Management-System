<?php
class Items{   
    
    private $itemsTable = "warehouse_log";      
    public $TAG_ID;
    public $PRODUCT_ID;
    public $WH_ID;
    public $DATE_IN;
    public $DATE_OUT;   
    private $conn;
	
    public function __construct($db){
        $this->conn = $db;
    }	
	
	function read(){	
		if($this->TAG_ID) {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable." WHERE TAG_ID = ?");
			$stmt->bind_param("i", $this->TAG_ID);					
		} else {
			$stmt = $this->conn->prepare("SELECT * FROM ".$this->itemsTable);		
		}		
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}
	
	function create(){
		
		$stmt = $this->conn->prepare("
			INSERT INTO ".$this->itemsTable."(`TAG_ID`, `PRODUCT_ID`, `WH_ID`)
			VALUES(?,?,?)");
		
		$this->TAG_ID = htmlspecialchars(strip_tags($this->TAG_ID));
		$this->PRODUCT_ID = htmlspecialchars(strip_tags($this->PRODUCT_ID));
		$this->WH_ID = htmlspecialchars(strip_tags($this->WH_ID));
		
		$stmt->bind_param("sss", $this->TAG_ID, $this->PRODUCT_ID, $this->WH_ID);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
		
	function update(){
	 
		$stmt = $this->conn->prepare("
			UPDATE ".$this->itemsTable." 
			SET PRODUCT_ID = ?, WH_ID = ?
			WHERE TAG_ID = ?");
	 
		$this->PRODUCT_ID = htmlspecialchars(strip_tags($this->PRODUCT_ID));
		$this->WH_ID = htmlspecialchars(strip_tags($this->WH_ID));
		$this->TAG_ID = htmlspecialchars(strip_tags($this->TAG_ID));	
	 
		$stmt->bind_param("sss", $this->PRODUCT_ID, $this->WH_ID, $this->TAG_ID);
		
		if($stmt->execute()){
			return true;
		}
	 
		return false;
	}
	
	function delete(){
		
		$stmt = $this->conn->prepare("
			DELETE FROM ".$this->itemsTable." 
			WHERE TAG_ID = ?");
			
		$this->TAG_ID = htmlspecialchars(strip_tags($this->TAG_ID));
	 
		$stmt->bind_param("i", $this->TAG_ID);
	 
		if($stmt->execute()){
			return true;
		}
	 
		return false;		 
	}
}
?>