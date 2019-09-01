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
        date_default_timezone_set('Asia/Jakarta');
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

                $timenow = strtotime(date('H:i:s'));
                $timeend = $timenow + 60;
                $data = [
                    'otp' => $otp,
                    'timeotp' => base64_encode($timeend)
                ];
                $this->Login_model->updateotp($data, $username);
                $this->session->set_userdata('username', $username);

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
            $username = $this->session->userdata('username');
            $otp = $this->input->post('kodeotp');

            //cek apakah username,password dan kode otp benar
            $result = $this->Login_model->cekAdmin($username, $otp);
            if (!empty($result)) {
                $cektime = $this->Login_model->CekTimeOtp($result->username_admin);
                if (time() <= base64_decode($cektime->timeotp)) {
                    //data yang akan dimasukkan didalam log database
                    $Log = array(
                        'username' => $username,
                        'nama' => $result->nama_admin,
                        'platform' => $_SERVER['HTTP_USER_AGENT'],
                        'tanggal_login' => $tanggal_login,
                        'jam' => $jam_login,
                    );

                    //input ke log database
                    $this->Login_model->LogLoginAdmin($Log);
                    $this->session->unset_userdata('username');
                    //session
                    $data_session =  array(
                        'username' => $username,
                        'status' => "login"
                    );


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

    public function get_ForgetPasswordAdmin()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        if ($this->form_validation->run() == false) {
            redirect('admin');
        } else {
            $email = strtolower($this->security->xss_clean($this->input->post('email')));
            $nama = strtolower($this->security->xss_clean($this->input->post('nama')));
            $result = $this->Login_model->get_ForgetCekAdmin($email);
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
                $this->Login_model->get_InsertResetPassword($data);

                $this->_senEmail($email, $token);
                $this->session->set_flashdata('success', 'Silahkan Cek Email Anda Untuk Reset Password!');
                redirect('Admin');
            } else {
                $this->session->set_flashdata('error', 'Anda Bukan Admin Disini!');
                redirect('Admin');
            }
        }
    }

    private function _senEmail($email, $token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'pictnadoyo@gmail.com',
            'smtp_pass' => 'Qwertyuiop12345?',
            'smtp_port' => 587,
            'mailtype' => 'html',
            'charset' => 'UTF-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);

        $this->email->from('pictnadoyo@gmail.com', 'Admin PT-Nadoyo');
        $this->email->to($email);
        $this->email->subject('Reset Password PT-Nadoyo');
        $this->email->message('Silahkan Klik link untuk Reset Password : <a href="' . base_url() . 'resetpasswordadmin?email=' . $email . '&token=' . urlencode($token) . '">Reset Password</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function get_ViewForgetPasswordAdmin()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->Login_model->get_ForgetCekAdmin($email);
        if ($user) {
            $user_token = $this->Login_model->get_CekTokenAdmin($token, $email);
            if ($user_token) {
                $cektime = $this->Login_model->get_CekTimeToken($email, $token);
                if (time() < $cektime->timend) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->ChangePassword();
                } else {
                    $this->session->set_flashdata('error', 'Waktu Telah Habis!');
                    redirect('Admin');
                }
            } else {
                $this->session->set_flashdata('error', 'Reset Password Gagal! Token Salah!');
                redirect('Admin');
            }
        } else {
            $this->session->set_flashdata('error', 'Reset Password Gagal! Email Salah!');
            redirect('Admin');
        }
    }

    public function ChangePassword()
    {

        if (!$this->session->userdata('reset_email')) {
            redirect('Admin');
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('password1', 'Password', 'required|matches[password2]');
            $this->form_validation->set_rules('password2', 'Repeat Password', 'required|matches[password2]');

            if ($this->form_validation->run() == false) {
                $this->load->view('Login/resetpassword');
            } else {
                $email = $this->session->userdata('reset_email');

                $pass = $this->input->post('password1');
                $password = getHashedPassword($pass);
                $this->Login_model->get_prosesresetpassword($email, $password);

                $this->session->unset_userdata('reset_email');

                $this->session->set_flashdata('success', 'Password berhasil diganti');
                redirect('Admin');
            }
        }
    }
}
