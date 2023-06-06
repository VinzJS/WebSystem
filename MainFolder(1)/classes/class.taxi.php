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
	/* Inserting data to the table */
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

		public function update_taxi($tid,$plate,$model,$type,$capacity,$transmission,$status) {
			$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
			$NOW = $NOW->format('Y-m-d H:i:s');
			$sql = "UPDATE tbl_taxi SET taxi_plate = :taxi_plate, taxi_model = :taxi_model, taxi_type = :taxi_type, taxi_capacity = :taxi_capacity, taxi_transmission = :taxi_transmission, taxi_status = :taxi_status WHERE taxi_id = :taxi_id";

			$q = $this->conn->prepare($sql);
			$q->execute(array(':taxi_id' => $tid, ':taxi_plate' => $plate, ':taxi_model' => $model, ':taxi_type' => $type, ':taxi_capacity' => $capacity, ':taxi_transmission' => $transmission, ':taxi_status' => $status));
			return true;
		}

		public function delete_taxi($taxi_id) {
			$sql = "DELETE FROM tbl_taxi WHERE taxi_id = :taxi_id";
			$q = $this->conn->prepare($sql);
			$q->execute(array(':taxi_id' => $taxi_id));
			return true;
		}

		public function list_taxi_search($keyword){
		
			//$keyword = "%".$keyword."%";
	
			$q = $this->conn->prepare("SELECT * FROM tbl_taxi WHERE taxi_plate LIKE ?");
			$q->bindValue(1, "%$keyword%", PDO::PARAM_STR);
			$q->execute();
	
			while($r = $q->fetch(PDO::FETCH_ASSOC)){
			$data[]= $r;
			}
			if(empty($data)){
			   return false;
			}else{
				return $data;	
			}
		}

/* Lists the contents of the table */
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

/* Lists the contents of the specific column*/
	function get_taxi_id($plate){
		$sql="SELECT taxi_id FROM tbl_taxi WHERE taxi_plate = :plate";	
		$q = $this->conn->prepare($sql);
		$q->execute(['plate' => $plate]);
		$tid = $q->fetchColumn();
		return $tid;
	}
	function get_taxi_plate($id){
		$sql="SELECT taxi_plate FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_plate = $q->fetchColumn();
		return $taxi_plate;
	}
	function get_taxi_model_avail($id){
		$sql="SELECT taxi_model FROM tbl_taxi WHERE taxi_status = 'Available'";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_model_avail = $q->fetchColumn();
		return $taxi_model_avail;
	}	
	function get_taxi_model($id){
		$sql="SELECT taxi_model FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_model = $q->fetchColumn();
		return $taxi_model;
	}																					
	function get_taxi_type($id){
		$sql="SELECT taxi_type FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_type = $q->fetchColumn();
		return $taxi_type;
	}
	function get_taxi_capacity($id){
		$sql="SELECT taxi_capacity FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_capacity = $q->fetchColumn();
		return $taxi_capacity;
	}
	function get_taxi_transmission($id){
		$sql="SELECT taxi_transmission FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
		$taxi_transmission = $q->fetchColumn();
		return $taxi_transmission;
	}
	function get_taxi_status($taxistatus){
		$sql="SELECT taxi_status FROM tbl_taxi WHERE taxi_id = :taxid";	
		$q = $this->conn->prepare($sql);
		$q->execute(['taxid' => $id]);
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

}
?>