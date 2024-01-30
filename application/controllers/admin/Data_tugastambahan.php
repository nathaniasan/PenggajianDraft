<?php

class data_tugastambahan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('ModelTugas_Tambahan');

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
		$data['title'] = "Data Tugas Tambahan";
		$data['tugas'] = $this->db->query("
		SELECT DISTINCT
    dp.nama_pegawai,
    dj.nama_jabatan, tb.nama_tugas,tb.id_tugas
FROM
    data_pegawai dp inner join data_jabatan dj on dp.id_jabatan = dj.id_jabatan
RIGHT JOIN
    tugas_tambahan tb ON dp.id_pegawai = tb.id_pegawai;
")->result();

		// var_dump($data['tugas']);
		// die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugastambahan/data_tugas', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data['title'] = "Tambah Data Tugas Tambahan";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['tugas'] = $this->db->query("
		SELECT DISTINCT
    dp.nama_pegawai,
    dj.nama_jabatan, tb.nama_tugas,tb.id_tugas
FROM
    data_pegawai dp inner join data_jabatan dj on dp.id_jabatan = dj.id_jabatan
RIGHT JOIN
    tugas_tambahan tb ON dp.id_pegawai = tb.id_pegawai;
")->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugastambahan/tambah_datatugas', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {

			$nama_tugas = $this->input->post('nama_tugas');
			$id_pegawai = $this->input->post('id_pegawai');
			// $id_jabatan = md5($this->input->post('id_jabatan'));
		}

		$data = array(
			'nama_tugas' => $nama_tugas,
			'id_pegawai' => $id_pegawai,
			// 'id_jabatan' => $id_jabatan,
		);

		$this->ModelTugas_Tambahan->addTugas($data);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('admin/data_tugastambahan');
	}



	public function update_data($id)
	{

		$data['title'] = "Edit Data Tugas Tambahan";
		$data['tugas'] = $this->ModelTugas_Tambahan->getTugasById($id);
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		// var_dump($data['tugas']);
		// die();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugastambahan/update_datatugas', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->update_data();
		} else {
			$id_tugas = $this->input->post('id_tugas');
			$nama_tugas = $this->input->post('nama_tugas');
			$id_pegawai = $this->input->post('id_pegawai');



			$data = array(
				'id_tugas' => $id_tugas,
				'nama_tugas' => $nama_tugas,
				'id_pegawai' => $id_pegawai,


			);

			$where = array(
				'id_tugas' => $id_tugas

			);

			$this->ModelTugas_Tambahan->updateTugas($id_tugas, $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_tugastambahan');
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_tugas', 'Nama Tugas', 'required');
		$this->form_validation->set_rules('id_pegawai', 'Id Pegawai', 'required');
		// $this->form_validation->set_rules('id_jabatan', 'Id Jabatan', 'required');
	}

	public function delete_data($id)
	{

		$this->ModelTugas_Tambahan->deleteTugas($id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('admin/data_tugastambahan');
	}
}
?>