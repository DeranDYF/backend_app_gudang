<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Form_keluar;
use App\Models\Form_masuk;
use App\Models\Pengambilan_barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index_stok()
    {
        $data['activeMenu'] = 'stok_barang';
        $data['title'] = 'STOK BARANG';
        return view('barang/stok_barang', $data);
    }

    public function getAllBarang()
    {
        $data = Barang::all();
        return response()->json($data);
    }

    protected function getBarangById($id)
    {
        $data = Barang::find($id);
        return response()->json($data);
    }

    protected function addBarang(Request $request)
    {
        $find = Barang::where('nama_barang', $request->input('barang-add-barang-name'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Barang Sudah Terdaftar!'));
        } else {
            if ($request->input('barang-add-barang-jumlah') < 0) {
                echo json_encode(array('success' => false, 'msg' => 'Stok Barang Minimal 0!'));
            } else {
                $create = Barang::create([
                    'nama_barang'  => $request->input('barang-add-barang-name'),
                    'jumlah'       => $request->input('barang-add-barang-jumlah'),
                    'created_by'   => $request->input('barang-add-barang-created'),
                ]);
                if ($create) {
                    echo json_encode(array('success' => true, 'msg' => 'Tambah Barang Berhasil!'));
                } else {
                    echo json_encode(array('success' => false, 'msg' => 'Tambah Barang Gagal!'));
                }
            }
        }
    }

    protected function editBarang(Request $request)
    {
        if ($request->input('barang-edit-barang-jumlah') == 0) {
            echo json_encode(array('success' => false, 'msg' => 'Stok Barang Minimal 1!'));
        } else {
            $update = Barang::find($request->input('barang-edit-barang-id'))
                ->update([
                    'nama_barang'  => $request->input('barang-edit-barang-name'),
                    'jumlah'       => $request->input('barang-edit-barang-jumlah'),
                ]);
            if ($update) {
                echo json_encode(array('success' => true, 'msg' => 'Edit Barang Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Edit Barang Gagal!'));
            }
        }
    }

    protected function deleteBarang($id)
    {
        $delete = Barang::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus Barang Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus Barang Gagal!'));
        }
    }

    public function index_masuk()
    {
        $data['activeMenu'] = 'form_masuk';
        $data['title'] = 'FORM MASUK';
        return view('barang/form_masuk', $data);
    }

    public function getAllMasuk()
    {
        $data = Form_masuk::all();
        return response()->json($data);
    }


    protected function getMasukById($id)
    {
        $data = Form_masuk::join('barangs', 'barangs.id', '=', 'form_masuks.id_barang')
            ->where('form_masuks.id', $id)
            ->select('form_masuks.*', 'barangs.nama_barang')
            ->get();
        return response()->json($data);
    }

    protected function addMasuk(Request $request)
    {

        $Pengambilanterbaru = Form_masuk::orderBy('created_at', 'desc')->first();
        $newId = 1;

        if ($Pengambilanterbaru) {
            $latestId = intval(substr($Pengambilanterbaru->kode_masuk, -3));
            $newId = $latestId + 1;
        }
        $newIdFormatted = str_pad($newId, 3, '0', STR_PAD_LEFT);
        $kode = 'WH-IN-' . now()->format('d/m/Y') . '-' . $newIdFormatted;
        $create = Form_masuk::create([
            'id_barang'     => $request->input('masuk-add-name'),
            'kode_masuk'    => $kode,
            'jumlah'        => $request->input('masuk-add-jumlah'),
            'created_by'    => $request->input('masuk-add-created'),
        ]);
        if ($create) {
            $find = Barang::find($request->input('masuk-add-name'));
            $update = Barang::find($request->input('masuk-add-name'))
                ->update([
                    'jumlah' => $find->jumlah + $request->input('masuk-add-jumlah'),
                ]);
            if ($update) {
                echo json_encode(array('success' => true, 'msg' => 'Form Masuk Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Update Stok  Gagal!'));
            }
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Form Masuk Gagal!'));
        }
    }

    public function index_keluar()
    {
        $data['activeMenu'] = 'form_keluar';
        $data['title'] = 'FORM KELUAR';
        return view('barang/form_keluar', $data);
    }

    public function getAllKeluar()
    {
        $data = Form_keluar::join('pengambilan_barangs', 'pengambilan_barangs.id', '=', 'form_keluars.id_pengambilan')
            ->select('form_keluars.*', 'pengambilan_barangs.jumlah as jumlah_pengajuan')
            ->get();
        return response()->json($data);
    }

    public function getAllPengambilanKeluar()
    {
        $data = Pengambilan_barang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
            ->where('pengambilan_barangs.status', 'Di Setujui')
            ->select('pengambilan_barangs.*', 'barangs.nama_barang')
            ->get();
        return response()->json($data);
    }

    protected function getKeluarById($id)
    {
        $data = Form_keluar::join('pengambilan_barangs', 'pengambilan_barangs.id', '=', 'form_keluars.id_pengambilan')
            ->where('form_keluars.id', $id)
            ->select('form_keluars.*', 'pengambilan_barangs.jumlah as jumlah_pengajuan', 'pengambilan_barangs.kode_pengambilan')
            ->get();
        return response()->json($data);
    }

    protected function addKeluar(Request $request)
    {

        $Pengambilanterbaru = Form_keluar::orderBy('created_at', 'desc')->first();
        $newId = 1;

        if ($Pengambilanterbaru) {
            $latestId = intval(substr($Pengambilanterbaru->kode_keluar, -3));
            $newId = $latestId + 1;
        }
        $newIdFormatted = str_pad($newId, 3, '0', STR_PAD_LEFT);
        $kode = 'WH-OUT-' . now()->format('d/m/Y') . '-' . $newIdFormatted;
        $create = Form_keluar::create([
            'id_pengambilan'  => $request->input('keluar-add-name')[1],
            'kode_keluar'     => $kode,
            'jumlah'          => $request->input('keluar-add-jumlah'),
            'keterangan'      => $request->input('pengambilan-keterangan'),
            'created_by'      => $request->input('keluar-add-created'),
        ]);
        if ($create) {
            $find = Barang::find($request->input('keluar-add-name')[3]);
            $update = Barang::find($request->input('keluar-add-name')[3])
                ->update([
                    'jumlah'         => $find->jumlah - $request->input('keluar-add-jumlah'),
                ]);
            if ($update) {
                echo json_encode(array('success' => true, 'msg' => 'Form Keluar Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Update Stok  Gagal!'));
            }
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Form Keluar Gagal!'));
        }
    }
}