<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

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
            'buku'  => $this->BukuModel->getBuku()
        ];

        return view('buku/index', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Buku',
            'buku'  => $this->BukuModel->getBuku($id)
        ];

        if (empty($data['buku'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul buku ' . $id . ' tidak ditemukan.');
        }

        return view('buku/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title'      => 'Form Tambah Data Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('buku/tambah', $data);
    }

    public function simpan()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules'  => 'required|is_unique[buku.judul]',
                'errors' => [
                    'required'  => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
            ],
            'pengarang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'tahun_terbit' => [
                'rules'  => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required'     => '{field} buku harus diisi.',
                    'numeric'      => '{field} buku harus berupa angka.',
                    'exact_length' => '{field} buku harus terdiri dari 4 karakter angka.'
                ]
            ],
            'sampul' => [
                'rules'  => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 1MB.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in'  => 'Format gambar tidak sesuai. Hanya jpg, jpeg, png yang diperbolehkan.'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/buku/tambah')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');

        if ($fileSampul->getError() == 4) {
            // tidak upload gambar
            $namaSampul = 'default.png';
        } else {
            // upload gambar baru
            $fileSampul->move('img');
            $namaSampul = $fileSampul->getName();
        }

        $this->BukuModel->save([
            'judul'       => $this->request->getVar('judul'),
            'pengarang'   => $this->request->getVar('pengarang'),
            'penerbit'    => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul'      => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/buku');
    }

    // hapus data buku
    public function hapus($id)
    {
        // cari gambar berdasarkan id
        $buku = $this->BukuModel->getBuku($id);

        // cek jika file gambarnya default.png
        if ($buku['sampul'] != 'default.png') {
            // hapus gambar
            unlink('img/' . $buku['sampul']);
        }

        $this->BukuModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/buku');
    }

    // ubah data buku
    public function ubah($id)
    {
        $data = [
            'title'      => 'Form Ubah Data Buku',
            'validation' => \Config\Services::validation(),
            'buku'       => $this->BukuModel->getBuku($id)
        ];

        return view('buku/ubah', $data);
    }

    // update data buku
    public function update($id)
    {
        // cek judul
        $bukuLama = $this->BukuModel->getBuku($id);

        if ($bukuLama['judul'] == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[buku.judul]';
        }
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules'  => $rule_judul,
                'errors' => [
                    'required'  => '{field} buku harus diisi.',
                    'is_unique' => '{field} buku sudah terdaftar.'
                ]
            ],
            'pengarang' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'penerbit' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} buku harus diisi.'
                ]
            ],
            'tahun_terbit' => [
                'rules'  => 'required|numeric|exact_length[4]',
                'errors' => [
                    'required'     => '{field} buku harus diisi.',
                    'numeric'      => '{field} buku harus berupa angka.',
                    'exact_length' => '{field} buku harus terdiri dari 4 karakter angka.'
                ]
            ],
            'sampul' => [
                'rules'  => 'if_exist|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 1MB.',
                    'is_image' => 'Yang anda pilih bukan gambar.',
                    'mime_in'  => 'Format gambar tidak sesuai. Hanya jpg, jpeg, png yang diperbolehkan.'
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            return redirect()->to('/buku/ubah/' . $id)->withInput()->with('validation', $this->validator);;
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            // tidak upload gambar baru → pakai yang lama
            $namaSampul = $bukuLama['sampul'];
        } else {
            // upload gambar baru
            $fileSampul->move('img');
            $namaSampul = $fileSampul->getName();

            // hapus gambar lama (jika bukan default)
            if ($bukuLama['sampul'] != 'default.png') {
                unlink('img/' . $bukuLama['sampul']);
            }
        }

        $this->BukuModel->save([
            'id_buku'    => $id,
            'judul'      => $this->request->getVar('judul'),
            'pengarang'  => $this->request->getVar('pengarang'),
            'penerbit'   => $this->request->getVar('penerbit'),
            'tahun_terbit' => $this->request->getVar('tahun_terbit'),
            'sampul'     => $namaSampul
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah.');
        return redirect()->to('/buku');
    }

    public function form_add()
    {
        $data = [
            'title' => 'Form Add Data Buku',
            'validation' => \Config\Services::validation()
        ];

        return view('buku/form_add', $data);
    }

    public function create_buku()
    {
        // rules validasi input
        $rules = [
            'judul' => 'required',
            'pengarang' => 'required',
            // 'penerbit' => 'required',
            // 'tahun_terbit' => 'required|numeric|exact_length[4]',
            // 'sampul' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]'
        ];

        $data = [
            'judul' => $this->request->getVar('judul'),
            'pengarang' => $this->request->getVar('pengarang'),
        ];

        // jika validasi gagal
        if (! $this->validateData($data, $rules)) {
            session()->setFlashdata('failed', 'Data buku gagal ditambahkan. Silakan periksa kembali inputan Anda.');
            return redirect()->back()->withInput();
        }
    }
}
