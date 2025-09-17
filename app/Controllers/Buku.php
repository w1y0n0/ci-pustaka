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
}
