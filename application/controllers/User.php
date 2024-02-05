<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'User',
            'user' => $this->m_user->get_all_data(),
            'isi' => 'user/v_user',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
    {
        // Set aturan validasi untuk form tambah user
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == true) {
            // Jika form valid, tambahkan user
            $data = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'level_user' => '1',
                'alamat' => $this->input->post('alamat'),
                'image' => $this->upload_image(), // Panggil fungsi untuk mengupload gambar
            );

            $this->m_user->add($data); // Panggil model untuk menambahkan user

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');

            // Redirect ke halaman user setelah berhasil menambahkan
            redirect('user');
        }

        // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah user
        $data = array(
            'title' => 'Tambah User',
            'isi' => 'user/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function edit($userid = null)
    {
        // Ambil data user berdasarkan $userid
        $user = $this->m_user->get_data($userid);

        // Jika user tidak ditemukan, bisa ditangani sesuai kebutuhan

        // Set aturan validasi untuk form
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == true) {
            // Form validation sukses, update data user
            $data = array(
                'userid' => $userid,
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'email' => $this->input->post('email'),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'alamat' => $this->input->post('alamat'),
                'level_user' => $this->input->post('level_user'),
            );

            // Periksa apakah ada file gambar yang diunggah
            if ($_FILES['image']['name'] != '') {
                // Hapus gambar lama dari folder
                if ($user->image != '' && file_exists('./assets/image_user/' . $user->image)) {
                    unlink('./assets/image_user/' . $user->image);
                }
                // Upload gambar baru
                $data['image'] = $this->upload_image();
            } else {
                // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
                $data['image'] = $user->image;
            }

            $this->m_user->edit($userid, $data);
            $this->update_session_user_data($data);

            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('user');
        }

        // Jika validasi gagal atau halaman dimuat pertama kali
        $data = array(
            'title' => 'Edit User',
            'user' => $user, // Kirim data user ke view
            'isi' => 'user/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    private function update_session_user_data($data)
    {
        $this->session->set_userdata('username', $data['username']);
        $this->session->set_userdata('nama_lengkap', $data['nama_lengkap']);
        $this->session->set_userdata('password', $data['password']);
        $this->session->set_userdata('email', $data['email']);
        $this->session->set_userdata('alamat', $data['alamat']);
        $this->session->set_userdata('image', $data['image']);
        // Perbarui informasi lainnya sesuai kebutuhan
    }

    private function upload_image()
    {
        $config['upload_path'] = './assets/image_user/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif|web';
        $config['max_size'] = '10000';
        $this->upload->initialize($config);
        $field_name = "image";

        if (!$this->upload->do_upload($field_name)) {
            return ''; // Return string kosong jika upload gagal
        } else {
            $upload_data = $this->upload->data();
            return $upload_data['file_name']; // Return nama file jika upload berhasil
        }
    }

    public function delete($userid)
    {
        // Periksa apakah user dengan $userid ada dalam database
        $user = $this->m_user->get_data($userid);

        if ($user) {

            $user = $this->m_user->get_data($userid);

            // Delete the image file if it exists
            if ($user->image != "") {
                unlink('./assets/image_user/' . $user->image);
            }

            // Data for deletion
            $data = array('userid' => $userid);
            
            $this->m_user->delete($userid);

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        } else {
            // Jika user tidak ditemukan, set pesan error
            $this->session->set_flashdata('swal', 'error');
            $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
        }

        // Redirect ke halaman user setelah berhasil menghapus atau jika data tidak ditemukan
        redirect('user');
    }

}
