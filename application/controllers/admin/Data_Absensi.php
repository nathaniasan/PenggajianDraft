<?php


class Data_Absensi extends CI_Controller
{

	public $modelAbsensi;

	public function __construct()
	{
		// $this->modelAbsensi = new ModelAbsensi();
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
		$data['title'] = "Data Absensi Pegawai";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['absensi'] = $this->db->query("SELECT data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_pegawai.jabatan
			FROM data_kehadiran
			INNER JOIN data_pegawai ON data_kehadiran.nik= data_pegawai.nik
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE data_kehadiran.bulan='$bulantahun' ORDER BY data_pegawai.nama_pegawai ASC")->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/data_absensi', $data);
		$this->load->view('template_admin/footer');
	}

	public function input_absensi()
	{
		if ($this->input->post('submit', TRUE) == 'submit') {
			$post = $this->input->post();

			foreach ($post['bulan'] as $key => $value) {
				if ($post['bulan'][$key] != '' || $post['nik'][$key] != '') {
					$simpan[] = array(
						'bulan' => $post['bulan'][$key],
						'nik' => $post['nik'][$key],
						'nama_pegawai' => $post['nama_pegawai'][$key],
						'jenis_kelamin' => $post['jenis_kelamin'][$key],
						'nama_jabatan' => $post['nama_jabatan'][$key],
						'hadir' => $post['hadir'][$key],
						'sakit' => $post['sakit'][$key],
						'alpha' => $post['alpha'][$key],
					);
				}
			}
			$this->ModelPenggajian->insert_batch('data_kehadiran', $simpan);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_absensi');

		}

		$data['title'] = "Form Input Absensi";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}
		$data['input_absensi'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai
			INNER JOIN data_jabatan ON data_pegawai.jabatan = data_jabatan.nama_jabatan
			WHERE NOT EXISTS (SELECT * FROM data_kehadiran WHERE bulan='$bulantahun' AND data_pegawai.nik=data_kehadiran.nik) ORDER BY data_pegawai.nama_pegawai ASC")->result();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/tambah_dataAbsensi', $data);
		$this->load->view('template_admin/footer');
	}
	public function update_absensi($id)
	{
		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$where = array('id_kehadiran' => $id);
		$data['title'] = "Update Data Absen";
		$data['kehadiran'] = $this->db->query("SELECT * FROM data_kehadiran WHERE id_kehadiran='$id'")->result();
		// var_dump($data['kehadiran']);
		// die();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/update_absensi', $data);
		$this->load->view('template_admin/footer');

	}

	public function update_absen()
	{
		$this->load->model('ModelAbsensi'); // Load the model
		if ($this->input->post('update_absen', TRUE) == 'update_absen') {
			// Assuming your form data is being posted here
			$post = $this->input->post();

			$bulan = $post['bulan'][0]; // Assuming the month is the same for all records
			$tahun = $post['tahun'][0]; // Assuming the year is the same for all records
			$bulantahun = $bulan . $tahun;

			// Loop through the posted data and update each row
			foreach ($post['nik'] as $key => $value) {
				$data = array(
					'hadir' => $post['hadir'][$key],
					'sakit' => $post['sakit'][$key],
					'alpha' => $post['alpha'][$key]
					// Add other fields to update here if needed
				);

				$this->db->where('nik', $post['nik'][$key]);
				$this->db->where('bulan', $bulan);
				$this->db->where('tahun', $tahun);

				$deleteAbsen = $this->ModelAbsensi->deleteAbsen($id, $data);

			}

			// Set flash message and redirect
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil diperbarui!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
			redirect('admin/data_absensi?bulan=' . $bulan . '&tahun=' . $tahun);
		}
	}

	public function delete_data($id)
	{
		$this->load->model('ModelAbsensi'); // Load the model
		$deleteAbsen = $this->ModelAbsensi->deleteAbsen($id);

		// var_dump($deleteAbsen);
		// die();

		if ($deleteAbsen) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Gagal menghapus data!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		}
		redirect('admin/data_absensi');
	}

}
?>
