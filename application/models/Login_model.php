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

    function cekusername($username,$password)
    {
        $this->db->select('username_admin,password');
        $this->db->where('username_admin', $username);
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

    public function LogLoginAdmin($Log)
    {
        $this->db->trans_start();
        $this->db->insert('log_login_admin', $Log);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function cekAdmin($username, $otp)
    {
        $this->db->select('tbl_idadmin,nama_admin,username_admin,password,otp');
        $this->db->where('username_admin', $username);
        $this->db->where('otp', $otp);
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->row();
    }
}
