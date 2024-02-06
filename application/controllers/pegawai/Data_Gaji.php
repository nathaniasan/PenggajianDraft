<?php

class Data_Gaji extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '2') {
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
		$data['title'] = "Data Gaji";
		$id_pegawai = $this->session->userdata('id_pegawai');
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['gaji'] = $this->db->query("SELECT dp.nik,
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
		dk.id_kehadiran,
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
			dp.id_pegawai = '$id_pegawai'
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
			dp.id_pegawai = '$id_pegawai'
		GROUP BY 
			dp.id_pegawai, dp.nama_pegawai
	) AS tb ON tb.id_pegawai = dp.id_pegawai
	WHERE 
		dp.id_pegawai = '$id_pegawai'
	GROUP BY 
		dp.nik, dp.nama_pegawai, dp.jenis_kelamin, dj.nama_jabatan, dj.tj_struktural, dj.insentif_mgmp,
		dj.tunjangan_yayasan, dj.tj_transport, dj.uang_makan, dk.hadir, rp.id_pegawai,tb.id_pegawai,pg.JenisPotongan
			ORDER BY dk.bulan DESC")->result();

		$this->load->view('template_pegawai/header', $data);
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/data_gaji', $data);
		$this->load->view('template_pegawai/footer');
	}

	public function cetak_slip($id)
	{
		$data['title'] = 'Cetak Slip Gaji';
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();

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
		dk.bulan,
		dk.piket,
		rp.jumlah_potongan,
		rp.total_jumlah_potongan,
		pg.JenisPotongan,
		pg.besarPotongan
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
			GROUP_CONCAT(pg.potongan ORDER BY pg.id SEPARATOR ', ') AS JenisPotongan,
			GROUP_CONCAT(
  CONCAT('Rp. ', FORMAT(CAST(SUBSTRING_INDEX(pg.jml_potongan, '.', 1) AS SIGNED), 0)) 
  ORDER BY pg.id SEPARATOR ', ') AS besarPotongan
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
		dk.id_kehadiran = '$id'
	GROUP BY 
		dp.nik, dp.nama_pegawai, dp.jenis_kelamin, dj.nama_jabatan, dj.tj_struktural, dj.insentif_mgmp,
		dj.tunjangan_yayasan, dj.tj_transport, dj.uang_makan, dk.hadir, rp.id_pegawai, pg.JenisPotongan ;")->result();
		// var_dump($data['print_slip']);
		// die();
		$this->load->view('template_pegawai/header', $data);
		$this->load->view('pegawai/cetak_slip_gaji', $data);
	}
}

?>