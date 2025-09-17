<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use CodeIgniter\HTTP\ResponseInterface;

class Buku extends BaseController
{
    protected $BukuModel;
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Buku',
            'buku' => $this->BukuModel->getBuku()
        ];

        return view('buku/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku' => $this->BukuModel->getBuku($id)
        ];

        // jika buku tidak ada di tabel
        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku ' . $id . ' tidak ditemukan.');
        }

        return view('buku/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Form Tambah Data Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required' => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
            ],
            'pengarang' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'tahun_terbit' => [
                'rules' => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required' => '{field} buku harus diisi.',
                    'numeric' => '{field} buku harus berupa angka.',
                    'exact_length' => '{field} buku harus terdiri dari 4 karakter angka.'
                ]
            ],
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar sampul buku terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 1MB.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in' => 'Format gambar tidak sesuai. Hanya jpg, jpeg, png yang diperbolehkan.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/buku/tambah')->withInput()->with('validation', $validation);
            // return redirect()->to('/buku/tambah')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // pindahkan ke folder img
        $fileSampul->move('img');
        // ambil nama file
        $namaSampul = $fileSampul->getName();

        $this->BukuModel->save([
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
            'penerbit' => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/buku');
    }

}
