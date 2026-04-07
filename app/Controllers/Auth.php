<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function loginProcess()
    {
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && $user['password'] == $password) {
            session()->set([
                'id'   => $user['id'],
                'nama' => $user['nama'],
                'role' => $user['role'],
                'foto' => $user['foto']
            ]);

            if ($user['role'] == 'admin') return redirect()->to('/admin/dashboard');
            if ($user['role'] == 'penjual') return redirect()->to('/penjual/dashboard');
            return redirect()->to('/pembeli/dashboard');
        }

        return redirect()->back()->with('error', 'Username atau Password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}