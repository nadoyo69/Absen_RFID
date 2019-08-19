<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
    }

    public function index()
    {
        //kirim notif telegram
        $botToken = "972979337:AAGQ5o0QZ1TgL-CzbOYqJrDE6GGU_cJv5ks";
        $perangkat = $_SERVER['HTTP_USER_AGENT'];
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $website = "https://api.telegram.org/bot" . $botToken;
        $chatId = -304126311;
        $params = [
            'chat_id' => $chatId,
            'text' => 'Ada yang sedang mencoba untuk Login pada halaman LOGIN PRESENSI' . ' ____IP=>' . $_SERVER['REMOTE_ADDR'] . ' ____Tanggal&Jam=>' . $waktu . ' ____Perangkat Lunak =>' . $perangkat,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        //view
        $this->load->view('Login/login');
    }

    public function kodeotp()
    {
        //form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[128]|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        //token bot telegram
        $botToken = "972979337:AAGQ5o0QZ1TgL-CzbOYqJrDE6GGU_cJv5ks";

        //form validation
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');
            $result = $this->Login_model->cekusername($username, $password);

            if (!empty($result)) {
                $length = 10;
                $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $otphash = "";

                for ($i = 0; $i < $length; $i++) {
                    $otphash .= $chars[mt_rand(0, strlen($chars) - 1)];
                }
                $otp = getHashedPassword($otphash);
                date_default_timezone_set('Asia/Jakarta');
                $timenow = strtotime(date('H:i:s'));
                $timeend = $timenow + 60;
                $data = [
                    'otp' => $otp,
                    'timeotp' => $timeend
                ];
                $this->Login_model->updateotp($data, $username);

                date_default_timezone_set('Asia/Jakarta');
                $waktu = date('Y-m-d H:i:s');
                $website = "https://api.telegram.org/bot" . $botToken;
                $chatId = -304126311;
                $params = [
                    'chat_id' => $chatId,
                    'text' => 'Kode OTP Anda dengan: ____Username=>' . $username . ' __jam & tanggal=>' . $waktu . ' __KODEOTP=>' . '(******* ' . $otphash . ' *******)' . ' ************KODE INI HANYA BERLAKU DALAM 1 MENIT************',
                ];
                $ch = curl_init($website . '/sendMessage');
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $result = curl_exec($ch);
                curl_close($ch);

                $this->isLoggedIn();
            } else {

                $this->session->set_flashdata('error', 'Username atau Password Salah');
                $this->load->view('Login/login');
            }
        }
    }

    function isLoggedIn()
    {
        //jika berhasil login dan masuk ke halaman login masukkan OTP
        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if (!isset($isLoggedIn) || $isLoggedIn != true) {
            $this->load->view('Login/loginotp');
        } else {
            redirect('Dashboard');
        }
    }

    public function loginfix()
    {
        //form validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('kodeotp', 'KodeOTP', 'required|trim|min_length[10]');

        //set tanggal dan jam
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_login = date('Y-m-d');
        $jam_login = date('H:i:s');

        //token bot telegram
        $botToken = "972979337:AAGQ5o0QZ1TgL-CzbOYqJrDE6GGU_cJv5ks";
        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $otp = $this->input->post('kodeotp');

            //cek apakah username,password dan kode otp benar
            $result = $this->Login_model->cekAdmin($username, $otp);
            $timenow = strtotime(date('H:i:s'));
            if (!empty($result)) {
                $cektime = $this->Login_model->CekTimeOtp($result->username_admin);
                if ($timenow <= $cektime->timeotp) {
                    //data yang akan dimasukkan didalam log database
                    $Log = array(
                        'username' => $username,
                        'nama' => $result->nama_admin,
                        'platform' => $_SERVER['HTTP_USER_AGENT'],
                        'tanggal_login' => $tanggal_login,
                        'jam' => $jam_login,
                    );

                    //session
                    $data_session =  array(
                        'username' => $username,
                        'status' => "login"
                    );

                    //input ke log database
                    $this->Login_model->LogLoginAdmin($Log);

                    //session 
                    $this->session->set_userdata($data_session);

                    //Kirim notif telegram
                    $perangkat = $_SERVER['HTTP_USER_AGENT'];
                    date_default_timezone_set('Asia/Jakarta');
                    $waktu = date('Y-m-d H:i:s');
                    $website = "https://api.telegram.org/bot" . $botToken;
                    $chatId = -304126311;
                    $params = [
                        'chat_id' => $chatId,
                        'text' => 'Admin berhasil Login pada halaman Presensi : ____Username=>' . $username . ' ____nama=>' . $result->nama_admin . ' ____IP=>' . $_SERVER['REMOTE_ADDR'] . ' ____Tanggal & Jam=>' . $waktu . ' ____Perangkat Lunak =>' . $perangkat,
                    ];
                    $ch = curl_init($website . '/sendMessage');
                    curl_setopt($ch, CURLOPT_HEADER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    redirect('Dashboard');
                } else {
                    $this->session->set_flashdata('error', 'KODE OTP EXPIRED');
                    $this->load->view('Login/login');
                }
            } else {
                //jika username,password dan kodeotp salah
                $this->session->set_flashdata('error', 'Username atau KodeOTP salah');
                $this->load->view('Login/loginotp');
            }
        }
    }
}
