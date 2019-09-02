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
        $this->load->view('Absen/index');
    }
    function get_total()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $data = $this->Absen_model->total_absen($tanggal_masuk);
        echo json_encode($data);
    }
    function get_absen()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $totalmasuk = $this->Absen_model->total_absen($tanggal_masuk);
        $totalpegawai = $this->Absen_model->total_pegawai();
        $data = $totalpegawai - $totalmasuk;
        echo json_encode($data);
    }
    function get_product()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal_masuk = date('Y-m-d');
        $data =  $this->Absen_model->table_absen($tanggal_masuk)->result();
        echo json_encode($data);
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
        $pagix = strtotime('21:00:00');
        $sore = strtotime('22:00:00');
        $sorex = strtotime('24:00:00');

        $cektimedb = $this->Absen_model->get_CekJamAbsen();

        $this->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'daa8c8cd19c2dc18dbb2',
            '512487a7a35ad67bde20',
            '841021',
            $options
        );

        if (time() >= strtotime($cektimedb->jam_masuk) && time() <= strtotime($cektimedb->max_jammasuk)) {
            $result = $this->Absen_model->cekpegawairfid($nomor_rfid);
            if (!empty($result)) {
                $cek = $this->Absen_model->cektanggalrfid($nomor_rfid, $tanggal_masuk);
                if ($cek > 0) {
                    $data['message'] = 'errorsatu';
                    $pusher->trigger('my-channel', 'my-event', $data);

                    redirect('absen');
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

                    $data['message'] = 'success';
                    $pusher->trigger('my-channel', 'my-event', $data);

                    redirect('absen');
                }
            } else {
                $data['message'] = 'error';
                $pusher->trigger('my-channel', 'my-event', $data);

                redirect('absen');
            }
        } else if (time() >= strtotime($cektimedb->jam_pulang) && time() <= strtotime($cektimedb->max_jampulang)) {
            $result = $this->Absen_model->cekabsendatang($nomor_rfid, $tanggal_masuk);
            if (!empty($result)) {
                $datapulang = array(
                    'jam_keluar' => $jam
                );
                $this->Absen_model->prosesabsenpulang($result->koderfid, $datapulang);

                $data['message'] = 'success';
                $pusher->trigger('my-channel', 'my-event', $data);

                redirect('absen');
            } else {
                $data['message'] = 'errordua';
                $pusher->trigger('my-channel', 'my-event', $data);

                redirect('absen');
            }
        } else {
            $data['message'] = 'errortiga';
            $pusher->trigger('my-channel', 'my-event', $data);
            redirect('absen');
        }
    }
}
