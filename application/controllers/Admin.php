<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
        $this->load->library('form_validation');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("Admin"));
        }
    }

    public function index()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Dashbord';
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');
        $data['grafik'] = $this->Admin_model->grafik($bulan, $tahun);
        $data['grafiklogin'] = $this->Admin_model->grafiklogin($bulan, $tahun);
        $data['absen_hari_ini'] = $this->Admin_model->absen_hari_ini($tanggal);
        $data['total_pegawai'] = $this->Admin_model->total_pegawai_aktif();
        $data['total_pegawai_nonaktif'] = $this->Admin_model->total_pegawai_nonaktif();
        $data['total_permintaan_izin'] = $this->Admin_model->get_TotalNotifikasi();
        $data['resetpassword'] = $this->Admin_model->get_TotalResetPassword();
        $this->load->view('admin/tempelate/header', $data, NULL);
        $this->load->view('admin/dashbord', $data, NULL);
        $this->load->view('admin/tempelate/footer');
    }

    public function datapegawai($tbl_idpegawai = null)
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Data Pegawai';
        $data['detail'] = $this->Admin_model->getprofilpegawai($tbl_idpegawai);
        $data['pegawai'] = $this->Admin_model->TblPegawai();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/pegawai', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function inputdatapegawai()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['jabatan'] = $this->Admin_model->get_Jabatan();
        $data['title'] = 'Input Data Pegawai';
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/inputpegawai');
        $this->load->view('admin/tempelate/footer');
    }

    public function newpegawai()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jeniskelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('nip', 'Nomor Pegawai', 'required');
        $this->form_validation->set_rules('rfid', 'Nomor Kartu', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');

        if ($this->form_validation->run() == false) {
            $this->inputdatapegawai();
        } else {
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
            $tempat_lahir = ucwords(strtolower($this->security->xss_clean($this->input->post('tempat_lahir'))));
            $tgl = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl'))));
            $alamat = ucwords(strtolower($this->security->xss_clean($this->input->post('alamat'))));
            $jeniskelamin = ucwords(strtolower($this->security->xss_clean($this->input->post('jeniskelamin'))));
            $agama = ucwords(strtolower($this->security->xss_clean($this->input->post('agama'))));
            $nip = ucwords(strtolower($this->security->xss_clean($this->input->post('nip'))));
            $rfid = ucwords(strtolower($this->security->xss_clean($this->input->post('rfid'))));
            $kontak = ucwords(strtolower($this->security->xss_clean($this->input->post('kontak'))));
            $email = ucwords(strtolower($this->security->xss_clean($this->input->post('email'))));
            $jabatan = ucwords(strtolower($this->security->xss_clean($this->input->post('jabatan'))));
            $foto = 'default.png';

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
                            'jabatan' => $jabatan,
                            'koderfid' => $rfid,
                            'foto' => $foto,
                            'password' =>  getHashedPassword('12345'),
                            'alamat' => $alamat,
                            'jeniskelamin' => $jeniskelamin,
                            'agama' => $agama,
                            'email' => $email,
                            'createDtm' => $DTM
                        );

                        $result = $this->Admin_model->uploaddata($data);
                        if ($result > 0) {
                            $this->session->set_flashdata('success', 'Data Berhasil di Tambah');
                            redirect('Admin/inputdatapegawai');
                        } else {
                            $this->session->set_flashdata('error', 'Gagal upload data');
                            redirect('Admin/inputdatapegawai');
                        }
                    }
                }
            }
            redirect('Admin/inputdatapegawai');
        }
    }

    public function daftarhadir()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Data Absensi';
        $data['daftarhadir'] = $this->Admin_model->daftarhadir();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/daftarhadir', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function logadmin()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['logadmin'] = $this->Admin_model->logadmin();
        $data['title'] = 'Data Log';
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/logadmin', $data, null);
        $this->load->view('admin/tempelate/footer');
    }
    public function profiladmin($username = null)
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Profil';
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/profiladmin', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function updateprofil()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('user_name', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('kontak', 'Kontak', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('tgl', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('tmp', 'Tempat Lahir', 'required');

        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');

        if ($this->form_validation->run() == false) {
            $this->profiladmin();
        } else {
            $usernama_session = $this->session->userdata("username");
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
            $username = ucwords(strtolower($this->security->xss_clean($this->input->post('user_name'))));
            $email = ucwords(strtolower($this->security->xss_clean($this->input->post('email'))));
            $kontak = ucwords(strtolower($this->security->xss_clean($this->input->post('kontak'))));
            $alamat = ucwords(strtolower($this->security->xss_clean($this->input->post('alamat'))));
            $tgl = ucwords(strtolower($this->security->xss_clean($this->input->post('tgl'))));
            $tmp = ucwords(strtolower($this->security->xss_clean($this->input->post('tmp'))));

            $data = array(
                'nama_admin' => $nama,
                'username_admin' => $username,
                'email_admin' => $email,
                'alamat' => $alamat,
                'nomor_hp' => $kontak,
                'tanggal_lahir' => $tgl,
                'tempat_lahir' => $tmp,
                'updateDtm' => $DTM
            );

            $result = $this->Admin_model->updateprofil($data, $usernama_session);
            if ($result == true) {
                $this->session->set_userdata('username', $username);
                $this->session->set_flashdata('success', 'Data berhasil di Update');
                redirect('profiladmin');
            } else {
                $this->session->set_flashdata('error', 'Data gagal di update');
                redirect('profiladmin');
            }
            redirect('profiladmin');
        }
    }

    public function updatepassword()
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $this->form_validation->set_rules('oldpassword', 'Password Lama', 'required');
        $this->form_validation->set_rules('password1', 'Password Baru', 'required');
        $this->form_validation->set_rules('password2', 'Konfimasi Password', 'required|matches[password1]');
        $usernama_session = $this->session->userdata("username");
        if ($this->form_validation->run() == false) {
            $this->profiladmin();
        } else {
            $oldpassword = $this->input->post('oldpassword');
            $newpassword = $this->input->post('password1');

            $resultpas = $this->Admin_model->cekpassword($oldpassword, $usernama_session);
            if (empty($resultpas)) {
                $this->session->set_flashdata('error', 'Password lama Salah');
                redirect('profiladmin');
            } else {

                $data = array(
                    'password' => getHashedPassword($newpassword),
                    'updateDtm' => $DTM
                );

                $result = $this->Admin_model->updatepassword($data, $usernama_session);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Password Berhasil diUpdate');
                    redirect('profiladmin');
                } else {
                    $this->session->set_flashdata('error', 'Password gagal diupdate');
                    redirect('profiladmin');
                }
            }
            redirect('profiladmin');
        }
    }

    public function updatefoto()
    {
        $config['upload_path'] = './assets/images/fotoadmin/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '2048';
        $this->load->library('upload', $config);

        $usernama_session = $this->session->userdata("username");
        $this->upload->do_upload('foto');
        $upload_data = $this->upload->data();
        $file_name =   $upload_data['file_name'];
        $foto = $file_name;

        $data = array(
            'foto' => $foto
        );

        $result = $this->Admin_model->updatefoto($data, $usernama_session);

        if ($result == true) {
            $this->session->set_flashdata('success', 'Update Foto Berhasil');
        } else {
            $this->session->set_flashdata('error', 'Update Foto Gagal');
        }

        redirect('profiladmin');
    }

    public function editpegawai($tbl_idpegawai)
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Edit Pegawai';
        $data['editpegawai'] = $this->Admin_model->getprofilpegawai($tbl_idpegawai);
        $data['jbt'] = $this->Admin_model->get_Jabatan();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/editpegawai', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function updatepegawai()
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'Nomor Pegawai', 'required');
        $this->form_validation->set_rules('rfid', 'Nomor RFID', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->datapegawai();
        } else {
            $id = ucwords(strtolower($this->security->xss_clean($this->input->post('id'))));
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('nama'))));
            $nip = ucwords(strtolower($this->security->xss_clean($this->input->post('nip'))));
            $rfid = ucwords(strtolower($this->security->xss_clean($this->input->post('rfid'))));
            $jabatan = ucwords(strtolower($this->security->xss_clean($this->input->post('jabatan'))));

            $data = array(
                'nama_pegawai' => $nama,
                'nomor_pegawai' => $nip,
                'koderfid' => $rfid,
                'jabatan' => $jabatan,
                'updateDtm' => $DTM
            );

            $result = $this->Admin_model->updatepegawai($data, $id);
            if ($result == true) {
                $this->session->set_flashdata('success', 'Data atas nama ' . $nama . ' berhasil di Update');
            } else {
                $this->session->set_flashdata('error', 'Data atas nama ' . $nama . ' gagal di update');
            }
            redirect('datapegawai');
        }
    }

    public function hapuspegawai($tbl_idpegawai)
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $result = $this->Admin_model->getprofilpegawai($tbl_idpegawai);
        if (!empty($result)) {
            $data = array(
                'nama_pegawai' => $result->nama_pegawai,
                'tanggal_lahir' => $result->tanggal_lahir_pegawai,
                'tempat_lahir' => $result->tempat_lahir_pegawai,
                'nomor_hp' => $result->nomor_hp_pegawai,
                'nomor_pegawai' => $result->nomor_pegawai,
                'koderfid' => $result->koderfid,
                'foto' => $result->foto,
                'alamat' => $result->alamat,
                'jeniskelamin' => $result->jeniskelamin,
                'email' => $result->email,
                'agama' => $result->agama,
                'tanggal_keluar' => $DTM

            );
            $this->Admin_model->insertdeletepegawai($data);
            $this->Admin_model->deletepagwai($tbl_idpegawai);
            $this->session->set_flashdata('success', 'Pegawai Atas Nama ' . $result->nama_pegawai . ' Telah Dihapus');
            redirect('datapegawai');
        } else {
            $this->session->set_flashdata('error', 'Pegawai Atas Nama ' . $result->nama_pegawai . ' Gagal Dihapus');
            redirect('datapegawai');
        }
    }

    public function laporan()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Laporan';
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/laporan', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function viewpegawai($tbl_idpegawai)
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $pegawai = $this->Admin_model->getprofilpegawai($tbl_idpegawai);
        $data['title'] = 'Data ' . $pegawai->nama_pegawai;
        $data['viewpegawai'] = $this->Admin_model->getprofilpegawai($tbl_idpegawai);
        $this->load->view('admin/laporan/exportpegawai', $data, null);
    }

    public function exportexcel()
    {
        $data['pegawai'] = $this->Admin_model->TblPegawai();
        $this->load->view('admin/laporan/exportexcel', $data, null);
    }

    public function exportabsenbulan()
    {
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        $data['title'] = 'Data Absensi Bulan ' . date('M') . ' PT-NADOYO';
        $data['data'] = $this->Admin_model->exportabsenbulan($bulan);
        $this->load->view('admin/laporan/exportabsenexcel', $data, null);
    }

    public function exportabsentahun()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tahun = date('Y');
        $data['title'] = 'Data Absensi Tahun ' . $tahun . ' PT-NADOYO';
        $data['data'] = $this->Admin_model->exportabsentahun($tahun);
        $this->load->view('admin/laporan/exportabsenexcel', $data, null);
    }

    public function backupdata()
    {
        $this->load->helper('download');
        $this->load->dbutil();
        $prefs = array(
            'format'      => 'zip',
            'filename'    => 'my_db_backup.sql'
        );
        $backup = &$this->dbutil->backup($prefs);
        $db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
        $save = 'pathtobkfolder/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function get_SuratIzinMasuk()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Surat Izin';
        $data['suratizin'] = $this->Admin_model->get_SuratIzin();
        $data['suratsakit'] = $this->Admin_model->get_SuratSakit();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/suratizin', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_Notifikasi()
    {
        $data = $this->Admin_model->get_Notifikasi()->result();
        echo json_encode($data);
    }

    public function get_TotalNotifikasi()
    {
        $data = $this->Admin_model->get_TotalNotifikasi();
        echo json_encode($data);
    }

    public function get_AccSurat($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $datasurat = [
            'hasil' => 'ACC',
            'DTM_hasil' => $DTM
        ];
        $this->Admin_model->get_HasilSurat($datasurat, $id);

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
        $data['message'] = 'success';
        $pusher->trigger('my-channel', 'my-event', $data);

        redirect('suratizinmasuk');
    }

    public function get_TolakSurat($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $DTM = date('Y-m-d H:i:s');
        $datasurat = [
            'hasil' => 'DITOLAK',
            'DTM_hasil' => $DTM
        ];
        $this->Admin_model->get_HasilSurat($datasurat, $id);

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
        $data['message'] = 'success';
        $pusher->trigger('my-channel', 'my-event', $data);

        redirect('suratizinmasuk');
    }

    public function get_DataIzin()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Data Izin';
        $data['dataizin'] = $this->Admin_model->get_DataIzin();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/dataizin', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_PermintaanResetPegawai()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Data Permintann Reset Password Pegawai';
        $data['resetpassword'] = $this->Admin_model->get_PermintaanResetPegawai();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/resetpassword', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_AbsenHariIni()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tanggal = date('Y-m-d');
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Absensi Perhari';
        $data['absen'] = $this->Admin_model->get_AbsenHariIni($tanggal);
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/absenhariini', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_viewPermintaanResetPassword()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Reset Password';
        $data['resetpassword'] = $this->Admin_model->get_viewPermintaanResetPassword();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/resetpassword', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_Jabatan()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Jabatan Pegawai';
        $data['jabatan'] = $this->Admin_model->get_Jabatan();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/Jabatan', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_InputJabatan()
    {
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            $this->get_Jabatan();
        } else {
            $jabatan = ucwords(strtolower($this->security->xss_clean($this->input->post('jabatan'))));
            $cekJabatan = $this->Admin_model->get_CekJabatan($jabatan);
            if ($cekJabatan > 0) {
                $this->session->set_flashdata('error', 'Nama Jabatan Tidak Boleh Sama');
                redirect('jabatan');
            } else {
                $data = ['jabatan' => $jabatan];

                $result = $this->Admin_model->get_UploadJabatan($data);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Jabatan Berhasil di Tambah');
                    redirect('jabatan');
                } else {
                    $this->session->set_flashdata('error', 'Gagal upload data');
                    redirect('jabatan');
                }
            }
        }
    }

    public function get_DeleteJabatan($id)
    {
        $result = $this->Admin_model->get_DeleteJabatan($id);
        if (empty($result)) {
            $this->session->set_flashdata('success', 'Jabatan Berhasil di Hapus');
            redirect('jabatan');
        } else {
            $this->session->set_flashdata('error', 'Gagal Hapus Jabatan');
            redirect('jabatan');
        }
    }

    public function get_StatusLoginPegawai()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Status Login Pegawai';
        $data['status'] = $this->Admin_model->get_StatusLogin();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/statuslogin', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_JamAbsensi()
    {
        $username = $this->session->userdata("username");
        $data['profil'] = $this->Admin_model->profil($username);
        $data['title'] = 'Jam Absensi';
        $data['jamabsen'] = $this->Admin_model->get_JamAbsensi();
        $this->load->view('admin/tempelate/header', $data, null);
        $this->load->view('admin/jamabsen', $data, null);
        $this->load->view('admin/tempelate/footer');
    }

    public function get_UpdateJamAbsensi()
    {
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('max_jammasuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('jam_pulang', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('max_jampulang', 'Jam Masuk', 'required');
        if ($this->form_validation->run() == false) {
            $this->get_JamAbsensi();
        } else {
            $jam_masuk = $this->input->post('jam_masuk');
            $max_jammasuk = $this->input->post('max_jammasuk');
            $jam_pulang = $this->input->post('jam_pulang');
            $max_jampulang = $this->input->post('max_jampulang');

            $data = [
                'jam_masuk' => $jam_masuk,
                'max_jammasuk' => $max_jammasuk,
                'jam_pulang' => $jam_pulang,
                'max_jampulang' => $max_jampulang
            ];

            $result = $this->Admin_model->get_UpdateJamAbsensi($data);

            if ($result == true) {
                $this->session->set_flashdata('success', 'Data berhasil di Update');
                redirect('jamabsen');
            } else {
                $this->session->set_flashdata('error', 'Data  gagal di update');
                redirect('jamabsen');
            }

            redirect('jamabsen');
        }
    }

    function logout()
    {
        $botToken = "972979337:AAGQ5o0QZ1TgL-CzbOYqJrDE6GGU_cJv5ks";
        $perangkat = $_SERVER['HTTP_USER_AGENT'];
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');
        $website = "https://api.telegram.org/bot" . $botToken;
        $chatId = -304126311;
        $params = [
            'chat_id' => $chatId,
            'text' => 'User sudah Logout dengan ' . ' ____IP=>' . $_SERVER['REMOTE_ADDR'] . ' ____Tanggal&Jam=>' . $waktu . ' ____Perangkat Lunak =>' . $perangkat,
        ];
        $ch = curl_init($website . '/sendMessage');
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);

        $this->session->sess_destroy();

        redirect(base_url('Admin'));
    }
}
