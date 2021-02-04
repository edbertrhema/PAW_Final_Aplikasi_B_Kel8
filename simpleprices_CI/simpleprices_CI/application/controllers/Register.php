<?php

use Restserver\Libraries\REST_Controller;

class Register extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, ContentLength, Accept-Encoding");
        parent::__construct();
        $this->load->model('RegisterModel');
        $this->load->library('form_validation');
    }
    public function index_get()
    {
        return $this->returnData($this->db->get('user')->result(), false);
    }
    public function index_post($id = null)
    {
        $validation = $this->form_validation;
        $rule = $this->RegisterModel->rules();
        if ($id == null) {
            array_push(
                $rule,
                [
                    'field' => 'username',
                    'label' => 'username',
                    'rules' => 'required'
                ],
                [
                    'field' => 'email',
                    'label' => 'email',
                    'rules' => 'required'
                ],
                [
                    'field' => 'password',
                    'label' => 'password',
                    'rules' => 'required'
                ],
                // ,
                // [
                //     'field' => 'email',
                //     'label' => 'email',
                //     'rules' => 'required|valid_email|is_unique[users.email]'
                // ]
            );
        }
        // else{
        //     array_push($rule,
        //         [
        //             'field' => 'email',
        //             'label' => 'email',
        //             'rules' => 'required|valid_email'
        //         ]
        //     );
        // }
        $validation->set_rules($rule);
        if (!$validation->run()) {
            return $this->returnData($this->form_validation->error_array(), true);
        }
        $services = new RegisterData();
        $services->username = $this->post('username');
        $services->email = $this->post('email');
        $services->password = $this->post('password');
        if ($id == null) {
            $response = $this->RegisterModel->store($services);
        } else {
            $response = $this->RegisterModel->update($services, $id);
        }
        return $this->returnData($response['msg'], $response['error']);
    }
    public function index_delete($id = null)
    {
        if ($id == null) {
            return $this->returnData('Parameter Id Tidak Ditemukan', true);
        }
        $response = $this->RegisterModel->destroy($id);
        return $this->returnData($response['msg'], $response['error']);
    }
    public function returnData($msg, $error)
    {
        $response['error'] = $error;
        $response['message'] = $msg;
        return $this->response($response);
    }
}
class RegisterData
{
    public $username;
    public $email;
    public $password;
}
