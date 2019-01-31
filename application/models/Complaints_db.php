<?php

Class Complaints_Db extends CI_Model {

	public function get_complaints(){

		
		$this->db->select('*');
		$this->db->from('complaints');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function insert_complaints($data){

		// Query to insert data in database
		$this->db->insert('complaints', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
	}

	public function filter_complaints($type,$filter){
		//print_r($type);
		$condition="";
		if (count($type)==1) {

			$condition = $type." =" . "'" . $filter . "'";

		}else{

			for ($i=0; $i <count($type); $i++) { 

				//echo $type[$i];
				$condition .= $type[$i]." =" . "'" . $filter[$i] . "'";
				$condition .= " AND ";
			}
			$condition= substr_replace($condition ,"",-4);

		}
		//echo $condition;

		// echo ;
		$this->db->select('*');
		$this->db->from('complaints');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}

	public function delete($userId){

		return $this->db->delete('complaints', array('id' => $userId));

	}

	public function update_complaints($data){

         //echo ;
		return	$this->db->where('id',$data['id'])
		->update('complaints',$data);
	}

	public function getsingle($userId){
		
		$condition = "id =" . "'" . $userId . "'";
		$this->db->select('*');
		$this->db->from('complaints');
		$this->db->where($condition);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}

	}
	public function statuscount(){
//select status, count(status) from complaints group by status

		$this->db->select('status, count(status) as total');
		$this->db->from('complaints');
		$this->db->group_by('status');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {

			$data = $query->result();
			$array=[];
			$total="";
			foreach ($data as $key => $v) {

				$array[$v->status]  = $v->total;
				$total+= $v->total;
			}
			$array['total']= "".$total."";
			return $array;
			
		} else {
			return false;
		}

	}
}
?>