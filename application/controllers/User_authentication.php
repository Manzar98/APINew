<?php

//session_start(); //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

  public function __construct() {
    parent::__construct();

// Load form helper library
    $this->load->helper('form');

// Load form validation library
    $this->load->library('form_validation');

// Load session library
    $this->load->library('session');

// Load database
    $this->load->model('login_database');
  }

// Show login page
  public function index() {
    $this->load->view('login_form');
  }

// Show registration page
  public function user_registration_show() {

    $this->load->view('registration_form');
  }

// Validate and store registration data in database
  public function new_user_registration() {

// Check validation for user input in SignUp form
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('registration_form');
    } else {

      $data = array(
        'username'  => $this->input->post('username'),
        'email'     => $this->input->post('email'),
        'password'  => md5($this->input->post('password')),
        'firstname' => $this->input->post('firstname'),
        'lastname' => $this->input->post('lastname'),
        'department' => $this->input->post('department'),
        'designation' => $this->input->post('designation'),
        'user_role' => $this->input->post('user_role'),
        'location' => $this->input->post('location')

      );
//print_r($data);
      $result = $this->login_database->registration_insert($data);
      if ($result == TRUE) {
//$data['message_display'] = 'Registration Successfully !';
       $getAllUser = $this->login_database->get_all_users_info();

// Add user data in session
//$this->session->set_userdata('logged_in');
       $data = array(
         'title' => $getAllUser,
         'message_display' => 'User Successfully Created'
       );
       $this->load->view('admin_page',$data);
     } else {
      $data['message_display'] = 'Username already exist!';
      $this->load->view('registration_form', $data);
    }
  }
}

// Check for user login process
public function user_login_process() {


  $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
  $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

  if ($this->form_validation->run() == FALSE) {
    if(isset($this->session->userdata['logged_in'])){

      $getAllUser = $this->login_database->get_all_users_info();

      $data = array(
       'title' => $getAllUser,
     );
      $this->load->view('admin_page',$data);

    }else{

      $this->load->view('login_form');
    }
  } else {
    $data = array(
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password'))
    );
    $result = $this->login_database->login($data);
    if ($result == TRUE) {
      $username = $this->input->post('username');
      $result = $this->login_database->read_user_information($username);
      if ($result[0]->user_role=="admin") {
	# code...
        $getAllUser = $this->login_database->get_all_users_info();
// echo print_r($getAllUser)."hit here";
        if ($result != false) {
          $session_data = array(
            'username' => $result[0]->username,
            'email' => $result[0]->email,
            'user_role' => $result[0]->user_role,
          );
// Add user data in session
          $this->session->set_userdata('logged_in', $session_data);
          $data = array(
           'title' => $getAllUser,
         );
          $this->load->view('admin_page',$data);
        }
      }else{
       $data = array(
        'error_message' => 'Invalid Username or Password'
      );
       $this->load->view('login_form', $data);
     }
   } else {
    $data = array(
      'error_message' => 'Invalid Username or Password'
    );
    $this->load->view('login_form', $data);
  }
}
}

// Logout from admin page
public function logout() {

// Removing session data
  $sess_array = array(
    'username' => ''
  );
  $this->session->unset_userdata('logged_in', $sess_array);
  $data['message_display'] = 'Successfully Logout';
  $this->load->view('login_form', $data);
}


public function deleteUser($userId){
 // echo $userId;
  $deleteUser = $this->login_database->delete_record($userId);
  $getAllUser = $this->login_database->get_all_users_info();

  $data = array(
   'title' => $getAllUser,
   'message_display' => 'Successfully Delete'
 );
  $this->load->view('admin_page', $data);

}

public function editUser($userId){

  $record= $this->login_database->getAllRecords($userId);
  // print_r($record);
  $this->load->view('update_user',['record'=>$record]);
}

public function updateUser( $userId ){

// Check validation for user input in SignUp form
  $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
  $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
  if ($this->form_validation->run() == FALSE) {
    $record= $this->login_database->getAllRecords($userId);
  // print_r($record);
    $this->load->view('update_user',['record'=>$record]);
  } else {

    $data = array(
      'username'  => $this->input->post('username'),
      'email'     => $this->input->post('email'),
      'password'  => md5($this->input->post('password')),
      'firstname' => $this->input->post('firstname'),
      'lastname' => $this->input->post('lastname'),
      'department' => $this->input->post('department'),
      'designation' => $this->input->post('designation'),
      'user_role' => $this->input->post('user_role'),
      'location' => $this->input->post('location')

    );

    $result = $this->login_database->updateRecords($userId,$data);
    if ($result == TRUE) {

     $getAllUser = $this->login_database->get_all_users_info();
     $data = array(
       'title' => $getAllUser,
       'message_display' => 'Record Successfully Updated'
     );
     $this->session->set_userdata('logged_in');
     $this->load->view('admin_page',$data);
   }
 }


}
}
?>