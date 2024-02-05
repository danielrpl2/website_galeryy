<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_like extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_like');
        $this->db->order_by('likeid', 'desc');
        return $this->db->get()->result();
    }

    public function add($data)
    {
        $this->db->insert('tbl_like', $data);
    }

    public function edit($likeid, $data)
    {
        $this->db->where('likeid', $likeid);
        $this->db->update('tbl_like', $data);
    }

    public function get_data($likeid)
    {
        $this->db->select('*');
        $this->db->from('tbl_like');
        // $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_like.id_kategori', 'left');
        $this->db->where('likeid', $likeid);
        return $this->db->get()->row();
    }

    public function delete($likeid)
    {
        $this->db->where('likeid', $likeid);
        $this->db->delete('tbl_like');
    }

    
    //like
    public function add_like($fotoid, $userid)
    {
        $data = array(
            'fotoid' => $fotoid,
            'userid' => $userid,
            'tanggal' => date('Y-m-d H:i:s')
        );

        $this->db->insert('tbl_like', $data);
        return $this->db->insert_id();
    }

    public function remove_like($fotoid, $userid)
    {
        $this->db->where('fotoid', $fotoid);
        $this->db->where('userid', $userid);
        $this->db->delete('tbl_like');
    }
    
    public function isLiked($fotoid, $userid)
    {
        $this->db->where('fotoid', $fotoid);
        $this->db->where('userid', $userid);
        $query = $this->db->get('tbl_like');

        return $query->num_rows() > 0;
    }
    public function get_total_likes_all_photos()
    {
        $this->db->select('COUNT(*) as total_likes');
        $this->db->from('tbl_like');
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like dari semua foto
        return $result->total_likes;
    }

    public function get_total_likes($fotoid)
    {
        $this->db->select('COUNT(*) as total_likes_id');
        $this->db->from('tbl_like');
        $this->db->where('fotoid', $fotoid);
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like
        return $result->total_likes_id;
    }

}


