<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function total_pegawai()
    {
        $query = $this->db->get('pegawai');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function absen_hari_ini($tanggal)
    {
        $this->db->where('tanggal_masuk', $tanggal);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function TblPegawai()
    {
        $this->db->select('tbl_idpegawai, nama_pegawai,tanggal_lahir_pegawai,tempat_lahir_pegawai,nomor_hp_pegawai,nomor_pegawai,foto');
        $this->db->order_by('tbl_idpegawai', 'DESC');
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
    public function uploaddata($data)
    {
        $this->db->trans_start();
        $this->db->insert('pegawai', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function ceknamapegawai($nama)
    {
        $this->db->select('tbl_idpegawai,nama_pegawai');
        $this->db->where('nama_pegawai', $nama);
        $this->db->order_by('tbl_idpegawai', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pegawai');
        return $query->row();
    }
    public function ceknippegawai($nip)
    {
        $this->db->select('tbl_idpegawai,nomor_pegawai');
        $this->db->where('nomor_pegawai', $nip);
        $this->db->order_by('tbl_idpegawai', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pegawai');
        return $query->row();
    }
    public function cekrfidpegawai($rfid)
    {
        $this->db->select('tbl_idpegawai,koderfid');
        $this->db->where('koderfid', $rfid);
        $this->db->order_by('tbl_idpegawai', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('pegawai');
        return $query->row();
    }

    public function grafik()
    {
        $this->db->select('tanggal_masuk,COUNT(tanggal_masuk) as total');
        $this->db->group_by('tanggal_masuk');
        $this->db->order_by('tanggal_masuk', 'asc');
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }
}
