<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use CodeIgniter\HTTP\ResponseInterface;

class Produk extends BaseController
{
    protected $produk;

    function __construct()
    {
        $this->produk = new ProdukModel();
    }

    public function index()
    {
        return view('v_produk');
    }

    public function ambilSemua()
    {
        $data = $this->produk->findAll(); //mengambil semua data dari tabel

        return json_encode($data); //merubah $data menjadi json
    }

    public function simpan()
    {
        $this->produk->insert([
            'nama_produk'=> $this->request->getVar('namaProduk'), //getVar('namaProduk') diambil bukan nama tabel tp yg warna biru
            'harga'=> $this->request->getVar('harga'), 
            'stok'=> $this->request->getVar('stok')
        ]);

        return 'sukses';
    }

    public function edit()
    {
        $id = $this->request->getVar('id');
        $data = $this->produk->find($id);

        return json_encode($data);
    }

    public function update()
    {
        $id = $this->request->getVar('id');

        $this->produk->update($id,[
            'nama_produk' => $this->request->getVar('namaProduk'),
            'harga' => $this->request->getVar('harga'),
            'stok' => $this->request->getVar('stok'),
        ]);
    }

    public function delete()
    {
        $id = $this->request->getVar('id');
        $this->produk->delete($id);

    }
}