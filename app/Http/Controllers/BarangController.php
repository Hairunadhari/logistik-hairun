<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\Validator;

class BarangController extends Controller
{
    public function index(){
        $data = Barang::paginate(10);
        return view('barang.barang',compact('data'));
    }

    public function submit(Request $request){
        try {
            Barang::create([
                'nama_barang'=>$request->nama_barang,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('alert',[
                'title'=>'Ada Kesalahan',
                'text'=> $th->getMessage(),
                'icon'=>'error'
            ]);
        }

        return redirect('/')->with('alert',[
            'title'=>'Sukses',
            'text'=> 'Data berhasil ditambah',
            'icon'=>'success'
        ]);
    }

    public function update(Request $request, $id){
        try {
            $data = Barang::find($id);
            $data->update([
                'nama_barang'=>$request->nama_barang,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('alert',[
                'title'=>'Ada Kesalahan',
                'text'=> $th->getMessage(),
                'icon'=>'error'
            ]);
        }

        return redirect('/')->with('alert',[
            'title'=>'Sukses',
            'text'=> 'Data berhasil diupdate',
            'icon'=>'success'
        ]);
    }

    public function delete($id){
        try {
            $data = Barang::find($id);
            $data->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('alert',[
                'title'=>'Ada Kesalahan',
                'text'=> $th->getMessage(),
                'icon'=>'error'
            ]);
        }

        return redirect('/')->with('alert',[
            'title'=>'Sukses',
            'text'=> 'Data berhasil dihapus',
            'icon'=>'success'
        ]);
    }

}
