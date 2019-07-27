<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    function updateotp($otp, $username)
    {
        $this->db->set('otp', $otp);
        $this->db->where('username_admin', $username);
        $this->db->update('admin');
        return true;
    }

    function cekusername($username)
    {
        $this->db->select('username_admin');
        $this->db->where('username_admin', $username);
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->row();
    }

    public function LogLoginAdmin($Log)
    {
        $this->db->trans_start();
        $this->db->insert('log_login_presensi', $Log);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function cekAdmin($username, $password, $otp)
    {
        $this->db->select('tbl_idadmin,nama_admin,username_admin,password,otp');
        $this->db->where('username_admin', $username);
        $this->db->where('otp', $otp);
        $this->db->from('admin');
        $query = $this->db->get();
        $user = $query->row();

        if (!empty($user)) {
            if (verifyHashedPassword($password, $user->password)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }


    function logout()
    {
        $botToken = "881663171:AAHnbbTVRqoP7XaF83_gtJvyXa53E0oApSE";
        $perangkat = $_SERVER['HTTP_USER_AGENT'];
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $website = "https://api.telegram.org/bot" . $botToken;
        $chatId = -286303573;
        $params = [
            'chat_id' => $chatId,
            'text' => 'User sudah Logout dengan ' . ' ____IP=>' . $_SERVER['REMOTE_ADDR'] . ' ____Tanggal&Jam=>' . $waktu . ' ____Perangkat Lunak =>' . $perangkat,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        $this->session->sess_destroy();

        redirect('Home');
    }
}
