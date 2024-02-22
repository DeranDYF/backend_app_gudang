<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Models\Jurusan;

class JurusanControllerApi extends Controller
{
    public function index()
    {
        try {
            $jurusan = Jurusan::all();
            return response()->json($jurusan, Response::HTTP_OK);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $find = Jurusan::where('kode_jurusan', $request->input('kode_jurusan'))->first();

            if ($find) {
                return response()->json(['success' => false, 'msg' => 'Kode Jurusan Sudah Terdaftar!']);
            }

            $create = Jurusan::create([
                'kode_jurusan' => $request->input('kode_jurusan'),
                'nama_jurusan' => $request->input('nama_jurusan'),
                'created_by' => $request->input('created'),
            ]);

            if ($create) {
                return response()->json(['success' => true, 'msg' => 'Tambah Jurusan Berhasil!']);
            }

            return response()->json(['success' => false, 'msg' => 'Tambah Jurusan Gagal!']);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $update = Jurusan::find($id)->update([
                'nama_jurusan' => $request->input('nama_jurusan'),
            ]);

            if ($update) {
                return response()->json(['success' => true, 'msg' => 'Edit Jurusan Berhasil!']);
            }

            return response()->json(['success' => false, 'msg' => 'Edit Jurusan Gagal!']);
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
            $delete = Jurusan::find($id)->delete();

            if ($delete) {
                return response()->json(['success' => true, 'msg' => 'Hapus Jurusan Berhasil!']);
            }

            return response()->json(['success' => false, 'msg' => 'Hapus Jurusan Gagal!']);
        } catch (\Exception $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
