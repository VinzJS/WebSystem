<?php
class booking{
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
		[$plate,$model,$type,$capacity,$transmission,$status,$NOW,$NOW,'1'],
	];
	$stmt = $this->conn->prepare("INSERT INTO tbl_taxi (taxi_plate, taxi_model, taxi_type, taxi_capacity, taxi_transmission, taxi_status) VALUES (?,?,?,?,?,?)");
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

	public function new_booking($bookdate,$price,$taximodel,$customer_first){
		
		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		$data = [
			[$bookdate,$price,$taximodel,$customer_first],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_booking(booking_date, booking_price, taxi_model,customer_first) VALUES (?,?,?,?)");
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
		public function update_booking($taximodel,$taxiid,$driverid,$bookingid,$price,$bookdate, $id){
		
			/* Setting Timezone for DB */
			$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
			$NOW = $NOW->format('Y-m-d H:i:s');
	
			$sql = "UPDATE tbl_product SET booking_id=:booking_id,taxi_id=:taxi_id,customer_id=:customer_id,booking_date=:booking_date,booking_price=:booking_price,taxi_id=:taxi_id WHERE booking_id=:booking_id";
	
			$q = $this->conn->prepare($sql);
			$q->execute(array(':booking_id'=>$bookid, ':taxi_id'=>$tid,':customer_id'=>$cid,':booking_date'=>$NOW,':booking_price'=>$bookprice,':booking_id'=>$id));
			return true;
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
		public function list_booking(){
			$sql="SELECT * FROM tbl_booking";
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
	function get_taxi_id($id){
			$sql="SELECT taxi_id FROM tbl_taxi WHERE taxi_id = :id";	
			$q = $this->conn->prepare($sql);
			$q->execute(['id' => $id]);
			$taxi_id = $q->fetchColumn();
			return $taxi_id;
	}
	function get_taxi_model($taximodel){
		 $sql= "SELECT taxi_model FROM tbl_taxi WHERE taxi_status = 'Available'";	
		 $q = $this->conn->prepare($sql);
		 $q->execute(['id' => $id]);
		 $taxi_model1 = $q->fetchColumn();
		 return $taxi_model1;
	}		
	function get_customer_id($id){
		$sql="SELECT customer_id FROM tbl_customer WHERE customer_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$customer_id = $q->fetchColumn();
		return $customer_id;
}
function get_customer_first($id){
	 $sql= "SELECT customer_first FROM tbl_customer WHERE customer_id = :id";	
	 $q = $this->conn->prepare($sql);
	 $q->execute(['id' => $id]);
	 $customer_first = $q->fetchColumn();
	 return $customer_first;
}		

	function get_booking($id){
		$sql="SELECT booking_id FROM tbl_booking WHERE booking_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$booking_id = $q->fetchColumn();
		return $booking_id;
	}
	function get_date($bookdate){
		$sql="SELECT booking_date FROM tbl_booking WHERE booking_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$booking_date = $q->fetchColumn();
		return $booking_date;
	}
	function get_price($id){
		$sql="SELECT booking_price FROM tbl_booking WHERE booking_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$booking_price = $q->fetchColumn();
		return $booking_price;
	}
}
?>