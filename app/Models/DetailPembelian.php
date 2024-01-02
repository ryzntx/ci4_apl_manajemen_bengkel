<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailPembelian extends BaseModel
{
    protected $table            = 'detail_pembelian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_pembelian', 'id_barang', 'jumlah', 'total_harga'];

    public function initialize()
    {
        //
    }

    // Membuat fungsi untuk memperbarui data berdasarkan kode_pembelian dan id_barang

    public function updateItem($data, $kode_pembelian, $id_barang)
    {
        return $this->db->table($this->table)->update($data, ['kode_pembelian' => $kode_pembelian, 'id_barang' => $id_barang]);
    }

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
