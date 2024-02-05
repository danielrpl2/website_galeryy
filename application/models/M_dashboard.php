<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{
    
    public function get_total_all_album()
    {
        $this->db->select('COUNT(*) as total_album');
        $this->db->from('tbl_album');
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like dari semua foto
        return $result->total_album;
    }

    public function get_total_all_user()
    {
        $this->db->select('COUNT(*) as total_user');
        $this->db->from('tbl_user');
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like dari semua foto
        return $result->total_user;
    }

}