<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') != "loginpegawai") {
            redirect(base_url("Pegawai"));
        }
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        $tahun = date('Y');
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $nomor = $this->Pegawai_model->profil($nama_pegawai);
        $data['title'] = 'Dashbord';
        $data['absen'] = $this->Pegawai_model->total_absen($nomor->nomor_pegawai, $bulan);
        $data['Tahunabsen'] = $this->Pegawai_model->total_absen_tahun($nomor->nomor_pegawai, $tahun);
        $this->load->view('pegawai/tempelate/header', $data, null);
        $this->load->view('pegawai/index', $data, null);
        $this->load->view('pegawai/tempelate/footer');
    }
    public function profil()
    {
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $data['title'] = 'Profil';
        $this->load->view('Pegawai/tempelate/header', $data, null);
        $this->load->view('Pegawai/profil', $data, null);
        $this->load->view('Pegawai/tempelate/footer');
    }

    public function get_UpdateProfilPegawai()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir ', 'required');
        $this->form_validation->set_rules('tmp', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('jns', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');

        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y:m:d H:i:s');

        if ($this->form_validation->run() == false) {
            $this->profil();
        } else {
            $nama_pegawai = $this->session->userdata("nama_pegawai");
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
            $tmp = ucwords(strtolower($this->security->xss_clean($this->input->post('tmp'))));
            $tgl = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl'))));
            $alamat = ucwords(strtolower($this->security->xss_clean($this->input->post('alamat'))));
            $agama = ucwords(strtolower($this->security->xss_clean($this->input->post('agama'))));
            $jns = ucwords(strtolower($this->security->xss_clean($this->input->post('jns'))));
            $email = ucwords(strtolower($this->security->xss_clean($this->input->post('email'))));
            $kontak = ucwords(strtolower($this->security->xss_clean($this->input->post('kontak'))));

            $data = [
                'nama_pegawai' => $nama,
                'tanggal_lahir_pegawai' => $tgl,
                'tempat_lahir_pegawai' => $tmp,
                'nomor_hp_pegawai' => $kontak,
                'alamat' => $alamat,
                'jeniskelamin' => $jns,
                'agama' => $agama,
                'email' => $email,
                'updateDtm' => $DTM
            ];

            //status Login
            $status = [
                'status' => 1,
                'time' => time() + 900
            ];

            $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);

            $result = $this->Pegawai_model->get_UpdateProfilPegawai($data, $nama_pegawai);
            if ($result == true) {
                $this->session->set_userdata('nama_pegawai', $nama);
                $this->session->set_flashdata('success', 'Data berhasil di Update');
                redirect('profil');
            } else {
                $this->session->set_flashdata('error', 'Data gagal di update');
                redirect('profil');
            }

            redirect('profil');
        }
    }

    public function get_UpdatePassword()
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $this->form_validation->set_rules('oldpassword', 'Password Lama', 'required');
        $this->form_validation->set_rules('password1', 'Password Baru', 'required');
        $this->form_validation->set_rules('password2', 'Password Baru', 'required|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->profil();
        } else {
            $nama_pegawai = $this->session->userdata("nama_pegawai");
            $oldpassword = $this->input->post('oldpassword');
            $newpassword = $this->input->post('password1');

            $resultpas = $this->Pegawai_model->get_CekPasswordLama($oldpassword, $nama_pegawai);
            if (empty($resultpas)) {
                $this->session->set_flashdata('error', 'Password lama Salah');
                redirect('profil');
            } else {

                $data = array(
                    'password' => getHashedPassword($newpassword),
                    'updateDtm' => $DTM
                );

                //status Login
                $status = [
                    'status' => 1,
                    'time' => time() + 900
                ];

                $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);

                $result = $this->Pegawai_model->get_UpdatePassword($data, $nama_pegawai);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Password Berhasil diUpdate');
                } else {
                    $this->session->set_flashdata('error', 'Password gagal diupdate');
                }
            }
            redirect('profil');
        }
    }

    public function get_UpdateFoto()
    {
        $config['upload_path'] = './assets/images/fotopegawai/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);

        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $this->upload->do_upload('foto');
        $upload_data = $this->upload->data();
        $file_name =   $upload_data['file_name'];
        $foto = $file_name;

        $data = array(
            'foto' => $foto
        );

        $result = $this->Pegawai_model->get_UpdateFoto($data, $nama_pegawai);

        if ($result == true) {
            $this->session->set_flashdata('success', 'Update Foto Berhasil');
        } else {
            $this->session->set_flashdata('error', 'Update Foto Gagal');
        }

        redirect('profil');
    }

    public function get_LogPegawai()
    {
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $data['logadmin'] = $this->Pegawai_model->get_LogPegawai($nama_pegawai);
        $data['title'] = 'Data Log';
        $this->load->view('pegawai/tempelate/header', $data, null);
        $this->load->view('pegawai/logpegawai', $data, null);
        $this->load->view('pegawai/tempelate/footer');
    }

    public function get_DaftarHadir()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $data['title'] = 'Daftar Hadir';
        $ceknip = $this->Pegawai_model->profil($nama_pegawai);
        $data['daftarhadir'] = $this->Pegawai_model->get_DaftarHadir($ceknip->nomor_pegawai, $bulan);
        $this->load->view('pegawai/tempelate/header', $data, null);
        $this->load->view('pegawai/daftarhadir', $data, null);
        $this->load->view('pegawai/tempelate/footer');
    }

    public function get_SuratIzin()
    {
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $data['title'] = 'Surat Izin';
        $this->load->view('pegawai/tempelate/header', $data, null);
        $this->load->view('pegawai/inputizin', $data, null);
        $this->load->view('pegawai/tempelate/footer');
    }

    public function get_InputSuratIzin()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jenisurat', 'Jenis Surat', 'required');
        $this->form_validation->set_rules('tgl1', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl2', 'Sampai Tanggal', 'required');
        $this->form_validation->set_rules('isi', 'Isi Surat', 'required');

        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y:m:d H:i:s');

        if ($this->form_validation->run() == false) {
            $this->get_SuratIzin();
        } else {
            $nama_pegawai = $this->session->userdata("nama_pegawai");
            $pegawai = $this->Pegawai_model->profil($nama_pegawai);

            $jenis = ucwords(strtolower($this->security->xss_clean($this->input->post('jenisurat'))));
            $tgl1 = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl1'))));
            $tgl2 = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl2'))));
            $isi = $this->input->post('isi');

            $dataizin = [
                'tbl_idpegawai' => $pegawai->tbl_idpegawai,
                'nama_pegawai' => $nama_pegawai,
                'nomor_pegawai' => $pegawai->nomor_pegawai,
                'jenis' => $jenis,
                'tanggal_mulai' => $tgl1,
                'tanggal_selesai' => $tgl2,
                'isi' => $isi,
                'DTM' => $DTM,
                'hasil' => 'null'
            ];

            //status Login
            $nama_pegawai = $this->session->userdata("nama_pegawai");
            $status = [
                'status' => 1,
                'time' => time() + 900
            ];

            $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
            $result = $this->Pegawai_model->get_InputSuratIzin($dataizin);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Silahkan Tungggu ACC Dari Manager');
            } else {
                $this->session->set_flashdata('error', 'Gagal Upload Surat Izin');
            }

            $this->load->view('vendor/autoload.php');
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher\Pusher(
                'daa8c8cd19c2dc18dbb2',
                '512487a7a35ad67bde20',
                '841021',
                $options
            );
            $data['message'] = 'success';
            $pusher->trigger('my-channel', 'my-event', $data);

            redirect('suratizin');
        }
    }

    public function get_ViewSuratIzin()
    {
        //status Login
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 1,
            'time' => time() + 900
        ];

        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $data['profil'] = $this->Pegawai_model->profil($nama_pegawai);
        $data['title'] = 'Surat Izin';
        $nomor = $this->Pegawai_model->profil($nama_pegawai);
        $data['hasilsurat'] = $this->Pegawai_model->get_HasilSurat($nomor->nomor_pegawai);
        $this->load->view('pegawai/tempelate/header', $data, null);
        $this->load->view('pegawai/suratizin', $data, null);
        $this->load->view('pegawai/tempelate/footer');
    }

    public function get_AktivasiPegawai()
    {
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $aktif = ['active' => 1];
        $result = $this->Pegawai_model->get_AktivasiPegawai($aktif, $nama_pegawai);
        if (!empty($result)) {
            $this->session->set_flashdata('success', 'Status Anda Telah Berubah Menjadi Aktif dan Silahkan <button class="btn btn-primary"><a class="text-white" href="' . base_url('profil') . '"> klik Disini </a></button> Untuk Mengganti Password Akun Anda');
            redirect('dashbordpegawai');
        } else {
            $this->session->set_flashdata('error', 'Gagal Aktivasi! Silahkan Coba Lagi');
            redirect('dashbordpegawai');
        }
    }

    function logout()
    {
        $nama_pegawai = $this->session->userdata("nama_pegawai");
        $status = [
            'status' => 0,
            'time' => 0
        ];
        $this->Pegawai_model->get_UpdateStatusAktif($status, $nama_pegawai);
        $this->session->sess_destroy();
        redirect(base_url('pegawai'));
    }
}
