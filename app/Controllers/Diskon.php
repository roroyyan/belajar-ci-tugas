<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class Diskon extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    private function checkAdmin()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('failed', 'Akses ditolak, hanya untuk admin');
        }
    }

    public function index()
    {
        $this->checkAdmin();

        $data['diskon'] = $this->diskonModel->findAll();
        $data['errors'] = session()->getFlashdata('errors');
        return view('v_diskon', $data);
    }

    public function store()
    {
        $this->checkAdmin();

        $rules = [
            'tanggal' => 'required|is_unique[diskon.tanggal]',
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('failed', 'Tanggal diskon sudah tersedia. Tidak bisa menambahkan diskon lagi di tanggal yang sama.');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->diskonModel->save([
            'tanggal' => $this->request->getPost('tanggal'),
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil ditambahkan');
    }

    public function update($id)
    {
        $this->checkAdmin();

        $rules = [
            'nominal' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            session()->setFlashdata('failed', 'Nominal tidak valid.');
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->diskonModel->update($id, [
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('/diskon')->with('success', 'Diskon berhasil diubah');
    }

    public function delete($id)
    {
        $this->checkAdmin();
        $this->diskonModel->delete($id);
        return redirect()->to('/diskon')->with('success', 'Diskon berhasil dihapus');
    }
}