<?php

namespace App\Http\Controllers\API;
use App\Models\Produk;
use App\Models\Kategori_Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Produk::getProduk()->paginate(5);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validasi=$request->validate([
            'nama_produk'=>'required',
            'deskripsi_produk'=>'required',
            'harga_produk'=>'required|numeric',
            'foto_produk'=>'required|file|mimes:png,jpg',
            'id_kategori'=>'required',
        ]);
         try { 
           $fileName = time().$request->file('foto_produk')->getClientOriginalName(); 
           $path = $request->file('foto_produk')->storeAs('upload/produk',$fileName); 
           $validasi['foto_produk']=$path; 
           $response = Produk::create($validasi);
           return response()->json([
                'success'=>true,
                'message'=>'success'
                // 'data'=>$response
           ]);
        } 
        catch (\Exception $e) { 
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
            ]);
        }
    }

    function kategoriProduk(){
        //
        $data = Kategori_Produk::all();
        return response()->json($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Produk::find($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
         $validasi=$request->validate([
            'nama_produk'=>'required',
            'deskripsi_produk'=>'required',
            'harga_produk'=>'required|numeric',
            'foto_produk'=>'required|file|mimes:png,jpg',
            'id_kategori'=>'required',
        ]);
         try { 
           //mengambil kondisi hanya saat file foto diisi
           if($request->file('foto_produk')){
                $fileName = time().$request->file('foto_produk')->getClientOriginalName(); 
                $path = $request->file('foto_produk')->storeAs('upload/produk',$fileName); 
                $validasi['foto_produk']=$path; 
           }
           $response = Produk::find($id);
           $response->update($validasi);
           return response()->json([
                'success'=>true,
                'message'=>'success'
                // 'data'=>$response
           ]);
        } 
        catch (\Exception $e) { 
            return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
            ]);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            //code...
            $produk=Produk::find($id);
            $produk->delete();
            return response()->json([
                'success'=>true,
                'message'=>'success'
            ]);
        } catch (\Expection $e) {
            //throw $th;
             return response()->json([
                'message'=>'Err',
                'errors'=>$e->getMessage()
            ]);
        }
        
    }
}
