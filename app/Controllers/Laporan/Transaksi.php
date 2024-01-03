<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Transaksi as ModelsTransaksi;

class Transaksi extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new ModelsTransaksi();
    }

    public function getIndex()
    {
        $kalendar = $this->transaksiModel->select('DISTINCT YEAR(created_at) AS tahun, MONTH(created_at) AS bulan, MONTHNAME(created_at) AS nama_bulan')->find();
        $data = ['kalendar' => $kalendar];
        return view('pages/laporan/transaksi/index', $data);
    }
}
