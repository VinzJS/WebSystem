<?php
class driver{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='user';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	/* Inserting data to the table */
	public function new_driver($fname,$lname,$dob,$age,$gender,$exp){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
		  [$fname,$lname,$dob,$age,$gender,$exp]
		];

		$stmt = $this->conn->prepare("INSERT INTO tbl_driver(dr_first, dr_last, dr_dob, dr_age, dr_gender, dr_exp) VALUES (?,?,?,?,?,?)");
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

		public function delete_driver($driver_id) {
			$sql = "DELETE FROM tbl_driver WHERE driver_id = :driver_id";
			$q = $this->conn->prepare($sql);
			$q->execute(array(':driver_id' => $driver_id));
			return true;
		}


		public function update_driver($rid,$fname,$lname,$dob,$age,$gender,$exp) {
			$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
			$NOW = $NOW->format('Y-m-d H:i:s');
			$sql = "UPDATE tbl_driver SET dr_first = :dr_first, dr_last = :dr_last, dr_dob = :dr_dob, dr_age = :dr_age, dr_gender = :dr_gender, dr_exp = :dr_exp WHERE driver_id = :driver_id";

			$q = $this->conn->prepare($sql);
			$q->execute(array(':driver_id' => $rid, ':dr_first' => $fname, ':dr_last' => $lname, ':dr_dob' => $dob, ':dr_age' => $age, ':dr_gender' => $gender, ':dr_exp' => $exp));
			return true;
		}

		public function list_driver_search($keyword){
		
			//$keyword = "%".$keyword."%";
	
			$q = $this->conn->prepare("SELECT * FROM tbl_driver WHERE dr_first LIKE ?");
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

/* Lists the data of the specific column */
function get_driver_id($lname){
	$sql="SELECT driver_id FROM tbl_driver WHERE dr_last = :lname";    
	$q = $this->conn->prepare($sql);
	$q->execute(['lname' => $lname]);
	$driverid = $q->fetchColumn();
	return $driverid ? $driverid : null; // return null if user_id is not found
}
	function get_lname($id){
		$sql="SELECT dr_last FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_last = $q->fetchColumn();
		return $dr_last;
	}
	function get_fname($id){
		$sql="SELECT dr_first FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_first = $q->fetchColumn();
		return $dr_first;
	}
	function get_dob($id){
		$sql="SELECT dr_dob FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_dob = $q->fetchColumn();
		return $dr_dob;
	}
	function get_age($id){
		$sql="SELECT dr_age FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_age = $q->fetchColumn();
		return $dr_age;
	}
	function get_gender($id){
		$sql="SELECT dr_gender FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_gender = $q->fetchColumn();
		return $dr_gender;
	}
	function get_exp($id){
		$sql="SELECT dr_exp FROM tbl_driver WHERE driver_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$dr_exp = $q->fetchColumn();
		return $dr_exp;
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