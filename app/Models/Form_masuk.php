<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_masuk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_barang',
        'kode_masuk',
        'jumlah',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
