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

    public function get_total_likes_per_fotoid($fotoid) {
        $this->db->where('fotoid', $fotoid);
        return $this->db->count_all_results('tbl_like');
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

    // public function get_most_liked_photos_with_details($limit = 10)
    // {
    //     $this->db->select('f.*, a.*'); // Select semua kolom dari kedua tabel
    //     $this->db->from('tbl_like l');
    //     $this->db->join('tbl_foto f', 'f.fotoid = l.fotoid');
    //     $this->db->join('tbl_album a', 'a.albumid = f.albumid');
    //     $this->db->group_by('f.fotoid'); // Group by untuk menghindari duplikasi
    //     $this->db->order_by('COUNT(l.fotoid)', 'DESC'); // Mengurutkan berdasarkan jumlah like
    //     $this->db->limit($limit);
    //     $query = $this->db->get();
    
    //     return $query->result();
    // }
    
    public function get_most_liked_photos_with_details($limit = 5)
    {
        $this->db->select('f.*, a.*, COUNT(l.fotoid) as total_likes'); // Memilih semua kolom dari kedua tabel dan menghitung jumlah like
        $this->db->from('tbl_foto f');
        $this->db->join('tbl_album a', 'a.albumid = f.albumid');
        $this->db->join('tbl_like l', 'f.fotoid = l.fotoid', 'left'); // Menggunakan LEFT JOIN untuk memastikan semua foto diambil
        $this->db->group_by('f.fotoid'); // Mengelompokkan hasil berdasarkan foto
        $this->db->order_by('total_likes', 'DESC'); // Mengurutkan hasil berdasarkan jumlah like dari yang paling banyak
        $this->db->limit($limit); // Mengambil jumlah tertentu dari hasil
    
        $query = $this->db->get();
        return $query->result();
    }


}


