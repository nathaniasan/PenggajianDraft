<?php
class ModelTugas_Tambahan extends CI_Model
{

	// Constructor and other methods as before

	public function getAlldata_TugasTambahan()
	{
		$query = $this->db->get('tugas_tambahan');
		return $query->result();
	}

	public function getTugasById($id)
	{
		$query = $this->db->get_where('tugas_tambahan', array('id_tugas' => $id));
		return $query->row();
	}

	public function addTugas($data)
	{
		return $this->db->insert('tugas_tambahan', $data);
	}

	public function updateTugas($id, $data)
	{
		$this->db->where('id_tugas', $id);
		return $this->db->update('tugas_tambahan', $data);
	}

	public function deleteTugas($id)
	{
		$this->db->where('id_tugas', $id);
		return $this->db->delete('tugas_tambahan');
	}
}


