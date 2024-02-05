<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Dashboard',
            'total_album' => $this->m_dashboard->get_total_all_album(),
            'total_user' => $this->m_dashboard->get_total_all_user(),
            'isi' => 'v_dashboard',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }
}