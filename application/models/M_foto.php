<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_foto extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('tbl_foto.*, tbl_album.*, tbl_user.*');
        $this->db->from('tbl_foto');
        $this->db->join('tbl_album', 'tbl_album.albumid = tbl_foto.albumid', 'left');
        $this->db->join('tbl_user', 'tbl_user.userid = tbl_foto.userid', 'left');
        $this->db->order_by('tbl_foto.fotoid', 'desc'); // Mengurutkan berdasarkan tanggal terbaru
        return $this->db->get()->result();
    }
    
    

    // public function get_data($fotoid){
    //     $this->db->select('*');
    //     $this->db->from('tbl_foto');
    //     $this->db->join('tbl_album', 'tbl_album.albumid = tbl_foto.albumid', 'left');
    //     $this->db->where('fotoid', $fotoid);
    //     return $this->db->get()->row();
    // }

    public function get_data($fotoid)
    {
        $this->db->select('f.*, u.username, u.nama_lengkap, u.image, a.*');
        $this->db->from('tbl_foto f');
        $this->db->join('tbl_user u', 'u.userid = f.userid');
        $this->db->join('tbl_album a', 'a.albumid = f.albumid');
        $this->db->where('f.fotoid', $fotoid);
        return $this->db->get()->row();
    }

    //menambah data
    public function add($data)
    {
        $this->db->insert('tbl_foto', $data);
    }

    //edit data
    public function edit($data)
    {
        $this->db->where('fotoid', $data['fotoid']);
        $this->db->update('tbl_foto', $data);
    }

    //delete data
    public function delete($data)
    {
        $this->db->where('fotoid', $data['fotoid']);
        $this->db->delete('tbl_foto', $data);
    }

    public function get_all_data_user()
    {
        $this->db->select('f.*, u.username, u.nama_lengkap, u.image'); // Pilih kolom yang dibutuhkan
        $this->db->from('tbl_foto f');
        $this->db->join('tbl_user u', 'u.userid = f.userid'); // Lakukan join antara tbl_foto dan tbl_user
        $this->db->order_by('f.fotoid', 'desc');
        return $this->db->get()->result();
    }

    public function get_recommended_photos($albumid, $limit = 5)
    {
        $this->db->select('f.*, u.*'); // Select all columns from both tbl_foto and tbl_user
        $this->db->from('tbl_foto f');
        $this->db->join('tbl_user u', 'u.userid = f.userid');
        $this->db->where('albumid', $albumid);
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_newest_photos($limit = 5)
{
    $this->db->select('f.*, u.*'); // Pilih semua kolom dari kedua tabel
    $this->db->from('tbl_foto f');
    $this->db->join('tbl_user u', 'u.userid = f.userid'); // Lakukan join antara tbl_foto dan tbl_user
    $this->db->order_by('f.tanggal', 'desc'); // Mengurutkan berdasarkan tanggal upload terbaru
    $this->db->limit($limit); // Batasan jumlah postingan yang diambil
    return $this->db->get()->result();
}


}
