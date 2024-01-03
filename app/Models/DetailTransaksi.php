<?php

namespace App\Models;

use CodeIgniter\Model;

class DetailTransaksi extends BaseModel
{
    protected $table            = 'detail_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_transaksi', 'id_barang', 'id_layanan_servis', 'qty', 'total_harga'];

    public function updateItem($data, $kode_transaksi, $id_barang)
    {
        return $this->db->table($this->table)->update($data, ['kode_transaksi' => $kode_transaksi, 'id_barang' => $id_barang]);
    }

    public function initialize()
    {
        $this->hasOne('barang', Barang::class, 'id_barang', 'id');
        $this->hasOne('layanan_servis', LayananJasa::class, 'id_layanan_servis', 'id');
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
