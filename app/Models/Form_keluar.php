<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form_keluar extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pengambilan',
        'kode_keluar',
        'jumlah',
        'created_by',
        'created_at',
        'updated_at',
    ];
}
