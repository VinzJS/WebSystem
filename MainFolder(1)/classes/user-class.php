<?php
class User{
	private $DB_SERVER='localhost';
	private $DB_USERNAME='root';
	private $DB_PASSWORD='';
	private $DB_DATABASE='user';
	private $conn;

	public function __construct(){
		$this->conn = new PDO("mysql:host=".$this->DB_SERVER.";dbname=".$this->DB_DATABASE,$this->DB_USERNAME,$this->DB_PASSWORD);
		
	}
	
	public function new_user($email,$password,$lastname,$firstname,$access){

		/* Setting Timezone for DB */
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
	
		// Hash the password
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);
	
		$data = [
			[$lastname,$firstname,$email,$hashed_password,$access,$NOW,$NOW],
		];
		$stmt = $this->conn->prepare("INSERT INTO tbl_users (user_lastname, user_firstname, user_email, user_password, user_access, user_date_added, user_time_added) VALUES (?,?,?,?,?,?,?)");
		try {
			$this->conn->beginTransaction();
			foreach ($data as $row)
			{
				$stmt->execute($row);
			}
			$this->conn->commit();
		}catch (Exception $e){
			$this->conn->rollback();
			throw $e;
		}
	
		return true;
	}
	public function update_user($user_id, $lastname, $firstname, $email,$access) {
		$NOW = new DateTime('now', new DateTimeZone('Asia/Manila'));
		$NOW = $NOW->format('Y-m-d H:i:s');
		$sql = "UPDATE tbl_users SET user_firstname = :user_firstname, user_lastname = :user_lastname, user_email = :user_email,user_access = :user_access, user_date_updated = :user_date_updated, user_time_updated = :user_time_updated WHERE user_id = :user_id";
		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_id' => $user_id, ':user_lastname' => $lastname, ':user_firstname' => $firstname, ':user_email' => $email, 'user_access' => $access, ':user_date_updated' => $NOW, ':user_time_updated' => $NOW));
		return true;
	}

	public function delete_user($user_id) {
		$sql = "DELETE FROM tbl_users WHERE user_id = :user_id";
		$q = $this->conn->prepare($sql);
		$q->execute(array(':user_id' => $user_id));
		return true;
	}

	public function list_users_search($keyword){
		
		//$keyword = "%".$keyword."%";

		$q = $this->conn->prepare("SELECT * FROM tbl_users WHERE user_lastname LIKE ?");
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
	
	public function list_users(){
			 $sql="SELECT * FROM tbl_users";
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

	function get_user_id($email){
		$sql="SELECT user_id FROM tbl_users WHERE user_email = :email";    
		$q = $this->conn->prepare($sql);
		$q->execute(['email' => $email]);
		$user_id = $q->fetchColumn();
		return $user_id ? $user_id : null; // return null if user_id is not found
	}
	function get_user_email($id){
		$sql="SELECT user_email FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_email = $q->fetchColumn();
		return $user_email;
	}
	function get_user_firstname($id){
		$sql="SELECT user_firstname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_firstname = $q->fetchColumn();
		return $user_firstname;
	}
	function get_user_lastname($id){
		$sql="SELECT user_lastname FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_lastname = $q->fetchColumn();
		return $user_lastname;
	}

	function get_user_password($id){
		$sql="SELECT user_password FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_status = $q->fetchColumn();
		return $user_password;
	}

	function get_user_access($id){
		$sql="SELECT user_access FROM tbl_users WHERE user_id = :id";	
		$q = $this->conn->prepare($sql);
		$q->execute(['id' => $id]);
		$user_access = $q->fetchColumn();
		return $user_access;
	}

	function get_session(){
		if(isset($_SESSION['login']) && $_SESSION['login'] == true){
			return true;
		}else{
			return false;
		}
	}

	public function check_login($email,$password){
		
		$sql = "SELECT count(*) FROM tbl_users WHERE user_email = :email AND user_password = :password"; 
		$q = $this->conn->prepare($sql);
		$q->execute(['email' => $email,'password' => $password ]);
		$number_of_rows = $q->fetchColumn();
	
		if($number_of_rows == 1){
			
			$_SESSION['login']=true;
			$_SESSION['user_email']=$email;
			$_SESSION['user_access']=$access;
			return true;
		}else{
			return false;
		}
	}
}
	  

	
	

