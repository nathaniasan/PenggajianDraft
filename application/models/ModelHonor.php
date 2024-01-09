<?php
Class ModelHonorer extends CI_Model
{
  function TampilPotongan() 
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('honorer')
          ->get()
          ->result();
    }

    function Getpotongan($potongan = '')
    {
      return $this->db->get_where('honorer', array('potongan' => $potongan))->row();
    }
    function HapusPotongan($potongan)
    {
        $this->db->delete('honorer',array('potongan' => $potongan));
    }
}
