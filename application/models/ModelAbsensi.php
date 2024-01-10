<?php
class ModelAbsensi extends CI_Model
{

	// Constructor and other methods as before

	public function getAlldata_kehadiran()
	{
		$query = $this->db->get('data_kehadiran');
		return $query->result();
	}

	public function getAbsenById($id)
	{
		$query = $this->db->get_where('data_kehadiran', array('id_kehadiran' => $id));
		return $query->row();
	}

	public function addAbsen($data)
	{
		return $this->db->insert('data_kehadiran', $data);
	}

	public function updateAbsen($id, $data)
	{
		$this->db->where('id_kehadiran', $id);
		return $this->db->update('data_kehadiran', $data);
	}

	public function deleteAbsen($id)
	{
		$this->db->where('id_kehadiran', $id);
		return $this->db->delete('data_kehadiran');
	}
}


