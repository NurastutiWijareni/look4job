<?php

namespace App\Controllers;

use App\Models\jobsModel;
use App\Models\perusahaanModel;

class Pages extends BaseController
{
    protected $jobsModel;
    protected $perusahaanModel;
    public function __construct()
    {
        $this->jobsModel = new jobsModel();
        $this->perusahaanModel = new perusahaanModel();
    }

    public function index()
    {
        $this->pager = \Config\Services::pager();
        $session = session();
        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $jobs = $this->jobsModel->search($keyword)->paginate(7, 'jobs');
        } else {
            $jobs = $this->jobsModel->paginate(7, 'jobs');
        }
        $perusahaan = $this->jobsModel->getJobs();
        $pager = $this->jobsModel->pager;
        $data = [
            'title' => 'Home',
            'job' => $jobs,
            'perusahaan' => $perusahaan,
            'pager' => $pager
        ];
        return view('/pages/home', $data);
    }

    public function perusahaan()
    {
        $data = [
            'title' => 'Perusahaan'
        ];
        return view('/pages/perusahaan', $data);
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Detail Lowongan',
            'job' => $this->jobsModel->getJobsDetail($id)
        ];
        return view('/pages/detail', $data);
    }

    //CREATE -------------------------------------------------------------------------
    public function createPerusahaan()
    {
        $data = [
            'title' => 'Lengkapi data perusahaan',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/createPerusahaan', $data);
    }

    public function savePerusahaan()
    {
        //validai input
        if (!$this->validate([
            'nama_perusahaan' => [
                'rules' => 'required|is_unique[perusahaan.nama_perusahaan]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} nama perusahaan sudah terdaftar'
                ]
            ],
            'img_perusahaan' => [
                'rules' => 'max_size[img_perusahaan,1024]|is_image[img_perusahaan]|mime_in[img_perusahaan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Format gambar tidak valid',
                    'mime_in' => 'Format gambar tidak valid'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'password2' => [
                'rules' => 'required|matches[password2]',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            return redirect()->to('/pages/createPerusahaan')->withInput();
        }

        //ambil gambar
        $fileImg = $this->request->getFile('img_perusahaan');
        //apakah tidak ada gambar yang diupload
        if ($fileImg->getError() === 4) {
            $namaFile = 'default.jpg';
        } else {
            //generate nama gambar random
            $namaFile = $fileImg->getRandomName();
            //pindahkan file ke folder img
            $fileImg->move('img', $namaFile);
        }


        $this->perusahaanModel->save([
            'email_perusahaan' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'nama_perusahaan' => $this->request->getVar('nama_perusahaan'),
            'alamat' => $this->request->getVar('alamat'),
            'lokasi' => $this->request->getVar('lokasi'),
            'industri' => $this->request->getVar('industri'),
            'tahun_berdiri' => $this->request->getVar('thBerdiri'),
            'img_perusahaan' => $namaFile
        ]);

        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/pages/createPerusahaan');
    }

    public function createJobs($id)
    {
        $data = [
            'job' => $this->perusahaanModel->getPerusahaan($id),
            'title' => 'Unggah Pekerjaan',
            'validation' => \Config\Services::validation()
        ];

        return view('pages/createJobs', $data);
    }

    public function saveJobs($id)
    {
        $this->jobsModel->save([
            'posisi' => $this->request->getVar('posisi'),
            'gaji' => $this->request->getVar('gaji'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'id_perusahaan' => $id
        ]);

        session()->setFlashData('pesan', 'Lowongan berhasil diunggah');
        return redirect()->to('/pages/createJobs/' . $id);
    }

    public function profil($id)
    {

        $data = [
            'title' => 'Profil',
            'job' => $this->perusahaanModel->getPerusahaan($id),
            'job2' => $this->jobsModel->getJobs($id)
        ];
        return view('pages/profil', $data);
    }

    public function login()
    {
        helper(['form']);
        $data = [
            'title' => 'Login'
        ];

        return view('pages/login', $data);
    }

    public function auth()
    {
        $session = session();
        $model = $this->perusahaanModel;
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email_perusahaan', $email)->first();
        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($password == $pass) {
                $verify_pass = true;
            };
            // dd($password);
            if ($verify_pass) {
                $data = [
                    'id_perusahaan'    => $data['id_perusahaan'],
                    'nama_perusahaan'  => $data['nama_perusahaan'],
                    'email_perusahaan' => $data['email_perusahaan'],
                    'logged_in'     => TRUE
                ];
                $session->set($data);
                return redirect()->to('/pages/index');
            } else {
                $session->setFlashdata('pesan', 'Wrong Password');
                return redirect()->to('/pages/login');
            }
        } else {
            $session->setFlashdata('pesan', 'Email not Found');
            return redirect()->to('pages/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/pages');
    }

    //UPDATE ---------------------------------------------------------------

    public function editJobs($id)
    {
        $data = [
            'title' => 'Detail Lowongan',
            'job' => $this->jobsModel->getJobsDetail($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/edit', $data);
    }

    public function updateJobs($id)
    {
        //cek judul
        $jobLama = $this->jobsModel->getJobsDetail($this->request->getVar('id_jobs'));
        if ($jobLama[0]['posisi'] == $this->request->getVar('posisi')) {
            $rule_posisi = 'required';
        } else {
            $rule_posisi = 'required|is_unique[jobs.posisi]';
        }

        $this->jobsModel->save([
            'id_jobs' => $id,
            'posisi' => $this->request->getVar('posisi'),
            'gaji' => $this->request->getVar('gaji'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ]);

        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/editJobs/' . $id);
    }

    public function editPerusahaan($id)
    {
        $data = [
            'title' => 'Detail Lowongan',
            'job' => $this->perusahaanModel->getPerusahaan($id),
            'validation' => \Config\Services::validation()
        ];
        return view('pages/editPerusahaan', $data);
    }

    public function updatePerusahaan($id)
    {
        //cek nama_perusahaan
        $dataLama = $this->perusahaanModel->getPerusahaan($id);
        if ($dataLama['nama_perusahaan'] == $this->request->getVar('nama_perusahaan')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[perusahaan.nama_perusahaan]';
        }
        //validai input
        if (!$this->validate([
            'nama_perusahaan' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} nama perusahaan sudah terdaftar'
                ]
            ],
            'img_perusahaan' => [
                'rules' => 'max_size[img_perusahaan,1024]|is_image[img_perusahaan]|mime_in[img_perusahaan,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar',
                    'is_image' => 'Format gambar tidak valid',
                    'mime_in' => 'Format gambar tidak valid'
                ]
            ]
        ])) {
            return redirect()->to('/pages/editPerusahaan/' . $id)->withInput();
        }

        //ambil gambar
        $fileImg = $this->request->getFile('img_perusahaan');
        //apakah tidak ada gambar yang diupload
        if ($fileImg->getError() === 4) {
            $namaFile = $this->request->getVar('fotoLama');;
        } else {
            //generate nama gambar random
            $namaFile = $fileImg->getRandomName();
            //pindahkan file ke folder img
            $fileImg->move('img', $namaFile);
        }


        $this->perusahaanModel->save([
            'id_perusahaan' => $id,
            'nama_perusahaan' => $this->request->getVar('nama_perusahaan'),
            'email_perusahaan' => $this->request->getVar('email_lama'),
            'alamat' => $this->request->getVar('alamat'),
            'lokasi' => $this->request->getVar('lokasi'),
            'industri' => $this->request->getVar('industri'),
            'tahun_berdiri' => $this->request->getVar('thBerdiri'),
            'img_perusahaan' => $namaFile
        ]);

        session()->setFlashData('pesan', 'Data berhasil diubah');
        return redirect()->to('/pages/editPerusahaan/' . $id);
    }

    //DELETE ------------------------------------------------------------
    public function delete($id)
    {
        $this->jobsModel->delete($id);
        session()->setFlashData('pesan', 'Lowongan berhasil dihapus');
        return redirect()->to('/pages/profil/' . $this->request->getVar('id_perusahaan'));
    }
}
