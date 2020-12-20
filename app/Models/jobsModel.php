<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class jobsModel extends Model
{
    protected $table      = 'jobs';
    protected $primaryKey = 'id_jobs';

    protected $returnType     = 'array';

    protected $allowedFields = [
        'posisi', 'gaji', 'deskripsi', 'id_perusahaan'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getJobs($id = false)
    {
        if ($id == false) {
            $db = \Config\Database::connect();
            $builder = $db->table('jobs');
            $builder->select('*');
            // ->from('perusahaan')->groupStart()->where('jobs.id_perusahaan = perusahaan.id_perusahaan')->groupEnd();
            $builder->join('perusahaan', 'jobs.id_perusahaan = perusahaan.id_perusahaan');
            $query = $builder->get();
            return $query->getResultArray();
        }

        $db = \Config\Database::connect();
        $builder = $db->table('jobs');
        $builder->select('*');
        // ->from('perusahaan')->groupStart()->where('jobs.id_perusahaan = perusahaan.id_perusahaan')->groupEnd();
        $builder->join('perusahaan', 'jobs.id_perusahaan = perusahaan.id_perusahaan');
        $query = $builder->getWhere(['jobs.id_perusahaan' => $id]);
        return $query->getResultArray();
    }

    public function getJobsDetail($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jobs');
        $builder->select('*');
        // ->from('perusahaan')->groupStart()->where('jobs.id_perusahaan = perusahaan.id_perusahaan')->groupEnd();
        $builder->join('perusahaan', 'jobs.id_perusahaan = perusahaan.id_perusahaan');
        $query = $builder->getWhere(['jobs.id_jobs' => $id]);
        return $query->getResultArray();
    }

    public function search($keyword = false)
    {
        if ($keyword) {
            $builder = $this->table('jobs');
            $builder->select('*');
            $builder->join('perusahaan', 'jobs.id_perusahaan = perusahaan.id_perusahaan');
            $builder->like('posisi', $keyword);
            $builder->orLike('lokasi', $keyword);
            return $builder;
        }
        $builder = $this->table('jobs');
        $builder->select('*');
        $builder->join('perusahaan', 'jobs.id_perusahaan = perusahaan.id_perusahaan');
//        $builder->like('posisi', $keyword);
//        $builder->orLike('lokasi', $keyword);
        return $builder;
    }
}