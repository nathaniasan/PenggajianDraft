<?php

class Data_Pegawai extends CI_Controller
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
		$data['title'] = "Data Pegawai";
		$data['pegawai'] = $this->db->query("SELECT data_pegawai.*,data_jabatan.nama_jabatan
		FROM data_pegawai
		INNER JOIN data_jabatan ON data_pegawai.id_jabatan = data_jabatan.id_jabatan
		ORDER BY data_pegawai.nama_pegawai ASC")->result();

		// var_dump($data['pegawai']);
		// die();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/data_pegawai', $data);
		$this->load->view('template_admin/footer');
	}
	//calculate honor
	// public function getHonor()
	// {
	// 	$tanggal_masuk = $this->input->post('tanggal_masuk');
	// 	$now = new DateTime();
	// 	$tanggal_masuk_obj = new DateTime($tanggal_masuk);
	// 	$interval = $now->diff($tanggal_masuk_obj);
	// 	$years = $interval->y;

	// 	if ($years >= 5) {
	// 		$honor = 100000;
	// 	} else {
	// 		$honor = 50000;
	// 	}
	// 	return json_encode(['honor' => $honor]);

	// }

	public function tambah_data()
	{
		$data['title'] = "Tambah Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/tambah_dataPegawai', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nik = $this->input->post('nik');
			$nama_pegawai = $this->input->post('nama_pegawai');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$id_jabatan = $this->input->post('id_jabatan');
			$tanggal_masuk = $this->input->post('tanggal_masuk');
			$honor = $this->input->post('honor');
			$status = $this->input->post('status');
			$hak_akses = $this->input->post('hak_akses');
			$photo = $_FILES['photo']['name'];
			if ($photo = '') {
			} else {
				$config['upload_path'] = './photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$config['max_size'] = 2048;
				$config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('photo')) {
					echo "Photo Gagal Diupload !";
				} else {
					$photo = $this->upload->data('file_name');
				}
			}

			$data = array(
				'nik' => $nik,
				'nama_pegawai' => $nama_pegawai,
				'username' => $username,
				'password' => $password,
				'jenis_kelamin' => $jenis_kelamin,
				'id_jabatan' => $id_jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'honor' => $honor,
				'status' => $status,
				'hak_akses' => $hak_akses,
				'photo' => $photo,
			);

			$this->ModelPenggajian->insert_data($data, 'data_pegawai');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_pegawai');
		}

	}

	public function update_data($id)
	{
		$error_message = $this->session->flashdata('error_message');

		if (!empty($error_message)) {

			echo '<div class="alert alert-danger">' . $error_message . '</div>';
		}
		$data['error_message'] = $this->session->flashdata('error_message');

		$where = array('id_pegawai' => $id);
		$data['title'] = "update Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pegawai'] = $this->db->query("SELECT data_pegawai.*, data_jabatan.nama_jabatan FROM data_pegawai inner join data_jabatan on data_jabatan.id_jabatan=data_pegawai.id_jabatan WHERE id_pegawai='$id'")->result();
		// var_dump($data['pegawai']);
		// die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/update_dataPegawai', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi()
	{
		// var_dump($id = $this->input->post('id_pegawai'));
		// die();
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_message', 'Tolong isi data yang belum terisi!.');

			$this->update_data($this->input->post('id_pegawai'));
		} else {
			$id = $this->input->post('id_pegawai');
			$nik = $this->input->post('nik');
			$nama_pegawai = $this->input->post('nama_pegawai');
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$id_jabatan = $this->input->post('id_jabatan');
			$tanggal_masuk = $this->input->post('tanggal_masuk');
			$honor = $this->input->post('honor');
			$status = $this->input->post('status');
			$hak_akses = $this->input->post('hak_akses');
			$photo = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path'] = './photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$config['max_size'] = 2048;
				$config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$photo = $this->upload->data('file_name');
					$this->db->set('photo', $photo);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nik' => $nik,
				'nama_pegawai' => $nama_pegawai,
				'username' => $username,
				'password' => $password,
				'jenis_kelamin' => $jenis_kelamin,
				'id_jabatan' => $id_jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'honor' => $honor,
				'status' => $status,
				'hak_akses' => $hak_akses,
			);


			if ($this->form_validation->run() == FALSE) {
				$this->update_data();
			} else {
				$id = $this->input->post('id_pegawai');
				$nik = $this->input->post('nik');
				$nama_pegawai = $this->input->post('nama_pegawai');
				$username = $this->input->post('username');
				$password = md5($this->input->post('password'));
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$id_jabatan = $this->input->post('id_jabatan');
				$tanggal_masuk = $this->input->post('tanggal_masuk');
				$honor = $this->input->post('honor');
				$status = $this->input->post('status');
				$hak_akses = $this->input->post('hak_akses');
				$photo = $_FILES['photo']['name'];
				if ($photo) {
					$config['upload_path'] = './photo';
					$config['allowed_types'] = 'jpg|jpeg|png|tiff';
					$config['max_size'] = 2048;
					$config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('photo')) {
						$photo = $this->upload->data('file_name');
						$this->db->set('photo', $photo);
					} else {
						echo $this->upload->display_errors();
					}
				}

				$data = array(
					'nik' => $nik,
					'nama_pegawai' => $nama_pegawai,
					'username' => $username,
					'password' => $password,
					'jenis_kelamin' => $jenis_kelamin,
					'id_jabatan' => $id_jabatan,
					'tanggal_masuk' => $tanggal_masuk,
					'honor' => $honor,
					'status' => $status,
					'hak_akses' => $hak_akses,
				);

				$where = array(
					'id_pegawai' => $id,

				);

				$this->ModelPenggajian->update_data('data_pegawai', $data, $where);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin/data_pegawai');
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
	}

	public function delete_data($id)
	{
		$where = array('id_pegawai' => $id);

		// Get the file name from the database
		$photo_data = $this->db->select('photo')->get_where('data_pegawai', $where)->row();
		$photo_file = $photo_data->photo;

		// Delete the photo file from the server
		if (!empty($photo_file) && file_exists('./photo/' . $photo_file)) {
			unlink('./photo/' . $photo_file);
		}

		// Delete the data entry from the database
		$this->ModelPenggajian->delete_data($where, 'data_pegawai');

		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data berhasil dihapus!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
		redirect('admin/data_pegawai');
	}

}
?>