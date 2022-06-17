<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pekerjaan extends CI_Model
{
    public function showPekerjaanById($id)
    { 
    $this->db->select('*');
    $this->db->from('pengalaman');
    $this->db->where('pengalaman.user_id', $id);
    $this->db->order_by('tahun_masuk', 'DESC');
    $query = $this->db->get();

    return $query->result();
    }
}
