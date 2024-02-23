<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('m_login');
        $this->ci->load->library('session');
    }

    public function login($username, $password)
    {
        $cek = $this->ci->m_login->login_user($username, $password);
        if ($cek) {
            $userid = $cek->userid; // Menyimpan userid
            $nama_lengkap = $cek->nama_lengkap;
            $level_user = $cek->level_user;
            $email = $cek->email;
            $alamat = $cek->alamat;
            $image = $cek->image; // Menyimpan image

            $this->ci->session->set_userdata('userid', $userid);
            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('email', $email);
            $this->ci->session->set_userdata('alamat', $alamat);
            $this->ci->session->set_userdata('nama_lengkap', $nama_lengkap);
            $this->ci->session->set_userdata('level_user', $level_user);
            $this->ci->session->set_userdata('image', $image);

            if ($level_user === '2') {
                redirect('welcome'); 
                $this->ci->session->set_flashdata('swal', 'success');
                $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Login !!!');
            } else {
                $this->ci->session->set_flashdata('swal', 'success');
                $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Login !!!');
                redirect('dashboard');
            }
        } else {
            $this->ci->session->set_flashdata('error', 'Username Atau Password Salah!!');
            redirect('login');
        }
    }

    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('level_user') !== '1') {
            $this->ci->session->set_flashdata('swal', 'error');
            $this->ci->session->set_flashdata('pesan', 'Anda Tidak Memiliki Izin Untuk Mengakses Halaman Tersebut !!');
            redirect('login');
        }
    }

    public function admin_page()
    {
        $this->user_login->proteksi_halaman(); // Call the protection function
        // Your admin page code goes here
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('nama_lengkap');
        $this->ci->session->unset_userdata('level_user');
        $this->ci->session->set_flashdata('swal', 'success');
        $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout !!!');
        redirect('login');
    }
    
}
