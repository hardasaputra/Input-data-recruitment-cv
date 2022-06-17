<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class M_Document extends CI_Model
{
    public function showAllDocumentById($id)
    {
        $query = "SELECT *
                  FROM document
                  WHERE user_id = $id
                ";
        return $this->db->query($query)->result();
    }
}
