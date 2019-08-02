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
}
