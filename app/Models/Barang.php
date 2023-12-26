<?php

namespace App\Models;

use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class Barang extends BaseModel
{

    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_barang', 'nama_barang', 'merek_barang', 'jumlah_stok', 'harga_beli', 'harga_jual', 'id_supplier', 'id_kategori_barang'];
    protected $with = ['kategori_barang', 'supplier'];

    public function initialize()
    {
        $this->hasOne('kategori_barang', KategoriBarang::class, 'id_kategori_barang');
        $this->hasOne('supplier', Supplier::class, 'id_supplier');
    }

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = ['kode_barang' => 'required|is_unique[barang.kode_barang]', 'nama_barang' => 'required'];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = false;

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
