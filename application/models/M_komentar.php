<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_komentar extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_komentar');
        $this->db->order_by('komentarid', 'desc');
        return $this->db->get()->result();
    }

    public function add($data)
    {
        $this->db->insert('tbl_komentar', $data);
    }

    public function add_comment($data)
    {
        $this->db->insert('tbl_komentar', $data);
    }

    public function get_comments_with_user_info($fotoid)
    {
        $this->db->select('k.*, u.nama_lengkap, u.username, u.image');
        $this->db->from('tbl_komentar k');
        $this->db->join('tbl_user u', 'u.userid = k.userid');
        $this->db->where('k.fotoid', $fotoid);
        $this->db->order_by('k.tanggal', 'asc');
        return $this->db->get()->result();
    }

    public function delete_all_data()
    {
        $this->db->empty_table('tbl_komentar');
    }
    public function jumlah_komentar()
    {

        return $this->db->count_all('tbl_komentar');
    }

    public function edit($komentarid, $data)
    {
        $this->db->where('komentarid', $komentarid);
        $this->db->update('tbl_komentar', $data);
    }

    public function get_data($komentarid)
    {
        $this->db->select('*');
        $this->db->from('tbl_komentar');
        // $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_komentar.id_kategori', 'left');
        $this->db->where('komentarid', $komentarid);
        return $this->db->get()->row();
    }

    public function delete($komentarid)
    {
        $this->db->where('komentarid', $komentarid);
        $this->db->delete('tbl_komentar');
    }

    public function get_total_comments($fotoid)
    {
        $this->db->select('COUNT(*) as total_coment_id');
        $this->db->from('tbl_komentar');
        $this->db->where('fotoid', $fotoid);
        $query = $this->db->get();
        $result = $query->row();

        // Mengembalikan total jumlah like
        return $result->total_coment_id;
    }


    public function get_most_commented_photos($limit = 5)
{
    $this->db->select('f.*, a.*, COUNT(k.komentarid) as total_comments');
    $this->db->from('tbl_foto f');
    $this->db->join('tbl_album a', 'a.albumid = f.albumid');
    $this->db->join('tbl_komentar k', 'f.fotoid = k.fotoid', 'left');
    $this->db->group_by('f.fotoid');
    $this->db->order_by('total_comments', 'DESC');
    $this->db->limit($limit);

    $query = $this->db->get();
    return $query->result();
}


}
