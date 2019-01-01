<?php

Class Login_Database extends CI_Model {

// Insert registration data in database
public function registration_insert($data) {

// Query to check whether username already exist or not
$condition = "username =" . "'" . $data['username'] . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();
if ($query->num_rows() == 0) {

// Query to insert data in database
$this->db->insert('user_login', $data);
if ($this->db->affected_rows() > 0) {
return true;
}
} else {
return false;
}
}

// Read data using username and password
public function login($data) {

$condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return true;
} else {
return false;
}
}

// Read data from database to show data in admin page
public function read_user_information($username) {

$condition = "username =" . "'" . $username . "'";
$this->db->select('*');
$this->db->from('user_login');
$this->db->where($condition);
$this->db->limit(1);
$query = $this->db->get();

if ($query->num_rows() == 1) {
return $query->result();
} else {
return false;
}
}

public function get_all_users_info() {

$this->db->select('*');
$this->db->from('user_login');
$query = $this->db->get();
// echo $this->db->last_query(); die;
if ($query->num_rows() >0) {

return $query->result_array();
} else {
return false;
}
}


public function delete_record($userId){

	return $this->db->delete('user_login', array('id' => $userId));

}

public function getAllRecords($userId){

	$query =$this->db->get_where('user_login', array('id' => $userId));

	if ($query->num_rows() > 0) {
		return $query->row();
	}
}
 public function updateRecords($userId,$data){

 	return	$this->db->where('id',$userId)
 		   ->update('user_login',$data);
 	}



}

?>