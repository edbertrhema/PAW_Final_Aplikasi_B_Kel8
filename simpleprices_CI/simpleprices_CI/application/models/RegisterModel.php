<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RegisterModel extends CI_Model
{
    private $table = 'user';
    public $id;
    public $username;
    public $email;
    public $password;
    public $created_at;
    public $rule = [
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
    ];
    public function Rules()
    {
        return $this->rule;
    }


    public function getAll()
    {
        return
            $this->db->get('data_mahasiswa')->result();
    }
    public function store($request)
    {
        $this->username = $request->username;
        $this->email = $request->email;
        $this->password = password_hash($request->password, PASSWORD_BCRYPT);
        $this->created_at = date('y-m-d H:i:s');
        if ($this->db->insert($this->table, $this)) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
    public function destroy($id)
    {
        if (empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row())) return ['msg' => 'id tidak ditemukan', 'error' => true];

        if ($this->db->delete($this->table, array('id' => $id))) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
}
