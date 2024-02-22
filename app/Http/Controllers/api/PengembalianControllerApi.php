<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengambilan_barang;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PengembalianControllerApi extends Controller
{
    public function index()
    {
        try {
            $data = Pengambilan_barang::join('barangs', 'barangs.id', '=', 'pengambilan_barangs.id_barang')
                ->select('pengambilan_barangs.*', 'barangs.nama_barang')
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
            $data = Pengambilan_barang::find($id);
            if (!$data) {
                throw new \Exception('Pengambilan barang not found');
            }

            DB::beginTransaction();
            $data->delete();
            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Hapus Pengambilan barang Berhasil!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Hapus Pengambilan barang Gagal']);
        }
    }
}
