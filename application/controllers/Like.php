<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Like extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_like');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Like',
            'like' => $this->m_like->get_all_data(),
            'isi' => 'like/v_like',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
    {
        // Set aturan validasi untuk form tambah user
        $this->form_validation->set_rules('fotoid', 'Fotoid', 'required');
        $this->form_validation->set_rules('userid', 'Userid', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == true) {
            // Jika form valid, tambahkan user
            $data = array(
                'fotoid' => $this->input->post('fotoid'),
                'userid' => $this->input->post('userid'),
                'tanggal' => $this->input->post('tanggal'),
            );

            $this->m_like->add($data); // Panggil model untuk menambahkan user

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');

            // Redirect ke halaman user setelah berhasil menambahkan
            redirect('like');
        }

        // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah user
        $data = array(
            'title' => 'Tambah Like',
            'isi' => 'like/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function edit($likeid = null)
    {
        // Ambil data user berdasarkan $likeid
        $like = $this->m_like->get_data($likeid);

        // Jika user tidak ditemukan, bisa ditangani sesuai kebutuhan

        // Set aturan validasi untuk form
        $this->form_validation->set_rules('fotoid', 'Fotoid', 'required');
        $this->form_validation->set_rules('userid', 'Userid', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == true) {
            // Form validation sukses, update data user
            $data = array(
                'fotoid' => $this->input->post('fotoid'),
                'userid' => $this->input->post('userid'),
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->m_like->edit($likeid, $data); // Perhatikan perubahan ini
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('like');
        }

        // Jika validasi gagal atau halaman dimuat pertama kali
        $data = array(
            'title' => 'Edit Like',
            'like' => $like, // Kirim data like ke view
            'isi' => 'like/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function delete($likeid)
    {
        // Periksa apakah user dengan $userid ada dalam database
        $like = $this->m_like->get_data($likeid);

        if ($like) {
            // Jika user ditemukan, hapus user dari database
            $this->m_like->delete($likeid);

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        } else {
            // Jika user tidak ditemukan, set pesan error
            $this->session->set_flashdata('swal', 'error');
            $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
        }

        // Redirect ke halaman user setelah berhasil menghapus atau jika data tidak ditemukan
        redirect('like');
    }

}
