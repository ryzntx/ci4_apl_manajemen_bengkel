<?php

namespace App\Models;

use CodeIgniter\Model;

class Transaksi extends BaseModel
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_transaksi', 'jenis_layanan', 'total_dibayar', 'total_uang', 'status', 'id_user'];

    public function initialize()
    {
        $this->hasOne('customer', Customer::class, 'kode_transaksi', 'kode_transaksi');
        $this->hasMany('detail_transaksi', DetailTransaksi::class, 'kode_transaksi', 'kode_transaksi');
        $this->hasOne('user', UserModel::class, 'id_user', 'id');
    }

    public function updateByKodeTransaksi($kode_transaksi, $data)
    {
        return $this->db->table($this->table)->update($data, ['kode_transaksi' => $kode_transaksi]);
    }

    public function deleteByKodeTransaksi($kode_transaksi)
    {
        return $this->db->table($this->table)->delete(['kode_transaksi' => $kode_transaksi]);
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
