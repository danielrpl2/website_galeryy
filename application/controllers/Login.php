<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('upload');

    }

    public function admin_page()
    {
        $this->user_login->proteksi_halaman(); // Call the protection function
        // Your admin page code goes here
    }

    public function index()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi!!',
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi!!',
        ));

        if ($this->form_validation->run() == true) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $login_result = $this->user_login->login($username, $password);

            if ($login_result) {
                // Login successful
                $this->session->set_flashdata('swal', 'success');
                $this->session->set_flashdata('pesan', 'Login Berhasil !!!');
                redirect('user'); // Redirect to the dashboard or any other page
            } else {
                // Login failed
                $this->session->set_flashdata('swal', 'error');
                $this->session->set_flashdata('pesan', 'Login Gagal. Silahkan Cek Username Dan Password Anda !!!');
                redirect('login'); // Redirect back to the login page
            }
        }

        $data = array(
            'title' => 'Login User',
        );
        $this->load->view('v_login_user', $data, false);
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('ulangi_password', 'Confirm password', 'required|matches[password]', array(
            'required' => '%s Harus Diisi !!!',
            'matches' => '%s Password Tidak Sama... !',
        ));
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]', array(
            'required' => '%s Harus Diisi !!!',
            'is_unique' => '%s Sudah Terdaftar... !',
        ));
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        // $this->form_validation->set_rules('image', 'Image', 'required', array(
        //     'required' => '%s Harus Diisi !!!',
        // ));

        if ($this->form_validation->run() == TRUE) {
        
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'level_user' => '2',
                'image' => 'avatar.png', // Set default image
            );
    
            $this->m_login->register($data);
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Register Berhasil Silahkan Login !!!');
            redirect('login');
        }
    
    

        $data = array(
            'title' => 'Register',
        );
        $this->load->view('v_register', $data, false);

    }

    public function register_s_admin()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('ulangi_password', 'Confirm password', 'required|matches[password]', array(
            'required' => '%s Harus Diisi !!!',
            'matches' => '%s Password Tidak Sama... !',
        ));
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[tbl_user.email]', array(
            'required' => '%s Harus Diisi !!!',
            'is_unique' => '%s Sudah Terdaftar... !',
        ));
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        // $this->form_validation->set_rules('image', 'Image', 'required', array(
        //     'required' => '%s Harus Diisi !!!',
        // ));

        if ($this->form_validation->run() == TRUE) {
        
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'level_user' => '1',
                'image' => 'avatar.png', // Set default image
            );
    
            $this->m_login->register($data);
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Register Berhasil Silahkan Login !!!');
            redirect('login');
        }
    

        $data = array(
            'title' => 'Register Admin',
        );
        $this->load->view('v_register_admin', $data, false);

    }

    public function logout_user()
    {
        $this->user_login->logout();
    }

}
