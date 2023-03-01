<?php

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_petugas');
    }

    public function index()
    {
        if ($this->session->userdata('login_petugas_status') == 'ok') {
            $data['title'] = 'Halaman Petugas';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('home');
            $this->load->view('template/footer');
        } else {
            $data['title'] = 'Login Petugas';
            $this->load->view('template/header_auth', $data);
            $this->load->view('auth/login_petugas');
            $this->load->view('template/footer_auth');
        }
    }

    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Petugas';
            $this->load->view('template/header_auth', $data);
            $this->load->view('auth/login_petugas');
            $this->load->view('template/footer_auth');
        } else {
            $pass = md5($_POST['password']);
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $pass
            );
            $data_login = $this->m_petugas->login($data);

            if (count($data_login) > 0) {
                $this->session->set_userdata('login_petugas_status', 'ok');
                $this->session->set_userdata('id_petugas', $data_login[0]['id_petugas']);
                $this->session->set_userdata('nama_petugas', $data_login[0]['nama_petugas']);
                $this->session->set_userdata('level', 'petugas');
                redirect('petugas/index');
            } else {
                $data['error'] = array('error' => 'Username atau Password Salah');
                $this->load->view('template/header_auth');
                $this->load->view('auth/login_petugas', $data);
                $this->load->view('template/footer_auth');
            }
        }
    }

    public function pengaduan()
    {
        $data['title'] = 'Laporan Masuk';
        $data['pengaduan'] = $this->m_petugas->tampilPengaduan();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi_lap', $data);
        $this->load->view('template/footer');
    }

    public function pengaduanselesai()
    {
        $data['title'] = 'Laporan Selesai';
        $data['pengaduan'] = $this->m_petugas->tampilPengaduanSelesai();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('verifikasi_lap_selesai', $data);
        $this->load->view('template/footer');
    }



    public function detailaduan($id)
    {
        $data['title'] = 'Detail Aduan';
        $data['detailaduan'] = $this->m_petugas->tampilDetailAduan($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('detail_aduan', $data);
        $this->load->view('template/footer');
    }

    public function ubahstatus($id)
    {
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('detail_aduan');
            $this->load->view('template/footer');
        } else {
            $data = array(

                'status'              => $this->input->post('status')
            );

            if ($this->m_petugas->ubahStatusAduan($id, $data)) {
                redirect('petugas/pengaduan');
            } else {
                echo "Gagal Ubah Status";
            }
        }
    }

    public function tanggapan($id)
    {
        $data['title'] = 'Tanggapan';
        $data['detailaduan'] = $this->m_petugas->tampilDetailAduan($id);
        $data['aduantanggapan'] = $this->m_petugas->tampilAduanTanggapan($id);
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('tanggapan', $data);
        $this->load->view('template/footer');
    }

    public function tambahtanggapan($id)
    {
        $this->form_validation->set_rules('tanggapan', 'Tanggapan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['detailaduan'] = $this->m_petugas->tampilDetailAduan($id);
            $data['aduantanggapan'] = $this->m_petugas->tampilAduanTanggapan($id);
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('tanggapan', $data);
            $this->load->view('template/footer');
        } else {
            $data = array(
                'tgl_tanggapan' => date('Y-m-d'),
                'id_pengaduan'  => $id,
                'tanggapan'     => $this->input->post('tanggapan'),
                'id_petugas'    => $this->session->id_petugas
            );
            if ($this->m_petugas->tambahTanggapan($data)) {
                redirect('petugas/tanggapan/' . $id);
            }
        }
    }

    public function tambahData()
    {
        $data['tampilpetugas'] = $this->m_petugas->tampilPetugas();
        $data['title'] = 'Data Petugas';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('data_petugas', $data);
        $this->load->view('template/footer');
    }

    public function registrasi_petugas()
    {
        $this->form_validation->set_rules('nama_petugas', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Data Petugas';
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('data_petugas');
            $this->load->view('template/footer');
        } else {
            $data = array(
                'nama_petugas' => $this->input->post('nama_petugas'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password')),
                'telp' => $this->input->post('telp'),
                'level' => 'petugas'
            );

            if ($this->m_petugas->registrasi_petugas($data)) {
                redirect('petugas/tambahData');
            } else {
                echo "Gagal Tambah Data Petugas";
            }
        }
    }

    public function edit($id_petugas)
    {
        $this->form_validation->set_rules('nama_petugas', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('telp', 'No Hp', 'required');

        if ($this->form_validation->run() == false) {
            $this->tambahData();
        } else {
            $data = array(
                'id_petugas' => $id_petugas,
                'nama_petugas' => $this->input->post('nama_petugas'),
                'username' => $this->input->post('username'),
                'telp' => $this->input->post('telp')
            );

            $this->m_petugas->update_data($data, 'petugas');
            $this->tambahData();
        }
    }


    public function cetakLaporan()
    {
        $data['aduan_selesai'] = $this->m_petugas->tampilPengaduanSelesai();
        $this->load->view('laporan_selesai', $data);
    }
    public function cetakLaporan2()
    {
        $data['aduan_proses'] = $this->m_petugas->tampilPengaduanProses();
        $this->load->view('laporan_proses', $data);
    }

    public function delete($nomor)
    {
        $where = array('id_petugas' => $nomor);

        $this->m_petugas->delete($where, 'petugas');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Data berhasil di Hapus !<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button></div>');
        redirect('petugas/tambahData');
    }

    public function logout()
    {
        unset(
            $_SESSION['login_petugas_status'],
            $_SESSION['id_petugas'],
            $_SESSION['nama_petugas'],
            $_SESSION['level']
        );
        redirect('petugas/index');
    }
}
