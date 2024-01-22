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
		$data['tugas'] = $this->ModelTugas_Tambahan->getAlldata_TugasTambahan();
        

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugastambahan/data_tugas', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data()
	{
		$data['title'] = "Tambah Data Tugas Tambahan";
		$data['tugas'] = $this->ModelTugas_Tambahan->get_data('data_tugas')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugas/tambah_data', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$id_tugas = $this->input->post('id_tugas');
			$nama_tugas = $this->input->post('nama_tugas');
			$id_pegawai = $this->input->post('id_pegawai');
			$id_jabatan = md5($this->input->post('id_jabatan'));
			}

			$data = array(
                'id_tugas' => $id_tugas,
				'nama_tugas' => $nama_tugas,
				'id_pegawai' => $id_pegawai,
				'id_jabatan' => $id_jabatan,
			);

			$this->ModelTugas_Tambahan->insert_data($data, 'data_tugas');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_tugas');
		}

	

	public function update_data($id)
	{
		$where = array('id_tugas' => $id);
		$data['title'] = "Data Tugas Tambahan";
		$data['tugas'] = $this->ModelTugas_Tambahan->get_data('data_tugas')->result();
	

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/tugas/update_data', $data);
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
				$id_jabatan = $this->input->post('id_jabatan');
				

				$data = array(
					'id_tugas' => $id_tugas,
					'nama_tugas' => $nama_tugas,
					'id_pegawai' => $id_pegawai,
					'id_jabatan' => $id_jabatan,
					
				);

				$where = array(
					'id_tugas' => $id_tugas

				);

				$this->ModelTugas_Tambahan->update_data('data_tugas', $data, $where);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin/data_tugas');
			}
    }

	public function _rules()
	{
		$this->form_validation->set_rules('id_tugas', 'Id Tugas', 'required');
		$this->form_validation->set_rules('nama_tugas', 'Nama Tugas', 'required');
		$this->form_validation->set_rules('id_pegawai', 'Id Pegawai', 'required');
		$this->form_validation->set_rules('id_jabatan', 'Id Jabatan', 'required');
	}

	public function delete_data($id)
	{
		$where = array('id_tugas' => $id);
		$this->ModelTugas_Tambahan->delete_data($where, 'data_tugas');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
		redirect('admin/data_tugas');
	}
}
?>