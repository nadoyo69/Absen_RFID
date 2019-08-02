<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pegawai_model extends CI_Model
{
    public function profil($nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $query = $this->db->get('pegawai');
        return $query->row();
    }
    function getprofilbyid($tbl_idpegawai)
    {
        $this->db->from('pegawai');
        $this->db->where('tbl_idpegawai', $tbl_idpegawai);
        $query = $this->db->get();
        return $query->row();
    }
}
