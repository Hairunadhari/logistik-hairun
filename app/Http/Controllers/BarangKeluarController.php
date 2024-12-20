<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangKeluarController extends Controller
{
    public function index(){
        $data = BarangMasuk::all();
        if (request()->ajax()) {
            $data = BarangKeluar::all();
            return DataTables::of($data)->make(true);
        }
        return view('barang_keluar.barang_keluar',compact('data'));
    }


    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'destination' => 'required',
            'tanggal_keluar' => 'required',
        ]); 

        if ($validator->fails()) {
            $messages = $validator->messages();
            $alertMessage = $messages->first();
        
            return back()->with('alert',[
                'title'=>'Kesalahan Validasi',
                'text'=> $alertMessage,
                'icon'=>'error'
            ]);
        }

        try {
            DB::beginTransaction();
            $stok = StokBarang::where('kode_barang', $request->kode_barang)->first();
            if ($request->qty > $stok->stok) {
                return back()->with('alert',[
                    'title'=>'Ada Kesalahan',
                    'text'=> 'Stok barang tidak cukup ',
                    'icon'=>'error'
                ]);
            }
            BarangKeluar::create($request->all());
            $stok->stok -= $request->qty;
            $stok->save();
            
            DB::commit();

            
        } catch (\Throwable $th) {
            DB::rollback();
            
            return back()->with('alert', [
                'title' => 'Ada Kesalahan',
                'text' => $th->getMessage(),
                'icon' => 'error',
            ]);
        }
        return redirect('/barang-keluar')->with('alert', [
            'title' => 'Sukses',
            'text' => 'Data berhasil ditambah',
            'icon' => 'success',
        ]);
    }
    
    
}
