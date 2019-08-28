<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Absen';
$route['absen'] = 'Absen/absen';
$route['absenrfid'] = 'Absen/absenrfid';
$route['pulang'] = 'Absen/pulang';
//admin
$route['Dashboard'] = 'Admin';
$route['datapegawai'] = 'Admin/datapegawai';
$route['inputdatapegawai'] = 'Admin/inputdatapegawai';
$route['newpegawai'] = 'Admin/newpegawai';
$route['daftarhadir'] = 'Admin/daftarhadir';
$route['logadmin'] = 'Admin/logadmin';
$route['profiladmin'] = 'Admin/profiladmin';
$route['updateprofil'] = 'Admin/updateprofil';
$route['updatepassword'] = 'Admin/updatepassword';
$route['updatefoto'] = 'Admin/updatefoto';
$route['editpegawai/(:any)'] = 'Admin/editpegawai/$1';
$route['updatepegawai'] = 'Admin/updatepegawai';
$route['resetpasswordpegawai/(:num)'] = 'Admin/resetpasswordpegawai/$1';
$route['hapuspegawai/(:num)'] = 'Admin/hapuspegawai/$1';
$route['viewpegawai/(:num)'] = 'Admin/viewpegawai/$1';
$route['laporan'] = 'Admin/laporan';
$route['backup'] = 'Admin/backupdata';
$route['suratizinmasuk'] = 'Admin/get_SuratIzinMasuk';
$route['notifikasiizin'] = 'Admin/get_Notifikasi';
$route['totalnotif'] = 'Admin/get_TotalNotifikasi';
$route['dataizin'] = 'Admin/get_DataIzin';
$route['accsurat/(:num)'] = 'Admin/get_AccSurat/$1';
$route['tolaksurat/(:num)'] = 'Admin/get_TolakSurat/$1';
$route['notifikasireset'] = 'Admin/get_NotifResetPassword';
$route['totalnotifreset'] = 'Admin/get_TotalNotifikasiReset';
//login Admin
$route['logout'] = 'Admin/logout';
$route['Admin'] = 'LoginAdmin';
$route['AdminOTP'] = 'LoginAdmin/kodeotp';
$route['AdminOKE'] = 'LoginAdmin/loginfix';
//pegawai
$route['pegawai'] = 'LoginPegawai';
$route['loginpegawai'] = 'LoginPegawai/loginpegawai';
$route['forgetpassword'] = 'LoginPegawai/forgetpassword';
$route['forgetpasswordpegawai'] = 'LoginPegawai/forgetpasswordpegawai';
$route['logoutpegawai'] = 'Pegawai/logout';
$route['dashbordpegawai'] = 'Pegawai/index';
$route['profil'] = 'Pegawai/profil';
$route['updateprofilpegawai'] = 'Pegawai/get_UpdateProfilPegawai';
$route['updatepasswordpegawai'] = 'Pegawai/get_UpdatePassword';
$route['updatefotopegawai'] = 'Pegawai/updatefoto';
$route['logpegawai'] = 'Pegawai/get_LogPegawai';
$route['daftarhadirpegawai'] = 'Pegawai/get_DaftarHadir';
$route['suratizin'] =  'Pegawai/get_SuratIzin';
$route['inputsuratizin'] = 'Pegawai/get_InputSuratIzin';
$route['viewsuratizin'] = 'Pegawai/get_ViewSuratIzin';

$route['404_override'] = '404';
$route['translate_uri_dashes'] = FALSE;
