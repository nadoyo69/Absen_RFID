<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absen extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absen_model');
    }

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $data['total_pegawai'] = $this->Absen_model->total_pegawai();
        $data['table_absen'] =  $this->Absen_model->table_absen($tanggal_masuk);
        $data['total_absen'] = $this->Absen_model->total_absen($tanggal_masuk);
        $this->load->view('Absen/index', $data, null);
    }
    public function absenrfid()
    {
        $nomor_rfid = ucwords(strtolower($this->security->xss_clean($this->input->get('uid'))));

        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $jam = date('H:i:s');
        $bulan = date('m');
        $tahun = date('Y');

        $pagi = strtotime('07:00:00');
        $pagix = strtotime('09:00:00');
        $sore = strtotime('16:00:00');
        $sorex = strtotime('18:00:00');

        if (time() >= $pagi && time() <= $pagix) {
            $result = $this->Absen_model->cekpegawairfid($nomor_rfid);
            if (!empty($result)) {
                $cek = $this->Absen_model->cektanggalrfid($nomor_rfid, $tanggal_masuk);
                if ($cek > 0) {
                    $this->session->set_flashdata('error', 'Anda Sudah Melakukan Presensi');
                    redirect('Absen');
                } else {
                    $datapegawai = array(
                        'nomor_pegawai' => $result->nomor_pegawai,
                        'koderfid' => $nomor_rfid,
                        'nama_pegawai' => $result->nama_pegawai,
                        'tanggal_masuk' => $tanggal_masuk,
                        'jam_masuk' => $jam,
                        'bulan' => $bulan,
                        'tahun' => $tahun
                    );
                    $this->Absen_model->prosesabsenrfid($datapegawai);
                    $this->session->set_flashdata('success', 'Presesnsi Berhasil');
                    redirect('Absen');
                }
            } else {
                $this->session->set_flashdata('error', 'Pegawai tidak TERDAFTAR');
                redirect('Absen');
            }
        } else if (time() >= $sore && time() <= $sorex) {
            $result = $this->Absen_model->cekabsendatang($nomor_rfid, $tanggal_masuk);
            if (!empty($result)) {
                $datapulang = array(
                    'jam_keluar' => $jam
                );
                $this->Absen_model->prosesabsenpulang($result->koderfid, $datapulang);
                $this->session->set_flashdata('success', 'Presesnsi Pulang Berhasil');
                redirect('Absen');
            } else {
                $this->session->set_flashdata('error', 'Anda Belum Melakukan Presensi Datang');
                redirect('Absen');
            }
        }
    }
}
