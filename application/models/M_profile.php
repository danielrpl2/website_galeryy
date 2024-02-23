<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_profile extends CI_Model
{

    public function get_total_likes_per_user($userid)
    {
        $this->db->select('COUNT(*) as total_likes_user');
        $this->db->from('tbl_like');
        $this->db->where('userid', $userid);
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like per user
        return $result->total_likes_user;
    }

    public function get_total_postingan_per_user($userid)
    {
        $this->db->select('COUNT(*) as total_postingan_user');
        $this->db->from('tbl_foto');
        $this->db->where('userid', $userid);
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like per user
        return $result->total_postingan_user;
    }

    public function get_fotos_with_likes_by_userid($userid, $fotoid)
    {
        $this->db->select('COUNT(*) as total_likes');
        $this->db->from('tbl_like');
        $this->db->where('userid', $userid);
        $this->db->where('fotoid', $fotoid);
        $query = $this->db->get();
        $result = $query->row();

        return $result->total_likes;
    }

    public function get_total_komentar_per_user($userid)
    {
        $this->db->select('COUNT(*) as total_komentar_user');
        $this->db->from('tbl_komentar');
        $this->db->where('userid', $userid);
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like per user
        return $result->total_komentar_user;
    }

    public function get_all_data_by_userid($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_foto');
        $this->db->where('userid', $userid);
        return $this->db->get()->result();
    }

}
