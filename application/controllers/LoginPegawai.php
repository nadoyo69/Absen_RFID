<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginPegawai_model');
    }

    public function index()
    {
        $this->load->view('LoginPegawai/login');
    }

    public function loginpegawai()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $password = $this->input->post('password');
            $result = $this->LoginPegawai_model->cekpegawai($email, $password);

            //set tanggal dan jam
            date_default_timezone_set('Asia/Jakarta');
            $tanggal_login = date('Y-m-d');
            $jam_login = date('H:i:s');

            if (!empty($result)) {
                //data yang akan dimasukkan didalam log database
                $Log = array(
                    'nama_pegawai' => $result->nama_pegawai,
                    'email' => $email,
                    'platform' => $_SERVER['HTTP_USER_AGENT'],
                    'tanggal_login' => $tanggal_login,
                    'jam_login' => $jam_login,
                    'bulan' => date('m'),
                    'tahun' => date('Y')
                );

                //status Aktif Login
                $status = [
                    'nama_pegawai' => $result->nama_pegawai,
                    'nomor_pegawai' => $result->nomor_pegawai,
                    'status' => 1,
                    'time' => time() + 900
                ];

                //session
                $data_session =  array(
                    'nama_pegawai' => $result->nama_pegawai,
                    'status' => "loginpegawai"
                );

                //input ke log database
                $this->LoginPegawai_model->LogLogin($Log);

                //cek apakah di dalam tabel sudah ada nama tersebut
                $statusaktif = $this->LoginPegawai_model->get_CekStatusPegawai($result->nomor_pegawai);
                if (empty($statusaktif)) {
                    //jika belum masuk disini
                    $this->LoginPegawai_model->get_InsertStatusAktif($status);
                } else {
                    //jika sudah masuk disini
                    $updatestatus = [
                        'status' => 1,
                        'time' => time() + 900
                    ];
                    $this->LoginPegawai_model->get_UpdateStatusAktif($updatestatus, $result->nomor_pegawai);
                }
                $this->session->set_userdata($data_session);

                redirect('dashbordpegawai');
            } else {
                //jika username,password dan kodeotp salah
                $this->session->set_flashdata('error', 'Email atau Password salah');
                $this->load->view('LoginPegawai/login');
            }
        }
    }
    public function forgetpasswordpegawai()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            redirect('pegawai');
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $nama = strtolower($this->security->xss_clean($this->input->post('nama')));
            $result = $this->LoginPegawai_model->cekresetpegawai($email);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            if (!empty($result)) {

                $token = base64_encode(random_bytes(32));
                $timestring = time();
                $timend = $timestring + 500;

                $data = array(
                    'email' => $email,
                    'nama' => $nama,
                    'tanggal' => $tanggal,
                    'jam' => $jam,
                    'timend' => $timend,
                    'token' => $token
                );
                $this->LoginPegawai_model->resetpassword($data);

                $this->_senEmail($email, $token);
                $this->session->set_flashdata('success', 'Silahkan Cek Email Anda Untuk Reset Password!');
                redirect('pegawai');
            } else {
                $this->session->set_flashdata('error', 'Anda Bukan Pegawai Disini!');
                redirect('pegawai');
            }
        }
    }

    private function _senEmail($email, $token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'youremail@gmail.com',
            'smtp_pass' => 'Passowrd?',
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        $this->email->from('youremail@gmail.com', 'Admin PT-Nadoyo');
        $this->email->to($email);
        $this->email->subject('Reset Password PT-Nadoyo');
        $this->email->message('Silahkan Klik link untuk Reset Password : <a href="' . base_url() . 'resetpassword?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function get_ViewForgetPasswordPegawai()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->LoginPegawai_model->cekresetpegawai($email);
        if ($user) {
            $user_token = $this->LoginPegawai_model->get_CekTokenPegawai($token, $email);
            if ($user_token) {
                $cektime = $this->LoginPegawai_model->get_CekTimeToken($email, $token);
                if (time() < $cektime->timend) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->ChangePassword();
                } else {
                    $this->session->set_flashdata('error', 'Waktu Telah Habis!');
                    redirect('pegawai');
                }
            } else {
                $this->session->set_flashdata('error', 'Reset Password Gagal! Token Salah!');
                redirect('pegawai');
            }
        } else {
            $this->session->set_flashdata('error', 'Reset Password Gagal! Email Salah!');
            redirect('pegawai');
        }
    }

    public function ChangePassword()
    {

        if (!$this->session->userdata('reset_email')) {
            redirect('pegawai');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password2]');

            if ($this->form_validation->run() == false) {
                $this->load->view('LoginPegawai/resetpassword');
            } else {
                $email = $this->session->userdata('reset_email');

                $pass = $this->input->post('password1');
                $password = getHashedPassword($pass);
                $this->LoginPegawai_model->get_prosesresetpassword($email, $password);

                $this->session->unset_userdata('reset_email');

                $this->session->set_flashdata('success', 'Password berhasil diganti');
                redirect('pegawai');
            }
        }
    }
}
