<?php
class ModelRekap extends CI_Model
{

	// Constructor and other methods as befor
	public function getAllRekap()
	{
		$query = $this->db->get('rekap_potongan');
		return $query->result();
	}

	public function getRekapById($id)
	{
		$query = $this->db->get_where('rekap_potongan', array('id_rekap' => $id));
		return $query->row();
	}

	public function addRekap($data)
	{
		return $this->db->insert('rekap_potongan', $data);
	}

	public function updateRekap($id, $data)
	{
		$this->db->where('id_rekap', $id);
		return $this->db->update('rekap_potongan', $data);
	}

	public function deleteRekap($id)
	{
		$this->db->where('id_rekap', $id);
		return $this->db->delete('rekap_potongan');
	}
}


