<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Komentar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_komentar');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Komentar',
            'komentar' => $this->m_komentar->get_all_data(),
            'jumlah_komentar' => $this->m_komentar->jumlah_komentar(),
            'isi' => 'komentar/v_komentar',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
{
    // Set aturan validasi untuk form tambah user
    $this->form_validation->set_rules('fotoid', 'Fotoid', 'required');
    $this->form_validation->set_rules('userid', 'Userid', 'required');
    $this->form_validation->set_rules('komentar', 'Komentar', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

    if ($this->form_validation->run() == true) {
        // Jika form valid, tambahkan user
        $data = array(
            'fotoid' => $this->input->post('fotoid'),
                'userid' => $this->input->post('userid'),
                'komentar' => $this->input->post('komentar'),
                'tanggal' => $this->input->post('tanggal'),
        );

        $this->m_komentar->add($data); // Panggil model untuk menambahkan user

        // Set pesan flash untuk notifikasi
        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');

        // Redirect ke halaman user setelah berhasil menambahkan
        redirect('komentar');
    }

    // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah user
    $data = array(
        'title' => 'Tambah Komentar',
        'isi' => 'komentar/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, false);
}


    public function edit($komentarid = null)
    {
        // Ambil data user berdasarkan $komentarid
        $komentar = $this->m_komentar->get_data($komentarid);
    
        // Jika user tidak ditemukan, bisa ditangani sesuai kebutuhan
    
        // Set aturan validasi untuk form
        $this->form_validation->set_rules('fotoid', 'Fotoid', 'required');
        $this->form_validation->set_rules('userid', 'Userid', 'required');
        $this->form_validation->set_rules('komentar', 'Komentar', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        
        if ($this->form_validation->run() == true) {
            // Form validation sukses, update data user
            $data = array(
                'fotoid' => $this->input->post('fotoid'),
                'userid' => $this->input->post('userid'),
                'komentar' => $this->input->post('komentar'),
                'tanggal' => $this->input->post('tanggal'),
            );
            $this->m_komentar->edit($komentarid, $data); // Perhatikan perubahan ini
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('komentar  ');
        }
    
        // Jika validasi gagal atau halaman dimuat pertama kali
        $data = array(
            'title' => 'Edit Komentar',
            'komentar' => $komentar, // Kirim data komentar ke view
            'isi' => 'komentar/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }
    

    public function delete($komentarid)
{
    // Periksa apakah user dengan $userid ada dalam database
    $komentar = $this->m_komentar->get_data($komentarid);

    if ($komentar) {
        // Jika user ditemukan, hapus user dari database
        $this->m_komentar->delete($komentarid);

        // Set pesan flash untuk notifikasi
        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
    } else {
        // Jika user tidak ditemukan, set pesan error
        $this->session->set_flashdata('swal', 'error');
        $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
    }

    // Redirect ke halaman user setelah berhasil menghapus atau jika data tidak ditemukan
    redirect('komentar');
}

public function delete_all()
{
    // Hapus semua data dari tabel komentar
    $this->m_komentar->delete_all_data();

    // Set pesan flash untuk notifikasi
    $this->session->set_flashdata('swal', 'success');
    $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');

    // Redirect ke halaman komentar setelah berhasil menghapus
    redirect('komentar');
}



}
