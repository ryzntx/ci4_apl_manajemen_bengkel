<?php

namespace App\Models;

use CodeIgniter\Model;

class Supplier extends Model
{
    protected $table            = 'supplier';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_supplier', 'nama_supplier', 'alamat', 'no_telp'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        // |is_unique[supplier,kode_supplier,kode_supplier]
        'kode_supplier' => 'required|is_unique[supplier.kode_supplier]',
        'nama_supplier' => 'required',
        'alamat' => 'required',
        'no_telp' => 'required|numeric'
    ];
    protected $validationMessages   = [
        'kode_supplier' => [
            'required' => 'Kode Supplier wajib di isi!',
            'is_unique' => 'Kode Supplier sudah ada!'
        ],
        'nama_supplier' => [
            'required' => 'Nama Supplier wajib diisi!'
        ],
        'alamat' => [
            'required' => 'Alamat tidak boleh kosong!'
        ],
        'no_telp' => [
            'required' => 'No. Telpon wajib diisi!',
            'numeric' => 'No. Telpon harus berupa angka!'
        ]

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
