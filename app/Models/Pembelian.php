<?php

namespace App\Models;

use CodeIgniter\Model;

class Pembelian extends BaseModel
{
    protected $table            = 'pembelian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_pembelian', 'id_supplier', 'jumlah_order', 'total_harga', 'status'];

    public function initialize()
    {
        $this->hasMany('detail_pembelian', DetailPembelian::class, 'kode_pembelian', 'kode_pembelian');
        $this->hasOne('supplier', Supplier::class, 'id_supplier', 'id');
    }

    public function deleteByKodePembelian($kode_pembelian)
    {
        return $this->db->table($this->table)->delete(['kode_pembelian' => $kode_pembelian]);
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
