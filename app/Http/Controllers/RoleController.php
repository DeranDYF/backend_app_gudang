<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'role';
        $data['title'] = 'ROLE';
        return view('admin/role', $data);
    }

    public function getAllRole()
    {
        $data = Role::all();
        return response()->json($data);
    }

    protected function getRoleById($id)
    {
        $data = Role::find($id);
        return response()->json($data);
    }

    protected function addRole(Request $request)
    {
        $find = Role::where('role_name', $request->input('role-add-role-name'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'Role Sudah Terdaftar!'));
        } else {
            $create = Role::create([
                'role_name'   => $request->input('role-add-role-name'),
                'description' => $request->input('role-add-description'),
            ]);
            if ($create) {
                echo json_encode(array('success' => true, 'msg' => 'Tambah Role Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Tambah Role Gagal!'));
            }
        }
    }

    protected function editRole(Request $request)
    {
        $update = Role::find($request->input('role-edit-id'))
            ->update([
                'role_name'   => $request->input('role-edit-role-name'),
                'description' => $request->input('role-edit-description'),
            ]);
        if ($update) {
            echo json_encode(array('success' => true, 'msg' => 'Edit Role Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Edit Role Gagal!'));
        }
    }


    protected function deleteRole($id)
    {
        $delete = Role::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus Role Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus Role Gagal!'));
        }
    }
}
