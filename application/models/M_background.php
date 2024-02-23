<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_background extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_bg_home');
        $this->db->order_by('bghome', 'desc');
        return $this->db->get()->result();
    }
    public function get_data($bghome)
    {
        $this->db->select('*');
        $this->db->from('tbl_bg_home');
        $this->db->where('bghome', $bghome);
        return $this->db->get()->row();
    }
    public function edit($bghome, $data)
    {
        $this->db->where('bghome', $bghome);
        $this->db->update('tbl_bg_home', $data);
    }
    public function delete($bghome)
    {
        $this->db->where('bghome', $bghome);
        $this->db->delete('tbl_bg_home');
    }
    public function add($data)
    {
        $this->db->insert('tbl_bg_home', $data);
    }
}