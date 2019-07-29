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
        $data['table_absen'] =  $this->Absen_model->table_absen($tanggal_masuk);
        $data['total_absen'] = $this->Absen_model->total_absen($tanggal_masuk);
        $this->load->view('Absen/index', $data, null);
    }

    /* public function absen()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('idpegawai', 'Nomor Pegawai', 'required');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $nomor_pegawai = ucwords(strtolower($this->security->xss_clean($this->input->post('idpegawai'))));
            $result = $this->Absen_model->cekpegawai($nomor_pegawai);

            date_default_timezone_set('Asia/Jakarta');
            $tanggal_masuk = date('Y-m-d');
            $jam = date('H:i:s');

            if (!empty($result)) {
                $cek = $this->Absen_model->cektanggal($nomor_pegawai, $tanggal_masuk);
                if ($cek > 0) {
                    $this->session->set_flashdata('error', 'Anda Sudah Melakukan Presensi');
                    redirect('Absen');
                } else {

                    $datapegawai = array(
                        'nomor_pegawai' => $nomor_pegawai,
                        'koderfid' => $result->koderfid,
                        'nama_pegawai' => $result->nama_pegawai,
                        'tanggal_masuk' => $tanggal_masuk,
                        'jam_masuk' => $jam
                    );
                    $this->Absen_model->prosesabsen($datapegawai);
                    $this->session->set_flashdata('success', 'Presesnsi Berhasil');
                    redirect('Absen');
                }
            } else {
                $this->session->set_flashdata('error', 'Pegawai tidak TERDAFTAR');
                redirect('Absen');
            }
        }
    } */
    public function absenrfid()
    {
        $nomor_rfid = ucwords(strtolower($this->security->xss_clean($this->input->get('uid'))));
        $result = $this->Absen_model->cekpegawairfid($nomor_rfid);

        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $jam = date('H:i:s');

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
                    'jam_masuk' => $jam
                );
                $this->Absen_model->prosesabsenrfid($datapegawai);
                $this->session->set_flashdata('success', 'Presesnsi Berhasil');
                redirect('Absen');
            }
        } else {
            $this->session->set_flashdata('error', 'Pegawai tidak TERDAFTAR');
            redirect('Absen');
        }
    }

    public function pulang()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nomor_pegawai', 'Nomor Pegawai', 'required');

        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $jam = date('H:i:s');

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $nomor_pegawai = ucwords(strtolower($this->security->xss_clean($this->input->post('nomor_pegawai'))));
            $result = $this->Absen_model->cekabsendatang($nomor_pegawai, $tanggal);

            if (!empty($result)) {
                $datapulang = array(
                    'jam_keluar' => $jam
                );
                $this->Absen_model->prosesabsenpulang($result->nomor_pegawai, $datapulang);
                $this->session->set_flashdata('success', 'Presesnsi Pulang Berhasil');
                redirect('Absen');
            } else {
                $this->session->set_flashdata('error', 'Anda Belum Melakukan Presensi Datang');
                redirect('Absen');
            }
        }
    }
}
