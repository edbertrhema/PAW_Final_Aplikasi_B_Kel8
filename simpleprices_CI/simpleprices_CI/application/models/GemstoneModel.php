<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GemstoneModel extends CI_Model
{
    private $table = 'gemstone';
    public $id;
    public $name;
    public $type;
    public $unit;
    public $carats;
    public $weight;
    public $minedOn;
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
        $this->unit = $request->unit;
        $this->carats = $request->carats;
        $this->weight = $request->weight;
        $this->minedOn = $request->minedOn;
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
            'unit' => $request->unit,
            'carats' => $request->carats,
            'weight' => $request->weight,
            'minedOn' => $request->minedOn,
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
