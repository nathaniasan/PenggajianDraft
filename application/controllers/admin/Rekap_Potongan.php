<?php
class Rekap_Potongan extends CI_Controller
{
	public $modelRekap;

	function __construct()
	{
		parent::__construct();
		$this->load->model('ModelRekap'); // Load the model properly
		$this->modelRekap = new ModelRekap(); // Create an instance if necessary (check if it's needed)

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
		$data['title'] = "Rekap Potongan Gaji Pegawai";


		$data['hasil'] = $this->db->query("SELECT rp.id_rekap, rp.id_potongan, rp.id_pegawai, dp.nama_pegawai, pg.id, pg.potongan FROM rekap_potongan rp INNER JOIN 
		data_pegawai dp ON dp.id_pegawai = rp.id_pegawai
	INNER JOIN potongan_gaji pg ON pg.id=rp.id_potongan ORDER BY pg.potongan ASC; ")->result();
		// var_dump($data['hasil']);
		// die();
		$this->load->view('template_admin/header');
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/rekap_potongan/data_potongan', $data);
		$this->load->view('template_admin/footer');
	}
	public function tambahpotongan()
	{

		$aksi['title'] = $this->input->post('aksi1');
		$aksi['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$aksi['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$this->load->view('admin/rekap_potongan/tambah_potongan', $aksi);

	}
	function simpanPotongan()
	{
		$data = array(
			'id_pegawai' => $this->input->post('id_pegawai'),
			'id_potongan' => $this->input->post('id_potongan')
		);
		$this->db->insert('rekap_potongan', $data);

		redirect('admin/rekap_potongan');
	}
	public function update_data($id)
	{
		$data['hasil'] = $this->modelRekap->getRekapById($id);

	}

	public function delete_data($id)
	{
		if ($id) {
			$this->modelRekap->deleteRekap($id);
			redirect('admin/rekap_potongan');
		} else {

		}
	}
}
