<?php

namespace App\Models;


class Barang extends BaseModel
{

    protected $table            = 'barang';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_barang', 'nama', 'merek_barang', 'jumlah_stok', 'harga_beli', 'harga_jual', 'id_supplier', 'id_kategori_barang'];


    public function initialize()
    {
        $this->hasOne('kategori_barang', KategoriBarang::class, 'id_kategori_barang');
        $this->hasOne('supplier', Supplier::class, 'id_supplier', 'id');
    }

    public function getUnionTable(?string $id_kategori = "id")
    {
        $union = $this->db->table('layanan_servis')->select('id, nama, null as jumlah_stok, harga, null as harga_jual, null as id_kategori_barang');
        $builder = $this->db->table('barang')->select('id, nama, jumlah_stok, null as harga_jasa, harga_jual, id_kategori_barang')->union($union);
        if ($id_kategori != "id") {
            return $this->db->newQuery()->fromSubquery($builder, 'q')->select('id, nama, jumlah_stok, harga_jasa, harga_jual, id_kategori_barang')->where('id_kategori_barang', $id_kategori);
        } else if ($id_kategori == null) {
            return $this->db->newQuery()->fromSubquery($builder, 'q')->select('id, nama, jumlah_stok, harga_jasa, harga_jual, id_kategori_barang')->where('id_kategori_barang', null);
        } else {
            return $this->db->newQuery()->fromSubquery($builder, 'q')->select('id, nama, jumlah_stok, harga_jasa, harga_jual, id_kategori_barang');
        }
    }

    public function updateStok($id, $qty)
    {
        return $this->db->table($this->table)->update(['jumlah_stok' => $qty], ['id' => $id]);
    }

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = ['kode_barang' => 'required|is_unique[barang.kode_barang]', 'nama' => 'required'];
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
