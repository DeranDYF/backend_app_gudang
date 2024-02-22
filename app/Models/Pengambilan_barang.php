<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengambilan_barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_barang',
        'kode_pengambilan',
        'jumlah',
        'status',
        'keterangan',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
