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
    public function total_absen($nomor_pegawai, $bulan)
    {
        $this->db->where('bulan', $bulan);
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function total_absen_tahun($nomor_pegawai, $tahun)
    {
        $this->db->where('tahun', $tahun);
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function get_UpdateProfilPegawai($data, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->update('pegawai', $data);
        return true;
    }

    public function get_CekPasswordLama($oldpassword, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->from('pegawai');
        $query = $this->db->get();
        $user = $query->row();

        if (!empty($user)) {
            if (verifyHashedPassword($oldpassword, $user->password)) {
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public function get_UpdatePassword($data, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->update('pegawai', $data);
        return true;
    }

    public function get_UpdateFoto($data, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->update('pegawai', $data);
        return true;
    }

    public function get_LogPegawai($nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('log_login_pegawai');
        return $query->result_array();
    }

    public function get_DaftarHadir($nomor_pegawai, $bulan)
    {
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $this->db->where('bulan', $bulan);
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }

    public function get_InputSuratIzin($dataizin)
    {
        $this->db->trans_start();
        $this->db->insert('surat_izin', $dataizin);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
    public function get_HasilSurat($nomor_pegawai)
    {
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $query = $this->db->get('surat_izin');
        return $query->result_array();
    }

    public function get_UpdateStatusAktif($status, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->update('status_login', $status);
        return true;
    }

    public function get_AktivasiPegawai($aktif, $nama_pegawai)
    {
        $this->db->where('nama_pegawai', $nama_pegawai);
        $this->db->update('pegawai', $aktif);
        return true;
    }
}
