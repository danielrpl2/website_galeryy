<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->order_by('userid', 'desc');
        return $this->db->get()->result();
    }

    public function get_data_by_level($level_user)
{
    $this->db->select('*');
    $this->db->from('tbl_user');
    $this->db->where('level_user', $level_user);
    return $this->db->get()->result();
}


    public function add($data)
    {
        $this->db->insert('tbl_user', $data);
    }
    // public function add($data)
    // {
    //     // Mengambil ID terakhir
    //     $last_id = $this->db->select('userid')->order_by('userid', 'desc')->limit(1)->get('tbl_user')->row();

    //     // Menghasilkan ID baru
    //     if ($last_id) {
    //         $last_id = $last_id->userid;
    //         $id_number = (int) substr($last_id, 3) + 1; // Mengambil angka dari karakter ketiga dan seterusnya
    //         $new_id = 'USR' . str_pad($id_number, 2, '0', STR_PAD_LEFT); // Menggunakan panjang 2 untuk angka
    //     } else {
    //         $new_id = 'USR01'; // ID awal jika ini adalah entri pertama
    //     }

    //     $data['userid'] = $new_id;
    //     $this->db->insert('tbl_user', $data);
    // }

    public function edit($userid, $data)
    {
        $this->db->where('userid', $userid);
        $this->db->update('tbl_user', $data);
    }

    public function get_data($userid)
    {
        $this->db->select('*');
        $this->db->from('tbl_user');
        // $this->db->join('tbl_kategori', 'tbl_kategori.id_kategori = tbl_user.id_kategori', 'left');
        $this->db->where('userid', $userid);
        return $this->db->get()->row();
    }

    public function delete($userid)
    {
        $this->db->where('userid', $userid);
        $this->db->delete('tbl_user');
    }

}
