<?php defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/API_Controller.php';
class User_Api extends API_Controller
{
    public function __construct() {
        parent::__construct();

        $this->load->helper('form');

        // Load form validation library
        $this->load->library('form_validation');

        // Load database
        $this->load->model('login_database');
    }

    public function simple_api(){

        header("Access-Control-Allow-Origin: *");

       // API Configuration
        $this->_apiConfig([
         'methods' => ['POST', 'GET'],

     ]);
    }


    public function api_limit()
    {

        /**
         * API Limit
         * ----------------------------------
         * @param: {int} API limit Number
         * @param: {string} API limit Type (IP)
         * @param: {int} API limit Time [minute]
         */

        $this->_APIConfig([

            'methods' => ['POST'],
            // number limit, type limit, time limit (last minute)
            'limit' => [10, 'ip', 5] 
        ]);
    }
    /**

    *API key without Database

    **/
    function api_key(){

        /**
         * Use API Key without Database
         * ---------------------------------------------------------
         * @param: {string} Types
         * @param: {string} API Key
         */

        $this->_APIConfig([

            'methods' => ['POST'],
            //'key' => ['header', '123456'],
            // API key with database
            'key' => ['header'],

            //Add Custom data in API Response
            'data' => [
               'is_login' => false,
           ]
       ]);

        // Data
        $data = array(
            'status' => 'OK',
            'data' => [
              'user_id' => 12,
          ]
      );
        /**
         * Return API Response
         * ---------------------------------------------------------
         * @param: API Data
         * @param: Request Status Code
         */
        if (!empty($data)) {

           $this->api_return($data,'200');
       }else{

           $this->api_return(['status'=>false, "error"=>"Invalid Data"],'404');
       }

   }

    /**
    * Login user with API
    **/
    public function login(){

       header("Access-Control-Allow-Origin: *");
       
        // API Configuration
       $this->_apiConfig([
        'methods' => ['POST'],
    ]);

        // you user authentication code will go here, you can compare the user with the database or whatever
       $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
       $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
       if ($this->form_validation->run() == FALSE) {

        $this->api_return(
            [
                'status' => false,
                "msg" =>  "Error in form"
            ],
            200);
    }else{

        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        );
        $result = $this->login_database->login($data);
        if ($result == TRUE) {

            $username = $this->input->post('username');
            $result = $this->login_database->read_user_information($username);
            if ($result != false) {

             // Load Authorization Library or Load in autoload config file
               $this->load->library('Authorization_Token');

               $payload = [
                 'username' => $result[0]->username,
                 'email' => $result[0]->email,
             ];
         // generte a token
             $token = $this->authorization_token->generateToken($payload);

        // return data
             $this->api_return(
                [
                   'status' => true,
                   "result" => [
                       'token' => $token,
                       'userdetail' => $result
                   ],

               ],
               200);
                // $session_data = array(
                //     'username' => $result[0]->user_name,
                //     'email' => $result[0]->user_email,
                // );
                // Add user data in session
                //$this->load->view('admin_page');
         }
     } else {
        $data = array(
            'error_message' => 'Invalid Username or Password'
        );
    }

}
}

    /**
     * View User Data
     *
     * @link [api/user/view]
     * @method POST
     * @return Response|void
     */
    public function view()
    {
        header("Access-Control-Allow-Origin: *");

        // API Configuration [Return Array: User Token Data]
        $user_data = $this->_apiConfig([
            'methods' => ['POST'],
            'requireAuthorization' => true,
        ]);

        // return data
        $this->api_return(
            [
                'status' => true,
                "result" => [
                    'user_data' => $user_data['token_data']
                ],
            ],
            200);
    }

}