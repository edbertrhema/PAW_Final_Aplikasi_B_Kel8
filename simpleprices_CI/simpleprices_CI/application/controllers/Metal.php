<?php

use Restserver\Libraries\REST_Controller;

class Metal extends REST_Controller
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, OPTIONS, POST, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, ContentLength, Accept-Encoding");
        parent::__construct();
        $this->load->model('MetalModel');
        $this->load->library('form_validation');
    }
    public function index_get()
    {
        return $this->returnData($this->db->get('metal')->result(), false);
    }
    public function index_post($id = null)
    {
        $validation = $this->form_validation;
        $rule = $this->MetalModel->rules();
        if ($id == null) {
            array_push(
                $rule,
                [
                    'field' => 'name',
                    'label' => 'name',
                    'rules' => 'required'
                ],
                [
                    'field' => 'type',
                    'label' => 'type',
                    'rules' => 'required'
                ],
                [
                    'field' => 'unit',
                    'label' => 'unit',
                    'rules' => 'required'
                ],
                [
                    'field' => 'carats',
                    'label' => 'carats',
                    'rules' => 'required'
                ],
                [
                    'field' => 'weight',
                    'label' => 'weight',
                    'rules' => 'required'
                ],
                [
                    'field' => 'minedOn',
                    'label' => 'minedOn',
                    'rules' => 'required'
                ],
                [
                    'field' => 'total',
                    'label' => 'total',
                    'rules' => 'required'
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
        $services = new MetalData();
        $services->name = $this->post('name');
        $services->type = $this->post('type');
        $services->unit = $this->post('unit');
        $services->carats = $this->post('carats');
        $services->weight = $this->post('weight');
        $services->minedOn = $this->post('minedOn');
        $services->total = $this->post('total');
        if ($id == null) {
            $response = $this->MetalModel->store($services);
        } else {
            $response = $this->MetalModel->update($services, $id);
        }
        return $this->returnData($response['msg'], $response['error']);
    }
    public function index_delete($id = null)
    {
        if ($id == null) {
            return $this->returnData('Parameter Id Tidak Ditemukan', true);
        }
        $response = $this->MetalModel->destroy($id);
        return $this->returnData($response['msg'], $response['error']);
    }
    public function returnData($msg, $error)
    {
        $response['error'] = $error;
        $response['message'] = $msg;
        return $this->response($response);
    }
}
class MetalData
{
    public $name;
    public $type;
    public $unit;
    public $carats;
    public $weight;
    public $minedOn;
    public $total;
}
