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

    public function cekresetpegawai($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('pegawai');
        return $query->row_array();
    }

    public function resetpassword($data)
    {
        $this->db->trans_start();
        $this->db->insert('resetpassword', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function get_CekTokenPegawai($token, $email)
    {
        $this->db->where('token', $token);
        $this->db->where('email', $email);
        $query = $this->db->get('resetpassword');
        return $query->row_array();
    }

    public function get_prosesresetpassword($email, $password)
    {
        $this->db->set('password', $password);
        $this->db->where('email', $email);
        $this->db->update('pegawai');
        return true;
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

    public function get_CekStatusPegawai($nomor_pegawai)
    {
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $this->db->limit(1);
        $query = $this->db->get('status_login');
        return $query->row();
    }

    public function get_InsertStatusAktif($status)
    {
        $this->db->trans_start();
        $this->db->insert('status_login', $status);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    public function get_UpdateStatusAktif($updatestatus, $nomor_pegawai)
    {
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $this->db->update('status_login', $updatestatus);
        return true;
    }
}
