<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produk";
    public $primaryKey = "id_produk";
    protected $fillable = ['nama_produk','deskripsi_produk','harga_produk','foto_produk','id_kategori'];
    static function getProduk(){
        $return=DB::table('produk')
        ->join('kategori_produk','produk.id_kategori','=','kategori_produk.id_kategori');
        return $return;
    }
} 
