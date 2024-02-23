<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_album extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_album');
        $this->db->order_by('albumid', 'desc');
        return $this->db->get()->result();
    }
    
    public function get_all_data_foto($albumid)
{
    $this->db->select('*');
    $this->db->from('tbl_foto'); // Adjust the table name according to your database schema
    $this->db->where('albumid', $albumid);
    return $this->db->get()->result();
}

    public function album($albumid)
    {
        $this->db->select('*');
        $this->db->from('tbl_album');
        $this->db->where('albumid', $albumid);
        return $this->db->get()->row(); 
    }

    public function add($data)
    {
        $this->db->insert('tbl_album', $data);
    }
    

    public function edit($albumid, $data)
    {
        $this->db->where('albumid', $albumid);
        $this->db->update('tbl_album', $data);
    }

    public function get_data($albumid)
    {
        $this->db->select('*');
        $this->db->from('tbl_album');
        // $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_album.id_kategori', 'left');
        $this->db->where('albumid', $albumid);
        return $this->db->get()->row();
    }

    public function delete($albumid)
    {
        $this->db->where('albumid', $albumid);
        $this->db->delete('tbl_album');
    }

}
