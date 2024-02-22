<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengambilan_barang;
use App\Models\Barang;

class PengambilanBarangController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'pengambilan_barang';
        $data['title'] = 'PENGAMBILAN BARANG';
        return view('pengajuan/pengambilan', $data);
    }

    public function getAllPengambilan()
    {
        if (auth()->user()->role->role_name == 'admin' || auth()->user()->role->role_name == 'keeper') {
            $data = Pengambilan_barang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
                ->select('pengambilan_barangs.*', 'barangs.nama_barang')
                ->get();
        } else {
            $data = Pengambilan_barang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
                ->where('pengambilan_barangs.created_by', auth()->user()->username)
                ->select('pengambilan_barangs.*', 'barangs.nama_barang')
                ->get();
        }

        return response()->json($data);
    }


    public function getAllBarang()
    {
        $data = Barang::where('jumlah', '>', 0)->get();
        return response()->json($data);
    }

    public function getPengambilanById($id)
    {
        $data = Pengambilan_barang::find($id);
        return response()->json($data);
    }

    public function update_persetujuan(Request $request)
    {
        $update = Pengambilan_barang::find($request->input('pengambilan-persetujuan-pengambilan-id'))
            ->update([
                'status'      => $request->input('pengambilan-persetujuan'),
                'keterangan'  => $request->input('pengambilan-keterangan'),
            ]);
        if ($update) {
            echo json_encode(array('success' => true, 'msg' => 'Edit Barang Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Edit Barang Gagal!'));
        }
    }

    public function addPengambilan(Request $request)
    {
        $Pengambilanterbaru = Pengambilan_barang::orderBy('created_at', 'desc')->first();
        $newId = 1;

        if ($Pengambilanterbaru) {
            $latestId = intval(substr($Pengambilanterbaru->kode_pengambilan, -3));
            $newId = $latestId + 1;
        }
        $newIdFormatted = str_pad($newId, 3, '0', STR_PAD_LEFT);
        $kode_pengambilan = 'WH-PB-' . now()->format('d/m/Y') . '-' . $newIdFormatted;
        $create = Pengambilan_barang::create([
            'id_barang'        => $request->input('pengambilan-add-pengambilan-name'),
            'kode_pengambilan' => $kode_pengambilan,
            'jumlah'           => $request->input('pengambilan-add-pengambilan-jumlah'),
            'status'           => 'Menunggu Persetujuan',
            'created_by'       => $request->input('pengambilan-add-pengambilan-created'),
        ]);

        if ($create) {
            echo json_encode(array('success' => true, 'msg' => 'Tambah Barang Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Tambah Barang Gagal!'));
        }
    }

    protected function editPengambilan(Request $request)
    {
        if ($request->input('pengambilan-edit-pengambilan-jumlah') <= 0) {
            echo json_encode(array('success' => false, 'msg' => 'Pengajuan Barang Minimal 1!'));
        } else {
            $update = Pengambilan_barang::find($request->input('pengambilan-edit-pengambilan-id'))
                ->update([
                    'id_barang'  => $request->input('pengambilan-edit-pengambilan-name'),
                    'jumlah'       => $request->input('pengambilan-edit-pengambilan-jumlah'),
                ]);
            if ($update) {
                echo json_encode(array('success' => true, 'msg' => 'Edit Barang Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Edit Barang Gagal!'));
            }
        }
    }

    protected function deletePengambilan($id)
    {
        $delete = Pengambilan_barang::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus Barang Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus Barang Gagal!'));
        }
    }
}
