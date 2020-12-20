<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class perusahaanModel extends Model
{
    protected $table      = 'perusahaan';
    protected $primaryKey = 'id_perusahaan';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'email_perusahaan', 'password', 'nama_perusahaan', 'alamat', 'lokasi',
        'industri', 'tahun_berdiri', 'img_perusahaan'
    ];

    public function getPerusahaan($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_perusahaan' => $id])->first();
    }
}
