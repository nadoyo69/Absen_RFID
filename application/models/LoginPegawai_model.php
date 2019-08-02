<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class LoginPegawai_model extends CI_Model
{
    function cekpegawai($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->from('pegawai');
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
    public function LogLogin($Log)
    {
        $this->db->trans_start();
        $this->db->insert('log_login_pegawai', $Log);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
}
