<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Form_keluar;
use App\Models\Form_masuk;
use App\Models\Pengambilan_barang;
use App\Models\User;
use App\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'dashboard';
        $data['title'] = 'DASHBOARD';

        return view('dashboard/dashboard', $data);
    }
}
