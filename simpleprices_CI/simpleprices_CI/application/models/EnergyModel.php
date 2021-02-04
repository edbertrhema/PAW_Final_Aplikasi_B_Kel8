<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EnergyModel extends CI_Model
{
    private $table = 'energy';
    public $id;
    public $name;
    public $type;
    public $refinement;
    public $weight;
    public $gatheredOn;
    public $total;
    public $rule = [
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
            'field' => 'refinement',
            'label' => 'refinement',
            'rules' => 'required'
        ],
        [
            'field' => 'weight',
            'label' => 'weight',
            'rules' => 'required'
        ],
        [
            'field' => 'gatheredOn',
            'label' => 'gatheredOn',
            'rules' => 'required'
        ],
        [
            'field' => 'total',
            'label' => 'total',
        ],
    ];

    public function Rules()
    {
        return $this->rule;
    }

    public function getAll()
    {
        return $this->db->get('data_mahasiswa')->result();
    }

    public function store($request)
    {
        $this->name = $request->name;
        $this->type = $request->type;
        $this->refinement = $request->refinement;
        $this->weight = $request->weight;
        $this->gatheredOn = $request->gatheredOn;
        $this->total = $request->total;

        if ($this->db->insert($this->table, $this)) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
    public function update($request, $id)
    {
        $updateData = [
            'name' => $request->name,
            'type' => $request->type,
            'refinement' => $request->refinement,
            'weight' => $request->weight,
            'gatheredOn' => $request->gatheredOn,
            'total' => $request->total,
        ];

        if ($this->db->where('id', $id)->update($this->table, $updateData)) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }

    public function destroy($id)
    {
        if (empty($this->db->select('*')->where(array('id' => $id))->get($this->table)->row()))
            return ['msg' => 'Id tidak ditemukan', 'error' => true];

        if ($this->db->delete($this->table, array('id' => $id))) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
}
