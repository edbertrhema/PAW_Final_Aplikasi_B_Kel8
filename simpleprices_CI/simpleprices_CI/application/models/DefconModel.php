<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DefconModel extends CI_Model
{
    private $table = 'defcon';
    public $id;
    public $def_price;
    public $supply;
    public $demand;
    public $total;
    public $rule = [
        [
            'field' => 'def_price',
            'label' => 'def_price',
        ],
        [
            'field' => 'supply',
            'label' => 'supply',
        ],
        [
            'field' => 'demand',
            'label' => 'demand',
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
        $this->def_price = $request->def_price;
        $this->supply = $request->supply;
        $this->demand = $request->demand;
        $this->total = $request->total;

        if ($this->db->insert($this->table, $this)) {
            return ['msg' => 'Berhasil', 'error' => false];
        }
        return ['msg' => 'Gagal', 'error' => true];
    }
    public function update($request, $id)
    {
        $updateData = [
            'def_price' => $request->def_price,
            'supply' => $request->supply,
            'demand' => $request->demand,
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
