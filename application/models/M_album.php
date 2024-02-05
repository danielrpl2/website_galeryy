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
