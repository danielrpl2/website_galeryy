<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Album extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_album');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Album',
            'album' => $this->m_album->get_all_data(),
            'isi' => 'album/v_album',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
{
    // Set aturan validasi untuk form tambah user
    $this->form_validation->set_rules('nama_album', 'Nama Album', 'required');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

    if ($this->form_validation->run() == true) {
        // Jika form valid, tambahkan user
        $userid = $this->session->userdata('userid');
        $data = array(
            'nama_album' => $this->input->post('nama_album'),
            'deskripsi' => $this->input->post('deskripsi'),
            'userid' => $userid,
        );

        $this->m_album->add($data); // Panggil model untuk menambahkan user

        // Set pesan flash untuk notifikasi
        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');

        // Redirect ke halaman user setelah berhasil menambahkan
        redirect('album');
    }

    // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah user
    $data = array(
        'title' => 'Tambah Album',
        'isi' => 'album/v_add',
    );
    $this->load->view('layout/v_wrapper_backend', $data, false);
}


    public function edit($albumid = null)
    {
        // Ambil data user berdasarkan $albumid
        $album = $this->m_album->get_data($albumid);
    
        // Jika user tidak ditemukan, bisa ditangani sesuai kebutuhan
    
        // Set aturan validasi untuk form
        $this->form_validation->set_rules('nama_album', 'Nama Album', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
        // $this->form_validation->set_rules('userid', 'Userid', 'required');
    
        if ($this->form_validation->run() == true) {
            // Form validation sukses, update data user
            $data = array(
                'nama_album' => $this->input->post('nama_album'),
                'deskripsi' => $this->input->post('deskripsi'),
                // 'userid' => $this->input->post('userid'),
            );
            $this->m_album->edit($albumid, $data); // Perhatikan perubahan ini
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('album');
        }
    
        // Jika validasi gagal atau halaman dimuat pertama kali
        $data = array(
            'title' => 'Edit Album',
            'album' => $album, // Kirim data album ke view
            'isi' => 'album/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }
    

    public function delete($albumid)
{
    // Periksa apakah user dengan $userid ada dalam database
    $album = $this->m_album->get_data($albumid);

    if ($album) {
        // Jika user ditemukan, hapus user dari database
        $this->m_album->delete($albumid);

        // Set pesan flash untuk notifikasi
        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
    } else {
        // Jika user tidak ditemukan, set pesan error
        $this->session->set_flashdata('swal', 'error');
        $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
    }

    // Redirect ke halaman user setelah berhasil menghapus atau jika data tidak ditemukan
    redirect('album');
}



}
