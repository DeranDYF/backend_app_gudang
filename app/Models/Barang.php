<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_barang',
        'jumlah',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
