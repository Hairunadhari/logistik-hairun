<?php

namespace App\Http\Controllers;

use App\Models\StokBarang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = BarangMasuk::all();
            return DataTables::of($data)->make(true);
        }
        return view('barang_masuk.barang_masuk');
    }

    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'qty' => 'required|integer|min:1',
            'origin' => 'required',
            'tanggal_masuk' => 'required',
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
                $barangMasuk = BarangMasuk::where('kode_barang',$request->kode_barang)->first();
                if ($barangMasuk) {
                    $barangMasuk->update([
                        'qty'=> $barangMasuk->qty + $request->qty,
                        'origin'=>$request->origin,
                        'tanggal_masuk'=>$request->tanggal_masuk,
                    ]);
                }else {
                    BarangMasuk::create($request->all());
                }

                $stok = StokBarang::where('kode_barang', $request->kode_barang)->first();
                if ($stok) {
                    $stok->stok += $request->qty;
                    $stok->save();
                } else {
                    StokBarang::create([
                        'kode_barang' => $request->kode_barang,
                        'stok' => $request->qty,
                    ]);
                }
                
                
                DB::commit();
                
            } catch (\Throwable $th) {
                DB::rollback();
                
                return back()->with('alert', [
                    'title' => 'Ada Kesalahan',
                    'text' => $th->getMessage(),
                    'icon' => 'error',
                ]);
            }
            return redirect('/')->with('alert', [
                'title' => 'Sukses',
                'text' => 'Data berhasil ditambah',
                'icon' => 'success',
            ]);
    }
   

}
