<?php

namespace App\Http\Controllers;
use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        
        return response()->json([
            'success' => true,
            'message' =>'Data barang yang tersedia',
            'data'    => $barang
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'   => 'required',
            'jenis_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua kolom wajib diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $barang = Barang::create([
                'nama_barang'     => $request->input('nama_barang'),
                'jenis_barang'   => $request->input('jenis_barang'),
                'harga_barang'   => $request->input('harga_barang'),
                'jumlah_barang'   => $request->input('jumlah_barang'),
            ]);
            
            if ($barang) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data barang Berhasil Disimpan!',
                    'data' => $barang
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data barang Gagal Disimpan!',
                ], 400);
            }
            
        }
    }
    
    public function show($id)
    {
        $barang = Barang::find($id);
        
        if ($barang) {
            return response()->json([
                'success'   => true,
                'message'   => 'Detail Data barang',
                'data'      => $barang
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data barang Tidak Ditemukan!',
            ], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang'   => 'required',
            'jenis_barang' => 'required',
            'harga_barang' => 'required',
            'jumlah_barang' => 'required',
        ]);
        
        if ($validator->fails()) {
            
            return response()->json([
                'success' => false,
                'message' => 'Semua Kolom Wajib Diisi!',
                'data'   => $validator->errors()
            ],401);
            
        } else {
            
            $barang = Barang::whereId($id)->update([
                'nama_barang'     => $request->input('nama_barang'),
                'jenis_barang'   => $request->input('jenis_barang'),
                'harga_barang'   => $request->input('harga_barang'),
                'jumlah_barang'   => $request->input('jumlah_barang'),
            ]);
            
            if ($barang) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data barang Berhasil Diupdate!',
                    'data' => $barang
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data barang Gagal Diupdate!',
                ], 400);
            }
            
        }
    }
    
    public function destroy($id)
    {
        $barang = Barang::whereId($id)->first();
        $barang->delete();
        
        if ($barang) {
            return response()->json([
                'success' => true,
                'message' => 'Data barang Berhasil Dihapus!',
            ], 200);
        }
        
    }
    
    
}