<?php

namespace App\Controllers;

use App\Models\modpenyesuaianso;
use mysqli;
use PDO;

class conpersetujuan extends BaseController
{

    protected $model;
    protected $base_link;
    public function __construct()
    {
        $this->model = new modpenyesuaianso();
        $this->base_link = '/jurnal';
        $this->judul = 'JURNAL PENYESUAIAN';
        $this->juduldraft = 'DRAFT JURNAL PENYESUAIAN';
    }
}
