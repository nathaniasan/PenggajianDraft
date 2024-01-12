<?php
class Honor extends CI_Controller
{
	public $modelHonor;

	function __construct()
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

	function index()
	{
		$data['title'] = "Daftar Honorer Staff dan Guru";
		// $data['honor'] = $this->ModelHonor->getAllHonor();
		// $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['honorer'] = $this->db->query("SELECT data_pegawai.nik,data_pegawai.nama_pegawai,data_jabatan.nama_jabatan,tbl_honor.id_honor,tbl_honor.jam_honor,tbl_honor.jmlh_honor,tbl_honor.id_pegawai FROM data_pegawai
		INNER JOIN tbl_honor ON tbl_honor.id_pegawai=data_pegawai.id_pegawai
		INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
		ORDER BY data_pegawai.nama_pegawai ASC")->result();
		// var_dump($data['honorer']);
		// die();

		$this->load->view('template_admin/header');
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/honor/data_honor', $data);
		$this->load->view('template_admin/footer');
	}


	function tambah_honor()
	{
		$data['title'] = "Tambah Honorer";
		$data['fetch_pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		var_dump($data['fetch_pegawai']);
		die();
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/honor/tambah_honor', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_honor_aksi()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nama_jabatan = $this->input->post('nama_jabatan');
			$tj_struktural = $this->input->post('tj_struktural');
			$tj_transport = $this->input->post('tj_transport');
			$uang_makan = $this->input->post('uang_makan');

			$data = array(
				'nama_jabatan' => $nama_jabatan,
				'tj_struktural' => $tj_struktural,
				'tj_transport' => $tj_transport,
				'uang_makan' => $uang_makan,
			);

			$this->ModelPenggajian->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
		}
	}
	function edit_honor()
	{
		$potongan = $this->input->post('potongan');
		$data['hasil'] = $this->modelPotongan_Gaji->Getpotongan($potongan);
		$this->load->view('admin/potongan_gaji/edit_honor', $data);
	}
	function hapus_honor()
	{
		$honor = $this->input->post('hon');
		$data['hasil'] = $this->modelPotongan_Gaji->Getpotongan($potongan);
		$this->load->view('admin/potongan_gaji/hapus_honor', $data);
	}

	function simpanPotongan()
	{
		$data = array(
			'potongan' => $this->input->post('potongan'),
			'jml_potongan' => $this->input->post('jml_potongan')
		);
		$this->db->insert('potongan_gaji', $data);

		// Set flashdata to show a success message
		// $this->session->set_flashdata('success', 'Data has been successfully inserted.');

		redirect('admin/potongan_gaji/tampilPotongan');
	}

	function editPotongan()
	{
		$data = array(
			'potongan' => $this->input->post('potongan_baru'),
			'jml_potongan' => $this->input->post('jml_potongan')
		);
		$potongan = $this->input->post('potongan_lama');
		$this->db->where('potongan', $potongan);
		$this->db->update('potongan_gaji', $data);
	}
	function hapusPotongan()
	{
		$potongan = $this->input->post('potongan');

		$this->db->delete('potongan_gaji', array('potongan' => $potongan));
	}
}
?>