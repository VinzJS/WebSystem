<?php
class customer{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='user';
	private $conn;
	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	/* Inserting data to the table */
	public function new_customer($customer_first,$customer_last,$customer_phone,$customer_address){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
		  [$customer_first,$customer_last,$customer_phone,$customer_address]
		];

		$stmt = $this->conn->prepare("INSERT INTO tbl_customer(customer_first, customer_last,  customer_phone, customer_add) VALUES (?,?,?,?)");
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

		public function delete_customer($customer_id) {
			$sql = "DELETE FROM tbl_customer WHERE customer_id = :customer_id";
			$q = $this->conn->prepare($sql);
			$q->execute(array(':customer_id' => $customer_id));
			return true;
		}

		public function list_customer_search($keyword){
		
			//$keyword = "%".$keyword."%";
	
			$q = $this->conn->prepare("SELECT * FROM tbl_customer WHERE customer_first LIKE ?");
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

		public function update_customer($customer_id,$customer_first,$customer_last,$customer_phone,$customer_address) {
			if($user_access =! "Staff") {
				return false;
			}
			$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
			$NOW = $NOW->format('Y-m-d H:i:s');
			$sql = "UPDATE tbl_customer SET customer_first = :customer_first, customer_last = :customer_last, customer_phone = :customer_phone, customer_add = :customer_add WHERE customer_id = :customer_id";
			$q = $this->conn->prepare($sql);
			$q->execute(array(':customer_id' => $customer_id, ':customer_first' => $customer_first, ':customer_last' => $customer_last, ':customer_phone' => $customer_phone, ':customer_add' => $customer_address));
			return true;
		}

/* Lists the contents of the table */
	public function list_customer(){
		$sql="SELECT * FROM tbl_customer";
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
/* Lists the specific column*/
	function get_customer_id($cfirst){
		$sql="SELECT customer_id FROM tbl_customer WHERE customer_first = :cfirst";	
		$q = $this->conn->prepare($sql);
		$q->execute(['cfirst' => $cfirst]);
		$customer_id = $q->fetchColumn();
		return $customer_id;
	}
	function get_customer_first($id){
		$sql="SELECT customer_first FROM tbl_customer WHERE customer_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$cfirst = $q->fetchColumn();
		return $cfirst;
	}
	function get_customer_last($id){
		$sql="SELECT customer_last FROM tbl_customer WHERE customer_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$clast = $q->fetchColumn();
		return $clast;
	}
	function get_customer_phone($id){
		$sql="SELECT customer_phone FROM tbl_customer WHERE customer_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$customer_phone = $q->fetchColumn();
		return $customer_phone;
	}																					
	function get_customer_add($id){
		$sql="SELECT customer_add FROM tbl_customer WHERE customer_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$customer_add = $q->fetchColumn();
		return $customer_add;
	}

}
?>