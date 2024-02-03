<?php

class Data_Penggajian extends CI_Controller
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
		$data['title'] = "Data Gaji Pegawai";
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['gaji'] = $this->db->query("
		SELECT 
		dp.nik,
		dp.nama_pegawai,
		dp.jenis_kelamin,
		dp.honor,
		dj.nama_jabatan,
		dj.tj_struktural,
		dj.insentif_mgmp,
		dj.tunjangan_yayasan,
		dj.tj_transport,
		dj.uang_makan,
		dk.hadir,
		dk.piket,
		rp.jumlah_potongan,
		rp.total_jumlah_potongan,
		pg.JenisPotongan
	FROM 
		data_pegawai dp
	INNER JOIN 
		data_kehadiran dk ON dk.id_pegawai = dp.id_pegawai
	INNER JOIN 
		data_jabatan dj ON dj.id_jabatan = dp.id_jabatan
	LEFT JOIN (
		SELECT 
			rp.id_pegawai,
			COUNT(rp.id_potongan) AS jumlah_potongan,
			SUM(pg.jml_potongan) AS total_jumlah_potongan
		FROM 
			rekap_potongan rp
		INNER JOIN 
			potongan_gaji pg ON rp.id_potongan = pg.id
		GROUP BY 
			rp.id_pegawai
	) AS rp ON rp.id_pegawai = dp.id_pegawai
	LEFT JOIN (
		SELECT 
			dp.id_pegawai,
			GROUP_CONCAT(pg.potongan ORDER BY pg.id SEPARATOR ', ') AS JenisPotongan
		FROM 
			data_pegawai dp
		JOIN 
			rekap_potongan rp ON dp.id_pegawai = rp.id_pegawai
		JOIN 
			potongan_gaji pg ON rp.id_potongan = pg.id
		GROUP BY 
			dp.id_pegawai, dp.nama_pegawai
	) AS pg ON pg.id_pegawai = dp.id_pegawai
	WHERE 
		dk.bulan = '$bulantahun'
	GROUP BY 
		dp.nik, dp.nama_pegawai, dp.jenis_kelamin, dj.nama_jabatan, dj.tj_struktural, dj.insentif_mgmp,
		dj.tunjangan_yayasan, dj.tj_transport, dj.uang_makan, dk.hadir, rp.id_pegawai, pg.JenisPotongan;			
")->result();
		// var_dump($bulantahun);


		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/data_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_gaji()
	{

		$data['title'] = "Cetak Data Gaji Pegawai";
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['cetak_gaji'] = $this->db->query("SELECT 
		dp.nik,
		dp.nama_pegawai,
		dp.jenis_kelamin,
		dp.honor,
		dj.nama_jabatan,
		dj.tj_struktural,
		dj.insentif_mgmp,
		dj.tunjangan_yayasan,
		dj.tj_transport,
		dj.uang_makan,
		dk.hadir,
		dk.bulan,
		dk.piket,
		rp.jumlah_potongan,
		rp.total_jumlah_potongan,
		pg.JenisPotongan
	FROM 
		data_pegawai dp
	INNER JOIN 
		data_kehadiran dk ON dk.id_pegawai = dp.id_pegawai
	INNER JOIN 
		data_jabatan dj ON dj.id_jabatan = dp.id_jabatan
	LEFT JOIN (
		SELECT 
			rp.id_pegawai,
			COUNT(rp.id_potongan) AS jumlah_potongan,
			SUM(pg.jml_potongan) AS total_jumlah_potongan
		FROM 
			rekap_potongan rp
		INNER JOIN 
			potongan_gaji pg ON rp.id_potongan = pg.id
		GROUP BY 
			rp.id_pegawai
	) AS rp ON rp.id_pegawai = dp.id_pegawai
	LEFT JOIN (
		SELECT 
			dp.id_pegawai,
			GROUP_CONCAT(pg.potongan ORDER BY pg.id SEPARATOR ', ') AS JenisPotongan
		FROM 
			data_pegawai dp
		JOIN 
			rekap_potongan rp ON dp.id_pegawai = rp.id_pegawai
		JOIN 
			potongan_gaji pg ON rp.id_potongan = pg.id
		GROUP BY 
			dp.id_pegawai, dp.nama_pegawai
	) AS pg ON pg.id_pegawai = dp.id_pegawai
	WHERE 
		dk.bulan = '$bulantahun'
	GROUP BY 
		dp.nik, dp.nama_pegawai, dp.jenis_kelamin, dj.nama_jabatan, dj.tj_struktural, dj.insentif_mgmp,
		dj.tunjangan_yayasan, dj.tj_transport, dj.uang_makan, dk.hadir, rp.id_pegawai, pg.JenisPotongan ;			
")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_gaji', $data);
	}
}
?>
