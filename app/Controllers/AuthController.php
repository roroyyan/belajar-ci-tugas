<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DiskonModel;

class AuthController extends BaseController
{
    protected $user;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();
    }

    public function login()
    {
        if ($this->request->getPost()) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first();

            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    // Set session login
                    session()->set([
                        'username'   => $dataUser['username'],
                        'role'       => $dataUser['role'],
                        'isLoggedIn' => true
                    ]);

                    // Set diskon hari ini (jika ada)
                    $diskonModel = new DiskonModel();
                    $today       = date('Y-m-d');
                    $diskon      = $diskonModel->where('tanggal', $today)->first();

                    if ($diskon) {
                        session()->set('diskon_nominal', $diskon['nominal']);
                    } else {
                        session()->remove('diskon_nominal');
                    }

                    // ✅ Redirect sesuai role
                    if ($dataUser['role'] === 'admin') {
                        return redirect()->to('/produk');
                    } elseif ($dataUser['role'] === 'guest') {
                        return redirect()->to('/');
                    } else {
                        return redirect()->to('/'); // fallback
                    }

                } else {
                    session()->setFlashdata('failed', 'Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            return view('v_login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}