<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/API_Controller.php';
class Complaints_Api extends API_Controller{

  public function __construct() {
    parent::__construct();

    $this->load->helper('form');

        // Load form validation library
    $this->load->library('form_validation');

        // Load database
    $this->load->model('complaints_db');
  }

  public function getcomplaints(){
    header("Access-Control-Allow-Origin: *");

         // API Configuration [Return Array: User Token Data]
    $user_data = $this->_apiConfig([
      'methods' => ['POST'],
      'requireAuthorization' => true,
    ]);

    $res = $this->complaints_db->get_complaints();
                // return data
    $this->api_return(
      [
        'status' => true,
        "result" => $res
      ],
      200);

  }

  public function insertcomplaints(){

   header("Access-Control-Allow-Origin: *");

        // API Configuration
   $this->_apiConfig([
    'methods' => ['POST'],
    'requireAuthorization' => true,
  ]);

             // you user authentication code will go here, you can compare the user with the database or whatever
   $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
   $this->form_validation->set_rules('details', 'Details', 'required|xss_clean');
   $this->form_validation->set_rules('priority', 'Priority', 'required|xss_clean');
   $this->form_validation->set_rules('department', 'Department', 'required|xss_clean');
   $this->form_validation->set_rules('province', 'Province', 'required|xss_clean');
   $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
   $this->form_validation->set_rules('created_on', 'Created_on', 'required|xss_clean');
   $this->form_validation->set_rules('updated_on', 'Updated_on', 'required|xss_clean');
   $this->form_validation->set_rules('read_on', 'Read_on', 'required|xss_clean');
   $this->form_validation->set_rules('created_by', 'Created_by', 'required|xss_clean');
   $this->form_validation->set_rules('read_by', 'Read_by', 'required|xss_clean');

   if ($this->form_validation->run() == FALSE) {

    $this->api_return(
      [
        'status' => false,
        "msg" =>  "Error in form"
      ],
      200);
  }else{

   $data = array(
    'title' => $this->input->post('title'),
    'details' => $this->input->post('details'),
    'priority' => $this->input->post('priority'),
    'department' => $this->input->post('department'),
    'province' => $this->input->post('province'),
    'status' => $this->input->post('status'),
    'created_on' => $this->input->post('created_on'),
    'updated_on' => $this->input->post('updated_on'),
    'read_on' => $this->input->post('read_on'),
    'created_by' => $this->input->post('created_by'),
    'read_by' => $this->input->post('read_by'));

   $result = $this->complaints_db->insert_complaints($data);
   if ($result==TRUE) {
        # code...

    $this->api_return(
      [
        'status' => true,
        "result" => 'Data Successfully Inserted',
      ],
      200);

  }
}
}

public function delete(){

 header("Access-Control-Allow-Origin: *");

        // API Configuration
 $this->_apiConfig([
  'methods' => ['POST'],
  'requireAuthorization' => true,
]);

 $this->form_validation->set_rules('id', 'Complaint Id', 'trim|required|xss_clean');
 if ($this->form_validation->run() == FALSE) {

  $this->api_return(
    [
      'status' => false,
      "msg" =>  "Error in form"
    ],
    200);
}else{
  $c_id=$this->input->post('id');

  $result = $this->complaints_db->delete($c_id);
  if ($result == TRUE) {
    $this->api_return(
      [
        'status' => true,
        "msg" =>  "Record Deleted Successfully"
      ],
      200);

  } else {
    $data = array(
      'error_message' => 'Invalid id'
    );
  }

}
}

public function filterapi(){

 header("Access-Control-Allow-Origin: *");

  // API Configuration
 $this->_apiConfig([
  'methods' => ['POST'],
  'requireAuthorization' => true,
]);

 $filterType = $this->input->post('type');//Type can be any column name.

 $filterValue = $this->input->post('filter');//Filter will be column value.
//echo $filterValue;
 $res = $this->complaints_db->filter_complaints($filterType,$filterValue);
 
 // return data
 $this->api_return(
  [
    'status' => true,
    "result" => $res
  ],
  200);
}

public function updatecomplaints(){

 header("Access-Control-Allow-Origin: *");

        // API Configuration
 $this->_apiConfig([
  'methods' => ['POST'],
  'requireAuthorization' => true,
]);

             // you user authentication code will go here, you can compare the user with the database or whatever
$this->form_validation->set_rules('id', 'Complaint Id', 'required|xss_clean');
 $this->form_validation->set_rules('title', 'Title', 'required|xss_clean');
 $this->form_validation->set_rules('details', 'Details', 'required|xss_clean');
 $this->form_validation->set_rules('priority', 'Priority', 'required|xss_clean');
 $this->form_validation->set_rules('department', 'Department', 'required|xss_clean');
 $this->form_validation->set_rules('province', 'Province', 'required|xss_clean');
 $this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
 $this->form_validation->set_rules('created_on', 'Created_on', 'required|xss_clean');
 $this->form_validation->set_rules('updated_on', 'Updated_on', 'required|xss_clean');
 $this->form_validation->set_rules('read_on', 'Read_on', 'required|xss_clean');
 $this->form_validation->set_rules('created_by', 'Created_by', 'required|xss_clean');
 $this->form_validation->set_rules('read_by', 'Read_by', 'required|xss_clean');

 if ($this->form_validation->run() == FALSE) {

  $this->api_return(
    [
      'status' => false,
      "msg" =>  "Error in form"
    ],
    200);
}else{


 $data = array(
  'id' => $this->input->post('id'),
  'title' => $this->input->post('title'),
  'details' => $this->input->post('details'),
  'priority' => $this->input->post('priority'),
  'department' => $this->input->post('department'),
  'province' => $this->input->post('province'),
  'status' => $this->input->post('status'),
  'created_on' => $this->input->post('created_on'),
  'updated_on' => $this->input->post('updated_on'),
  'read_on' => $this->input->post('read_on'),
  'created_by' => $this->input->post('created_by'),
  'read_by' => $this->input->post('read_by'));

 $result = $this->complaints_db->update_complaints($data);
 
 if ($result==TRUE) {
       
  $this->api_return(
    [
      'status' => true,
      "result" => 'Data Successfully Updated',
    ],
    200);

}
}
}

}
?>