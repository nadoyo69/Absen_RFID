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
        $this->form_validation->set_rules('email', 'Email', 'required');
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
                );

                //session
                $data_session =  array(
                    'nama_pegawai' => $result->nama_pegawai,
                    'status' => "login"
                );

                //input ke log database
                $this->LoginPegawai_model->LogLogin($Log);
                $this->session->set_userdata($data_session);

                redirect('dashbordpegawai');
            } else {
                //jika username,password dan kodeotp salah
                $this->session->set_flashdata('error', 'Email atau Password salah');
                $this->load->view('LoginPegawai/login');
            }
        }
    }
    public function forgetpassword()
    {
        $this->load->view('LoginPegawai/forgetpassword');
    }
    public function forgetpasswordpegawai()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('LoginPegawai/forgetpassword');
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $nama = $this->input->post('nama');
            $result = $this->LoginPegawai_model->cekresetpegawai($email);
            date_default_timezone_set('Asia/Jakarta');
            $tanggal = date('Y-m-d');
            $jam = date('H:i:s');

            if (!empty($result)) {
                $data = array(
                    'email' => $email,
                    'nama' => $nama,
                    'tanggal' => $tanggal,
                    'jam' => $jam
                );
                $this->LoginPegawai_model->resetpassword($data);

                $botToken = "972979337:AAGQ5o0QZ1TgL-CzbOYqJrDE6GGU_cJv5ks";
                $perangkat = $_SERVER['HTTP_USER_AGENT'];
                date_default_timezone_set('Asia/Jakarta');
                $waktu = date('Y-m-d H:i:s');
                $website = "https://api.telegram.org/bot" . $botToken;
                $chatId = -304126311;
                $params = [
                    'chat_id' => $chatId,
                    'text' => 'Pegawai Atas Nama ' . $nama . ' dengan email ' . $email . ' Ingin Mereset Passwordnya. Perangkat Yang digunakan adalah ' . $perangkat
                ];
                $ch = curl_init($website . '/sendMessage');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $this->session->set_flashdata('success', 'Reset Password Anda Sedang Diproses Admin, Silahkan Tunggu informasi Selanjutnya');
                redirect('Pegawai');
            } else {
                $this->session->set_flashdata('error', 'Anda Bukan Pegawai Disini');
                $this->load->view('LoginPegawai/login');
            }
        }
    }
}
