<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data['activeMenu'] = 'user';
        $data['title'] = 'USER';
        return view('admin/user', $data);
    }

    protected function getAllUser()
    {
        $data = User::join('roles', 'roles.id', '=', 'users.id_role')
            ->select('users.*', 'roles.role_name')
            ->get();
        return response()->json($data);
    }

    protected function getUserById($id)
    {
        $data = User::find($id);
        return response()->json($data);
    }

    protected function addUser(Request $request)
    {
        $find = User::where('username', $request->input('user-add-user-username'))->first();
        if ($find) {
            echo json_encode(array('success' => false, 'msg' => 'User Sudah Terdaftar!'));
        } else {
            $create = User::create([
                'name'       => $request->input('user-add-user-name'),
                'username'   => $request->input('user-add-user-username'),
                'email'      => $request->input('user-add-user-email'),
                'id_role'    => $request->input('user-add-user-role'),
                'password'   => bcrypt($request->input('user-add-user-password')),
                'created_by' => $request->input('user-add-user-created'),
            ]);
            if ($create) {
                echo json_encode(array('success' => true, 'msg' => 'Tambah User Berhasil!'));
            } else {
                echo json_encode(array('success' => false, 'msg' => 'Tambah User Gagal!'));
            }
        }
    }

    protected function editUser(Request $request)
    {
        $update = User::find($request->input('user-edit-user-id'))
            ->update([
                'name'       => $request->input('user-edit-user-name'),
                'email'      => $request->input('user-edit-user-email'),
                'id_role'    => $request->input('user-edit-user-role'),
            ]);
        if ($update) {
            echo json_encode(array('success' => true, 'msg' => 'Edit User Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Edit User Gagal!'));
        }
    }


    protected function deleteUser($id)
    {
        $delete = User::find($id)->delete();
        if ($delete) {
            echo json_encode(array('success' => true, 'msg' => 'Hapus User Berhasil!'));
        } else {
            echo json_encode(array('success' => false, 'msg' => 'Hapus User Gagal!'));
        }
    }
}
