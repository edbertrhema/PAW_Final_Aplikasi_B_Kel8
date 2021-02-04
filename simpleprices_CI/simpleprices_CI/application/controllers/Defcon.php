<?php

use Restserver\Libraries\REST_Controller;

class Defcon extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, ContentLength, Accept-Encoding");
        parent::__construct();
        $this->load->model('DefconModel');
        $this->load->library('form_validation');
    }
    public function index_get()
    {
        return $this->returnData($this->db->get('defcon')->result(), false);
    }

    public function metal_get()
    {
        $this->db->where('category', 'metal');
        return $this->returnData($this->db->get('defcon')->result(), false);
    }

    public function gemstone_get()
    {
        $this->db->where('category', 'gemstone');
        return $this->returnData($this->db->get('defcon')->result(), false);
    }

    public function energy_get()
    {
        $this->db->where('category', 'energy');
        return $this->returnData($this->db->get('defcon')->result(), false);
    }
    public function index_post($id = null)
    {
        $validation = $this->form_validation;
        $rule = $this->DefconModel->rules();
        if ($id == null) {
            array_push(
                $rule,
                [
                    'field' => 'def_price',
                    'label' => 'def_price',
                ],
                [
                    'field' => 'supply',
                    'label' => 'supply',
                ],
                [
                    'field' => 'total',
                    'label' => 'total',
                ]
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
        $services = new DefconData();
        $services->name = $this->post('def_price');
        $services->type = $this->post('supply');
        $services->unit = $this->post('demand');
        $services->total = $this->post('total');
        if ($id == null) {
            $response = $this->DefconModel->store($services);
        } else {
            $response = $this->DefconModel->update($services, $id);
        }
        return $this->returnData($response['msg'], $response['error']);
    }
    public function index_delete($id = null)
    {
        if ($id == null) {
            return $this->returnData('Parameter Id Tidak Ditemukan', true);
        }
        $response = $this->DefconModel->destroy($id);
        return $this->returnData($response['msg'], $response['error']);
    }
    public function returnData($msg, $error)
    {
        $response['error'] = $error;
        $response['message'] = $msg;
        return $this->response($response);
    }
}
class DefconData
{
    public $def_price;
    public $supply;
    public $demand;
    public $total;
}
