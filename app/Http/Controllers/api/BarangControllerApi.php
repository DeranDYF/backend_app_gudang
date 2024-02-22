<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class BarangControllerApi extends Controller
{
    public function index()
    {
        try {
            $data = Barang::all();
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
            $data = Barang::find($id);
            if (!$data) {
                throw new \Exception('Barang not found');
            }

            DB::beginTransaction();
            $data->delete();
            DB::commit();

            return response()->json(['success' => true, 'msg' => 'Hapus Barang Berhasil!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'msg' => 'Hapus barang Gagal']);
        }
    }
}
