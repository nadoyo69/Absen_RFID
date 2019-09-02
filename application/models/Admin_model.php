<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
    public function total_pegawai_aktif()
    {
        $this->db->where('active', 1);
        $query = $this->db->get('pegawai');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    public function total_pegawai_nonaktif()
    {
        $this->db->where('active', 0);
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
        $this->db->order_by('tbl_idpegawai', 'DESC');
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
    public function get_Jabatan()
    {
        $query = $this->db->get('jabatan_pegawai');
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

    public function grafik($bulan, $tahun)
    {
        $this->db->select('tanggal_masuk,tahun,bulan,COUNT(tanggal_masuk) as total');
        $this->db->group_by('tanggal_masuk');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->order_by('tanggal_masuk', 'asc');
        $query = $this->db->get('daftar_hadir');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function grafiklogin($bulan, $tahun)
    {
        $this->db->select('tanggal_login,bulan,tahun,COUNT(tanggal_login) as totallogin');
        $this->db->group_by('tanggal_login');
        $this->db->where('bulan', $bulan);
        $this->db->where('tahun', $tahun);
        $this->db->order_by('tanggal_login', 'asc');
        $query = $this->db->get('log_login_pegawai');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    public function daftarhadir()
    {
        $this->db->order_by('tbl_idabsen', 'DESC');
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }

    public function logadmin()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('log_login_admin');
        return $query->result_array();
    }
    public function profil($username)
    {
        $this->db->where('username_admin', $username);
        $query = $this->db->get('admin');
        return $query->row();
    }
    function getprofilbyid($tbl_idadmin)
    {
        $this->db->from('admin');
        $this->db->where('tbl_idadmin', $tbl_idadmin);
        $query = $this->db->get();
        return $query->row();
    }
    public function updateprofil($data, $username_session)
    {
        $this->db->where('username_admin', $username_session);
        $this->db->update('admin', $data);
        return true;
    }

    public function cekpassword($oldpassword, $username_session)
    {
        $this->db->where('username_admin', $username_session);
        $this->db->from('admin');
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
    public function updatepassword($data, $username_session)
    {
        $this->db->where('username_admin', $username_session);
        $this->db->update('admin', $data);
        return true;
    }

    public function updatefoto($data, $username_session)
    {
        $this->db->where('username_admin', $username_session);
        $this->db->update('admin', $data);
        return true;
    }

    function getprofilpegawai($tbl_idpegawai)
    {
        $this->db->from('pegawai');
        $this->db->where('tbl_idpegawai', $tbl_idpegawai);
        $query = $this->db->get();
        return $query->row();
    }

    public function updatepegawai($data, $id)
    {
        $this->db->where('tbl_idpegawai', $id);
        $this->db->update('pegawai', $data);
        return true;
    }

    public function deletepagwai($tbl_idpegawai)
    {
        $this->db->where('tbl_idpegawai', $tbl_idpegawai);
        $this->db->delete('pegawai');
    }

    public function insertdeletepegawai($data)
    {
        $this->db->trans_start();
        $this->db->insert('pegawai_keluar', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function exportabsenbulan($bulan)
    {
        $this->db->where('bulan', $bulan);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }
    public function exportabsentahun($tahun)
    {
        $this->db->where('tahun', $tahun);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }

    public function get_SuratIzin()
    {
        $this->db->from('surat_izin');
        $this->db->join('pegawai', 'pegawai.tbl_idpegawai = surat_izin.tbl_idpegawai', 'left');
        $this->db->where('jenis', 'Izin');
        $this->db->where('hasil', 'null');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_SuratSakit()
    {
        $this->db->from('surat_izin');
        $this->db->join('pegawai', 'pegawai.tbl_idpegawai = surat_izin.tbl_idpegawai', 'left');
        $this->db->where('jenis', 'sakit');
        $this->db->where('hasil', 'null');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_Notifikasi()
    {
        $this->db->where('hasil', 'null');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('surat_izin');
        return $query;
    }

    public function get_TotalNotifikasi()
    {
        $this->db->where('hasil', 'null');
        $query = $this->db->get('surat_izin');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function get_HasilSurat($datasurat, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('surat_izin', $datasurat);
        return true;
    }

    public function get_DataIzin()
    {
        $this->db->where('hasil', 'ACC');
        $this->db->or_where('hasil', 'DITOLAK');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('surat_izin');
        return $query->result_array();
    }
    public function get_viewPermintaanResetPassword()
    {
        $query = $this->db->get('resetpassword');
        return $query->result_array();
    }

    public function get_AbsenHariIni($tanggal)
    {
        $this->db->where('tanggal_masuk', $tanggal);
        $this->db->order_by('tbl_idabsen', 'DESC');
        $query = $this->db->get('daftar_hadir');
        return $query->result_array();
    }

    public function get_CekJabatan($jabatan)
    {
        $this->db->where('jabatan', $jabatan);
        $this->db->limit(1);
        $query = $this->db->get('jabatan_pegawai');
        return $query->row();
    }

    public function get_UploadJabatan($data)
    {
        $this->db->trans_start();
        $this->db->insert('jabatan_pegawai', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    public function get_DeleteJabatan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('jabatan_pegawai');
    }

    public function get_StatusLogin()
    {
        $query = $this->db->get('status_login');
        return $query->result_array();
    }

    public function get_TotalResetPassword()
    {
        $query = $this->db->get('resetpassword');
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    public function get_JamAbsensi()
    {
        $query = $this->db->get('jam_absen');
        return $query->result_array();
    }

    public function get_UpdateJamAbsensi($data)
    {
        $this->db->update('jam_absen', $data);
        return true;
    }
}
