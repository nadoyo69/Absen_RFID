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
    public function total_absen($nama_pegawai, $bulan)
    {
        $this->db->where('bulan', $bulan);
        $this->db->where('nama_pegawai', $nama_pegawai);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function total_absen_tahun($nama_pegawai, $tahun)
    {
        $this->db->where('tahun', $tahun);
        $this->db->where('nama_pegawai', $nama_pegawai);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
