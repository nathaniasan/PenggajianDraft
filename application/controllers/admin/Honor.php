<?php
class Honor extends CI_Controller
{
	public $modelHonor;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelHonor'); // Load the model properly
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
		$data['title'] = "Daftar Honorer Staff dan Guru";
		// $data['honor'] = $this->ModelHonor->getAllHonor();
		// $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['honorer'] = $this->db->query("SELECT 
		data_pegawai.nik,
		data_pegawai.nama_pegawai,
		data_pegawai.jabatan,
		tbl_honor.id_honor,
		tbl_honor.jam_honor,
		tbl_honor.jmlh_honor,
		tbl_honor.id_pegawai
	FROM 
		data_pegawai
	INNER JOIN 
		tbl_honor ON tbl_honor.id_pegawai = data_pegawai.id_pegawai;")->result();
		// var_dump($data['honorer']);
		// die();

		$this->load->view('template_admin/header');
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/honor/data_honor', $data);
		$this->load->view('template_admin/footer');
	}


	public function tambah_honor()
	{
		$data['title'] = "Tambah Honorer";
		$data['fetch_pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		// var_dump($data['fetch_pegawai']);
		// die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/honor/tambah_honor', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_honor_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_honor();
		} else {
			$jam_honor = $this->input->post('jam_honor');
			$jmlh_honor = $this->input->post('jmlh_honor');
			$id_pegawai = $this->input->post('id_pegawai');


			$data = array(
				'jam_honor' => $jam_honor,
				'jmlh_honor' => $jmlh_honor,
				'id_pegawai' => $id_pegawai,

			);

			$this->ModelHonor->addHonor($data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/honor');
		}
	}
	public function _rules()
	{
		$this->form_validation->set_rules('jam_honor', 'Jam Honor', 'required|numeric');
		$this->form_validation->set_rules('jmlh_honor', 'Jumlah Honor', 'required|numeric');
	}


	public function update_data($id)
	{
		$data['title'] = "Update data honor";
		$data['honor'] = $this->ModelHonor->getHonorById($id);
		$data['fetch_pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		// var_dump($data['$fetch_pegawai']);
		// die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/honor/update_honor', $data);
		$this->load->view('template_admin/footer');

	}

	public function update_honor_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->update_data();
		} else {
			$id_honor = $this->input->post('id_honor');
			$jam_honor = $this->input->post('jam_honor');
			$jmlh_honor = $this->input->post('jmlh_honor');
			$id_pegawai = $this->input->post('id_pegawai');


			$data = array(
				'jam_honor' => $jam_honor,
				'jmlh_honor' => $jmlh_honor,
				'id_pegawai' => $id_pegawai,

			);

			$this->ModelHonor->updateHonor($id_honor, $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/honor');
		}

	}
	public function delete_data($id)
	{
		$this->ModelHonor->deleteHonor($id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('admin/honor');

	}
}
?>