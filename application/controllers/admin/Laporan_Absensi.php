<?php

class Laporan_Absensi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}
	}

	public function index()
	{
		$data['title'] = "Laporan Absensi Pegawai";

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/laporan_absensi');
		$this->load->view('template_admin/footer');
	}

	// public function cetak_laporan_absensi()
	// {

	// 	$data['title'] = "Cetak Laporan Absensi Pegawai";
	// 	var_dump($_GET['bulan']);
	// 	die();
	// 	if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
	// 		$bulan = $_GET['bulan'];
	// 		$tahun = $_GET['tahun'];
	// 		$bulantahun = $bulan . $tahun;
	// 	} else {
	// 		$bulan = date('m');
	// 		$tahun = date('Y');
	// 		$bulantahun = $bulan . $tahun;
	// 	}
	// 	$data['lap_kehadiran'] = $this->db->query("
	// 	SELECT data_pegawai.*, data_kehadiran.*,data_jabatan.nama_jabatan FROM data_pegawai
	// 		INNER JOIN data_jabatan ON data_pegawai.id_jabatan = data_jabatan.id_jabatan
	// 		INNER JOIN data_kehadiran ON data_pegawai.id_pegawai = data_kehadiran.id_pegawai
	// 		WHERE NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' AND data_pegawai.id_pegawai=data_kehadiran.id_pegawai) ORDER BY data_pegawai.nama_pegawai ASC")->result();
	// 	$this->load->view('template_admin/header', $data);
	// 	$this->load->view('admin/absensi/cetak_absensi', $data);
	// }
	public function cetak_laporan_absensi()
	{

		$data['title'] = "Cetak Laporan Absensi Pegawai";
		if ((isset($_POST['bulan']) && $_POST['bulan'] != '') && (isset($_POST['tahun']) && $_POST['tahun'] != '')) {
			$bulan = $_POST['bulan'];
			$tahun = $_POST['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['lap_kehadiran'] = $this->db->query("SELECT data_kehadiran.*, data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan
		FROM data_kehadiran 
		INNER JOIN data_pegawai ON data_kehadiran.id_pegawai = data_pegawai.id_pegawai
		INNER JOIN data_jabatan ON data_pegawai.id_jabatan = data_jabatan.id_jabatan
		 WHERE bulan='$bulantahun' ORDER BY nama_pegawai ASC")->result();
		// var_dump($data['lap_kehadiran']);
		// die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/absensi/cetak_absensi', $data);
	}
}

?>
