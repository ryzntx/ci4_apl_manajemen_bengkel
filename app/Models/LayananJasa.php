<?php

namespace App\Models;

use CodeIgniter\Model;

class LayananJasa extends Model
{
    protected $table            = 'layanan_servis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'harga', 'deskripsi'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => 'required',
        'harga' => 'required|numeric',
    ];
    protected $validationMessages   = [
        'nama' => ['required' => 'Nama Layanan wajib di isi!'],
        'harga' => ['required' => 'Harga wajib di isi!', 'numeric' => 'Hanya angka!'],
    ];
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
