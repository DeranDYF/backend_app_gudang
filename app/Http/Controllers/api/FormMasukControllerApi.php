<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form_masuk;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FormMasukControllerApi extends Controller
{
    public function index()
    {
        try {
            $data = Form_masuk::join('barangs', 'barangs.id', '=', 'form_masuks.id_barang')
                ->select('form_masuks.*', 'barangs.nama_barang')
                ->get();
            return response()->json($data, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $data = Form_masuk::find($id);
            if (!$data) {
                throw new \Exception('Form Keluar not found');
            }

            DB::beginTransaction();
            $data->delete();
            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Hapus Form Keluar Berhasil!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Hapus Form Keluar Gagal']);
        }
    }
}
