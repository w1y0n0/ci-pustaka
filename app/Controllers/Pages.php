<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Pages extends BaseController
{
    public function index()
    {
        echo view('layout/header');
        echo view('layout/home');
        echo view('layout/footer');
    }
}
