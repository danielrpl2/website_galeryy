<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_logo extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_logo');
        $this->db->order_by('logoid', 'desc');
        return $this->db->get()->result();
    }
    public function get_data($logoid)
    {
        $this->db->select('*');
        $this->db->from('tbl_logo');
        $this->db->where('logoid', $logoid);
        return $this->db->get()->row();
    }
    public function edit($logoid, $data)
    {
        $this->db->where('logoid', $logoid);
        $this->db->update('tbl_logo', $data);
    }
    public function delete($logoid)
    {
        $this->db->where('logoid', $logoid);
        $this->db->delete('tbl_logo');
    }
    public function add($data)
    {
        $this->db->insert('tbl_logo', $data);
    }
}