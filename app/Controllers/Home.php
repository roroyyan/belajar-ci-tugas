<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\DiskonModel; // Tambahan untuk ambil diskon otomatis

class Home extends BaseController
{
    protected $product;
    protected $transaction;
    protected $transaction_detail;

    public function __construct()
    {
        helper(['form', 'number']);
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
    }

    public function index()
    {
        // Ambil produk
        $product = $this->product->findAll();
        $data['product'] = $product;

        // Cek diskon untuk hari ini
        $diskonModel = new DiskonModel();
        $hariIni = date('Y-m-d');

        $diskonHariIni = $diskonModel
            ->where('tanggal', $hariIni)
            ->orderBy('id', 'DESC')
            ->first();

        if ($diskonHariIni) {
            session()->set('diskon_nominal', $diskonHariIni['nominal']);
        } else {
            session()->remove('diskon_nominal');
        }

        return view('v_home', $data);
    }

    public function profile()
    {
        $username = session()->get('username');
        $data['username'] = $username;

        $buy = $this->transaction
            ->where('username', $username)
            ->findAll();

        $data['buy'] = $buy;

        $product = [];

        if (!empty($buy)) {
            foreach ($buy as $item) {
                $detail = $this->transaction_detail
                    ->select('transaction_detail.*, product.nama, product.harga, product.foto')
                    ->join('product', 'transaction_detail.product_id=product.id')
                    ->where('transaction_id', $item['id'])
                    ->findAll();

                if (!empty($detail)) {
                    $product[$item['id']] = $detail;
                }
            }
        }

        $data['product'] = $product;

        return view('v_profile', $data);
    }
}