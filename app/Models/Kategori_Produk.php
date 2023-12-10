<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori_Produk extends Model
{
    use HasFactory;
    protected $table = "kategori_produk";
    public $primaryKey = "id_kategori";
    protected $fillable = ['nama_kategori'];
}
