<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StokBarangController extends Controller
{
    public function index(){
        // $data = StokBarang::all();
        // $barangMasuk = BarangMasuk::select('kode_barang', \DB::raw('SUM(qty) as total_qty'))
        //     ->groupBy('kode_barang')
        //     ->pluck('total_qty', 'kode_barang');

        // foreach ($data as $key) {
        //     $key->stokMasuk = $barangMasuk[$key->kode_barang] ?? 0;
        // }

        // dd($data);

        if (request()->ajax()) {
            $data = StokBarang::all();
            $barangMasuk = BarangMasuk::select('kode_barang', \DB::raw('SUM(qty) as total_qty'))
                ->groupBy('kode_barang')
                ->pluck('total_qty', 'kode_barang');
            $barangKeluar = BarangKeluar::select('kode_barang', \DB::raw('SUM(qty) as total_qty'))
                ->groupBy('kode_barang')
                ->pluck('total_qty', 'kode_barang');
    
            foreach ($data as $key) {
                $key->stokMasuk = $barangMasuk[$key->kode_barang] ?? 0;
                $key->stokKeluar = $barangKeluar[$key->kode_barang] ?? 0;
            }
    
            return DataTables::of($data)->make(true);
        }
        return view('stok_barang.stok_barang');
    }
    
}
