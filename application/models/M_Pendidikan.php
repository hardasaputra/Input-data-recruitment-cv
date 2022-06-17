<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class M_Pendidikan extends CI_Model
{
    public function showPendidikanById($id)
    { 
    $this->db->select('*');
    $this->db->from('pendidikan');
    $this->db->join('jenjang', 'pendidikan.jenjang_id = jenjang.id_jenjang');
    $this->db->where('pendidikan.user_id', $id);
    $this->db->order_by('tahun_masuk', 'DESC');
    $query = $this->db->get();

    return $query->result();
    }
}
