<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['title'] = 'Dashbord';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $data['grafik'] = $this->Admin_model->grafik();
        $data['absen_hari_ini'] = $this->Admin_model->absen_hari_ini($tanggal);
        $data['total_pegawai'] = $this->Admin_model->total_pegawai();
        $this->load->view('admin/tempelate/header', $data, NULL);
        $this->load->view('admin/dashbord', $data, NULL);
        $this->load->view('admin/tempelate/footer');
    }

    public function pegawai()
    {
        $data['title'] = 'Data Pegawai';
        $data['pegawai'] = $this->Admin_model->TblPegawai();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/pegawai', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function inputdatapegawai()
    {
        $data['title'] = 'Input Data Pegawai';
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/inputpegawai');
        $this->load->view('admin/tempelate/footer');
    }

    public function newpegawai()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'Nomor Pegawai', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('rfid', 'Nomor Kartu', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == false) {
            $this->inputdatapegawai();
        } else {
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
            $nip = ucwords(strtolower($this->security->xss_clean($this->input->post('nip'))));
            $tempat_lahir = ucwords(strtolower($this->security->xss_clean($this->input->post('tempat_lahir'))));
            $tgl = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl'))));
            $rfid = ucwords(strtolower($this->security->xss_clean($this->input->post('rfid'))));
            $kontak = ucwords(strtolower($this->security->xss_clean($this->input->post('kontak'))));
            $alamat = ucwords(strtolower($this->security->xss_clean($this->input->post('alamat'))));
            $foto = base_url() . 'assets/images/fotopegawai/default.png';

            $cek = $this->Admin_model->ceknamapegawai($nama);
            if ($cek > 0) {
                $this->session->set_flashdata('error', 'Nama ada yang sama');
                redirect('Admin/inputdatapegawai');
            } else {
                $ceknip = $this->Admin_model->ceknippegawai($nip);
                if ($ceknip > 0) {
                    $this->session->set_flashdata('error', 'Nomor Pegawai ada yang sama');
                    redirect('Admin/inputdatapegawai');
                } else {
                    $cekrfid = $this->Admin_model->cekrfidpegawai($rfid);
                    if ($cekrfid > 0) {
                        $this->session->set_flashdata('error', 'Nomor Kartu ada yang sama');
                        redirect('Admin/inputdatapegawai');
                    } else {
                        $data = array(
                            'nama_pegawai' => $nama,
                            'tanggal_lahir_pegawai' => $tgl,
                            'tempat_lahir_pegawai' => $tempat_lahir,
                            'nomor_hp_pegawai' => $kontak,
                            'nomor_pegawai' => $nip,
                            'koderfid' => $rfid,
                            'foto' => $foto,
                            'password' =>  getHashedPassword('12345'),
                            'alamat' => $alamat
                        );

                        $result = $this->Admin_model->uploaddata($data);
                        if ($result > 0) {
                            $this->session->set_flashdata('success', 'Data Berhasil di Tambah');
                        } else {
                            $this->session->set_flashdata('error', 'Gagal upload data');
                        }
                    }
                }
            }
            redirect('Admin/inputdatapegawai');
        }
    }
}
