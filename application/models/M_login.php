<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model 
{
    public function login_user($username, $password) {
        $this->db->select('*');
        $this->db->from('tbl_user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function register($data)
    {
        $this->db->insert('tbl_user', $data);
    }

    //  public function get_profile_image($username) {
    //     $this->db->select('profile_image');
    //     $this->db->from('tbl_user');
    //     $this->db->where('username', $username);
    //     return $this->db->get()->row('profile_image');
    // }

}


	