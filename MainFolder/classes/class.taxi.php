<?php
class taxi{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='user';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_taxi($plate,$model,$type,$capacity,$transmission,$status){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
		  [$plate,$model,$type,$capacity,$transmission,$status]
		];

		$stmt = $this->conn->prepare("INSERT INTO tbl_taxi(taxi_plate, taxi_model, taxi_type, taxi_capacity, taxi_transmission, taxi_status) VALUES (?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$id= $this->conn->lastInsertId();
			$this->conn->commit();
			
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
	
		return $id;
	
		}


	public function list_taxi(){
		$sql="SELECT * FROM tbl_taxi";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}
	public function list_driver(){
		$sql="SELECT * FROM tbl_driver";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}


	function get_taxi_id($id){
		$sql="SELECT taxi_id FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxiid = $q->fetchColumn();
		return $taxiid;
	}
	function get_taxi_plate($id){
		$sql="SELECT taxi_plate FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_plate = $q->fetchColumn();
		return $taxi_plate;
	}
	function get_taxi_model_avail($id){
		$sql="SELECT taxi_model FROM tbl_taxi WHERE taxi_status = 'Available'";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_model_avail = $q->fetchColumn();
		return $taxi_model_avail;
	}	
	function get_taxi_model($id){
		$sql="SELECT taxi_model FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_model = $q->fetchColumn();
		return $taxi_model;
	}																					
	function get_taxi_type($taxitype){
		$sql="SELECT taxi_type FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_type = $q->fetchColumn();
		return $taxi_type;
	}
	function get_taxi_capacity($taxicapacity){
		$sql="SELECT taxi_capacity FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_capacity = $q->fetchColumn();
		return $taxi_capacity;
	}
	function get_taxi_transmission($taxitransmission){
		$sql="SELECT taxi_transmission FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_transmission = $q->fetchColumn();
		return $taxi_transmission;
	}
	function get_taxi_status($taxistatus){
		$sql="SELECT taxi_status FROM tbl_taxi WHERE taxi_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$taxi_status = $q->fetchColumn();
		return $taxi_status;
	}
	public function list_receive_items($id){
		$sql="SELECT * FROM tbl_receive_items WHERE rec_id=$id";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		if(empty($data)){
		   return false;
		}else{
			return $data;	
		}
	}

	public function new_receive_item($recid,$prodid,$qty){
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
		$data = [
			[$recid,$prodid,$qty],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_receive_items(rec_id, prod_id, rec_qty) VALUES (?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			//$id= $this->conn->lastInsertId();
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
		return true;
	}

	public function save_receive_items($id){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
		$status = 1;
		$sql = "UPDATE tbl_receive SET rec_saved=:rec_saved WHERE rec_id=$id";

		$q = $this->conn->prepare($sql);
		$q->execute(array(':rec_saved'=>$status));
		return true;
	}


	public function save_to_inventory($id){
		$sql="SELECT * FROM tbl_receive_items WHERE rec_id=$id";
		$q = $this->conn->query($sql) or die("failed!");
		while($r = $q->fetch(PDO::FETCH_ASSOC)){
		$data[]=$r;
		}
		$stmt = $this->conn->prepare("INSERT INTO tbl_product_inv(rec_id, prod_id, prod_qty) VALUES (?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row){
				extract($row);
				$stmt->execute(array($rec_id,$prod_id,$rec_qty));
			}
			//$id= $this->conn->lastInsertId();
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
		return true;
	}
}
?>