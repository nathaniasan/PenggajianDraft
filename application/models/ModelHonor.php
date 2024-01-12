<?php
class ModelHonor extends CI_Model
{

	// Constructor and other methods as befor
	public function getAllHonor()
	{
		$query = $this->db->get('tbl_honor');
		return $query->result();
	}

	public function getHonorById($id)
	{
		$query = $this->db->get_where('tbl_honor', array('id_honor' => $id));
		return $query->row();
	}

	public function addAbsen($data)
	{
		return $this->db->insert('tbl_honor', $data);
	}

	public function updateAbsen($id, $data)
	{
		$this->db->where('id_honor', $id);
		return $this->db->update('tbl_honor', $data);
	}

	public function deleteAbsen($id)
	{
		$this->db->where('id_honor', $id);
		return $this->db->delete('tbl_honor');
	}
}


