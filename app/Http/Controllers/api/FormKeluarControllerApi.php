<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Form_keluar;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class FormKeluarControllerApi extends Controller
{
    public function index()
    {
        try {
            $data = Form_keluar::join('pengambilan_barangs', 'pengambilan_barangs.id', '=', 'form_keluars.id_pengambilan')
                ->select('form_keluars.*', 'pengambilan_barangs.kode_pengambilan', 'pengambilan_barangs.jumlah as jumlah_pengajuan')
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
            $data = Form_keluar::find($id);
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
