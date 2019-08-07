<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Absen_model extends CI_Model
{
    //absen datang manual
    /* public function prosesabsen($datapegawai)
    {
        $this->db->trans_start();
        $this->db->insert('daftar_hadir', $datapegawai);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function cekpegawai($nomor_pegawai)
    {
        $this->db->select('tbl_idpegawai,nama_pegawai,nomor_pegawai,koderfid');
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $this->db->from('pegawai');
        $query = $this->db->get();
        return $query->row();
    }

    public function cektanggal($nomor_pegawai, $tanggal_masuk)
    {
        $this->db->select('tbl_idabsen, nomor_pegawai,jam_masuk');
        $this->db->where('nomor_pegawai', $nomor_pegawai);
        $this->db->where('tanggal_masuk', $tanggal_masuk);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('daftar_hadir');
        return $query->row();
    } */

    //absen datang menggunakan rfid
    public function prosesabsenrfid($datapegawai)
    {
        $this->db->trans_start();
        $this->db->insert('daftar_hadir', $datapegawai);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function cekpegawairfid($nomor_rfid)
    {
        $this->db->select('tbl_idpegawai,nama_pegawai,nomor_pegawai,koderfid');
        $this->db->where('koderfid', $nomor_rfid);
        $this->db->from('pegawai');
        $query = $this->db->get();
        return $query->row();
    }

    public function cektanggalrfid($nomor_rfid, $tanggal_masuk)
    {
        $this->db->select('tbl_idabsen, koderfid,jam_masuk');
        $this->db->where('koderfid', $nomor_rfid);
        $this->db->where('tanggal_masuk', $tanggal_masuk);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('daftar_hadir');
        return $query->row();
    }

    //pulang
    public function prosesabsenpulang($koderfid, $jam)
    {
        $this->db->where('koderfid', $koderfid);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $this->db->limit(1);
        $this->db->update('daftar_hadir', $jam);
        return true;
    }

    public function cekabsendatang($nomor_rfid, $tanggal_masuk)
    {
        $this->db->select('koderfid,nama_pegawai,tanggal_masuk');
        $this->db->where('koderfid', $nomor_rfid);
        $this->db->where('tanggal_masuk', $tanggal_masuk);
        $this->db->from('daftar_hadir');
        $query = $this->db->get();
        return $query->row();
    }

    //view data
    public function table_absen($tanggal_masuk)
    {
        $this->db->where('tanggal_masuk', $tanggal_masuk);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }

    public function total_absen($tanggal_masuk)
    {
        $this->db->where('tanggal_masuk', $tanggal_masuk);
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function total_pegawai()
    {
        $query = $this->db->get('pegawai');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
}
