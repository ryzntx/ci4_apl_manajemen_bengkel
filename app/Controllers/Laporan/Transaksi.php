<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Transaksi as ModelsTransaksi;
use Hermawan\DataTables\DataTable;

class Transaksi extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new ModelsTransaksi();
    }

    public function getIndex()
    {
        $countTransaksi = count($this->transaksiModel->findAll());
        $sudahBayar = $this->transaksiModel->select('SUM(total_dibayar) AS sudah_bayar')->where('status', 'Lunas')->find()[0]->sudah_bayar;
        $tagihan = $this->transaksiModel->select('SUM(total_dibayar) AS tagihan')->find()[0]->tagihan;
        $selisih = $tagihan - $sudahBayar;
        $kalendar = $this->transaksiModel->select('DISTINCT YEAR(created_at) AS tahun, MONTH(created_at) AS bulan, MONTHNAME(created_at) AS nama_bulan')->find();
        $data = ['kalendar' => $kalendar, 'jumlah_transaksi' => $countTransaksi, 'tagihan' => $tagihan, 'sudah_bayar' => $sudahBayar, 'selisih' => $selisih];
        return view('pages/laporan/transaksi/index', $data);
    }

    public function getJsonDataTransaksi()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');
        $tglAwal = $this->request->getGet('tglAwal');
        $tglAkhir = $this->request->getGet('tglAkhir');
        $jenis = $this->request->getGet('jenis');
        if ($tglAwal != "undefined" && $tglAkhir != "undefined" && $bulan != "" && $tahun != "") {
            $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where("transaksi.created_at BETWEEN '$tglAwal' AND '$tglAkhir'");
            if ($jenis != "") {
                $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where("transaksi.created_at BETWEEN '$tglAwal' AND '$tglAkhir'")->where('transaksi.jenis_layanan', $jenis);
            }
        } else if ($bulan != "" && $tahun != "") {
            $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where('YEAR(transaksi.created_at)', $tahun)->Where('MONTH(transaksi.created_at)', $bulan);
            if ($jenis != "") {
                $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where('YEAR(transaksi.created_at)', $tahun)->Where('MONTH(transaksi.created_at)', $bulan)->where('transaksi.jenis_layanan', $jenis);
            }
        } else if ($bulan != "") {
            $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->Where('MONTH(transaksi.created_at)', $bulan);
            if ($jenis != "") {
                $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->Where('MONTH(transaksi.created_at)', $bulan)->where('transaksi.jenis_layanan', $jenis);
            }
        } else if ($tahun != "") {
            $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where('YEAR(transaksi.created_at)', $tahun);
            if ($jenis != "") {
                $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where('YEAR(transaksi.created_at)', $tahun)->where('transaksi.jenis_layanan', $jenis);
            }
        } else {
            $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left');
            if ($jenis != "") {
                $data = $this->transaksiModel->select('transaksi.id, transaksi.kode_transaksi, transaksi.jenis_layanan, transaksi.total_dibayar, customer.no_plat, transaksi.created_at')->join('customer', 'customer.kode_transaksi=transaksi.kode_transaksi', 'left')->where('transaksi.jenis_layanan', $jenis);
            }
        }
        // dd([$date, $data]);
        // dd($data);
        return DataTable::of($data)->addNumbering('no')->add('created_at', function ($row) {
            return date_format(date_create($row->created_at), "d F Y");
        })->add('total_dibayar', function ($row) {
            return "Rp" . number_format($row->total_dibayar, 2, ",", ".");
        })->toJson(true);
    }
}
