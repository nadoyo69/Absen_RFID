<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
    function updateotp($data, $username)
    {
        $this->db->where('username_admin', $username);
        $this->db->update('admin', $data);
        return true;
    }

    function cekusername($username, $password)
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

    public function CekTimeOtp($username_admin)
    {
        $this->db->where('username_admin', $username_admin);
        $this->db->from('admin');
        $query = $this->db->get();
        return $query->row();
    }

    public function cekAdmin($username, $otp)
    {
        $this->db->select('tbl_idadmin,nama_admin,username_admin,password,otp');
        $this->db->where('username_admin', $username);

        $this->db->from('admin');
        $query = $this->db->get();
        $user = $query->row();

        if (!empty($user)) {
            if (verifyHashedPassword($otp, $user->otp)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function get_ForgetCekAdmin($email)
    {
        $this->db->where('email_admin', $email);
        $query = $this->db->get('admin');
        return $query->row_array();
    }

    public function get_InsertResetPassword($data)
    {
        $this->db->trans_start();
        $this->db->insert('resetpassword', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    public function get_CekTokenAdmin($token, $email)
    {
        $this->db->where('token', $token);
        $this->db->where('email', $email);
        $query = $this->db->get('resetpassword');
        return $query->row_array();
    }
    public function get_CekTimeToken($email, $token)
    {
        $this->db->select('id,email,timend,token');
        $this->db->where('email', $email);
        $this->db->where('token', $token);
        $this->db->from('resetpassword');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_prosesresetpassword($email, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('email_admin', $email);
        $this->db->update('admin');
        return true;
    }
}
