<?php

class Slip_Gaji extends CI_Controller
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
		$data['title'] = "Slip Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/gaji/slip_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_slip_gaji()
	{

		$data['title'] = "Cetak Laporan Absensi Pegawai";
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$nama = $this->input->post('nama_pegawai');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulantahun = $bulan . $tahun;

		$data['print_slip'] = $this->db->query("SELECT 
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
		dk.bulan,
		rp.jumlah_potongan,
		rp.total_jumlah_potongan,
		pg.JenisPotongan,
		tb.tugasTambahan
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
		WHERE 
			dp.id_pegawai = '$nama'
		GROUP BY 
			dp.id_pegawai, dp.nama_pegawai
	) AS pg ON pg.id_pegawai = dp.id_pegawai
	LEFT JOIN (
		SELECT 
			dp.id_pegawai,
			GROUP_CONCAT(tb.nama_tugas ORDER BY tb.id_tugas SEPARATOR ', ') AS tugasTambahan
		FROM 
			data_pegawai dp
		JOIN 
			tugas_tambahan tb ON dp.id_pegawai = tb.id_pegawai
		WHERE 
			dp.id_pegawai = '$nama'
		GROUP BY 
			dp.id_pegawai, dp.nama_pegawai
	) AS tb ON tb.id_pegawai = dp.id_pegawai
	WHERE 
		dp.id_pegawai = '$nama' AND
		dk.bulan = '$bulantahun'
	GROUP BY 
		dp.nik, dp.nama_pegawai, dp.jenis_kelamin, dj.nama_jabatan, dj.tj_struktural, dj.insentif_mgmp,
		dj.tunjangan_yayasan, dj.tj_transport, dj.uang_makan, dk.hadir, rp.id_pegawai,tb.id_pegawai,pg.JenisPotongan;
	")->result();
		// var_dump($data['print_slip']);
		// die();
		// $data['bulan'] = $bulan;
		// $data['tahun'] = $tahun;


		$this->load->view('template_admin/header', $data);
		$this->load->view('admin/gaji/cetak_slip_gaji', $data);
	}
}
?>