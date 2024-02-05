<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_user');
        $this->load->model('m_profile');
        $this->load->model('m_like');
        $this->load->model('m_foto');
        $this->load->model('m_album');
        // Load model dan library yang dibutuhkan
    }

    public function index()
    {
        // Ambil data pengguna yang sudah login dari session atau sesuai kebutuhan
        $userid = $this->session->userdata('userid');
        $user_data = $this->m_user->get_data($userid);
        $total_like = $this->m_profile->get_total_likes_per_user($userid);
        $total_komentar = $this->m_profile->get_total_komentar_per_user($userid);
        $postingan = $this->m_profile->get_all_data_by_userid($userid);

        // Load view profil dengan data pengguna yang sudah login, foto yang diunggah oleh pengguna, dan total jumlah like
        $data = array(
            'title' => 'Profil Pengguna',
            'user_data' => $user_data,
            'total_like' => $total_like,
            'foto' => $this->m_foto->get_all_data(),
            'album' => $this->m_album->get_all_data(),
            'total_komentar' => $total_komentar,
            'postingan' => $postingan, // Mengirim data foto ke view
            'isi' => 'profile/v_profile',
        );

        $total_likes_per_fotoid = array();
        foreach ($data['postingan'] as $postingan) {
            $total_likes_per_fotoid[$postingan->fotoid] = $this->m_like->get_total_likes($postingan->fotoid);
        }

        // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function detail($userid)
    {
        // Mendapatkan data pengguna berdasarkan userid
        $userid = $this->session->userdata('userid');
        $user_data = $this->m_user->get_data($userid);
        $total_like = $this->m_profile->get_total_likes_per_user($userid);
        $total_komentar = $this->m_profile->get_total_komentar_per_user($userid);
        $postingan = $this->m_profile->get_all_data_by_userid($userid);

        // Jika data pengguna tidak ditemukan, bisa diarahkan ke halaman 404 atau halaman lain
        if (!$user_data) {
            show_404(); // Menampilkan halaman 404
            // Atau, bisa diarahkan ke halaman lain
            // redirect('error_page');
        }

        // Load view halaman detail profil dengan data pengguna
        $data = array(
            'title' => 'Detail Profil Pengguna',
            'total_like' => $total_like,
            'total_komentar' => $total_komentar,
            'postingan' => $postingan, // Mengirim data foto ke view
            'user_data' => $user_data,
            'isi' => 'profile/v_profile', // Sesuaikan dengan view halaman detail profil
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);

        $total_likes_per_fotoid = array();
        foreach ($data['postingan'] as $postingan) {
            $total_likes_per_fotoid[$postingan->fotoid] = $this->m_like->get_total_likes($postingan->fotoid);
        }

        // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;
    }

    public function view($userid)
    {
        // Mendapatkan data pengguna berdasarkan userid
        $user_data = $this->m_user->get_data($userid);
        $total_like = $this->m_profile->get_total_likes_per_user($userid);
        $total_komentar = $this->m_profile->get_total_komentar_per_user($userid);
        $postingan = $this->m_profile->get_all_data_by_userid($userid);

        // Jika data pengguna tidak ditemukan, bisa diarahkan ke halaman 404 atau halaman lain
        if (!$user_data) {
            show_404(); // Menampilkan halaman 404
        }

        // Load view halaman detail profil dengan data pengguna
        $data = array(
            'title' => 'Profil Pengguna',
            'total_like' => $total_like,
            'total_komentar' => $total_komentar,
            'foto' => $this->m_foto->get_all_data(),
            'album' => $this->m_album->get_all_data(),
            'postingan' => $postingan, // Mengirim data foto ke view
            'user_data' => $user_data,
            'isi' => 'profile/v_detail_profile', // Sesuaikan dengan view halaman detail profil
        );
        $total_likes_per_fotoid = array();
        foreach ($data['postingan'] as $postingan) {
            $total_likes_per_fotoid[$postingan->fotoid] = $this->m_like->get_total_likes($postingan->fotoid);
        }

        // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }
    
    public function add()
    {

        $this->form_validation->set_rules('judul', 'Judul', 'required', array('required' => '%s Harus Diisi !!!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s Harus Diisi !!!'));
        $this->form_validation->set_rules('albumid', 'Albumid', 'required', array('required' => '%s Harus Diisi !!!'));

        if ($this->form_validation->run() == true) {
            // Ambil userid dari sesi
            $userid = $this->session->userdata('userid');

            $config['upload_path'] = './assets/image_foto/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
            $config['max_size'] = '10000';
            $this->upload->initialize($config);
            $field_name = "lokasi";

            if (!$this->upload->do_upload($field_name)) {
                // If image upload fails
                $this->session->set_flashdata('swal', 'error');
                $this->session->set_flashdata('pesan', 'Failed to upload image: ' . $this->upload->display_errors());
                redirect('profile');
            } else {
                // If image upload is successful
                $upload_data = array('uploads' => $this->upload->data());

                $data = array(
                    'judul' => $this->input->post('judul'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'tanggal' => date('Y-m-d H:i:s'),
                    'lokasi' => $upload_data['uploads']['file_name'],
                    'albumid' => $this->input->post('albumid'),
                    'userid' => $userid, // Gunakan userid dari sesi
                );

                // Insert data into the database
                $this->m_foto->add($data);

                // Set SweetAlert success message
                $this->session->set_flashdata('swal', 'success');
                $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
                redirect('profile');
            }
        }
        $data = array(
            'title' => 'Tambah Postingan',
            'header' => 'Postingan',
            'album' => $this->m_album->get_all_data(),
            'isi' => 'profile/v_add',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
       
    }

    public function edit($fotoid = null)
    {
        $foto = $this->m_foto->get_data($fotoid);
        $this->form_validation->set_rules('judul', 'Judul', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));
        $this->form_validation->set_rules('albumid', 'Album', 'required', array(
            'required' => '%s Harus Diisi !!!',
        ));

        if ($this->form_validation->run() == true) {

            $data = array(
                'fotoid' => $fotoid,
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'albumid' => $this->input->post('albumid'),
            );

            // Periksa apakah ada file gambar yang diunggah
            if ($_FILES['lokasi']['name'] != '') {
                // Hapus gambar lama dari folder
                if ($foto->lokasi != '' && file_exists('./assets/image_foto/' . $foto->lokasi)) {
                    unlink('./assets/image_foto/' . $foto->lokasi);
                }
                // Upload gambar baru
                $data['lokasi'] = $this->upload_image();
            } else {
                // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
                $data['lokasi'] = $foto->lokasi;
            }

            $this->m_foto->edit($data);
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('profile');

        }
        $data = array(
            'title' => 'Edit Postingan',
            'header' => 'Postingan',
            'foto' => $this->m_foto->get_data($fotoid),
            'album' => $this->m_album->get_all_data(),
            'isi' => 'profile/v_edit',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }


    private function upload_image()
    {
        $config['upload_path'] = './assets/image_foto/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif|web';
        $config['max_size'] = '10000';
        $this->upload->initialize($config);
        $field_name = "lokasi";

        if (!$this->upload->do_upload($field_name)) {
            return ''; // Return string kosong jika upload gagal
        } else {
            $upload_data = $this->upload->data();
            return $upload_data['file_name']; // Return nama file jika upload berhasil
        }
    }

    public function delete($fotoid = null)
    {
        try {
            // Get blog data
            $foto = $this->m_foto->get_data($fotoid);

            // Delete the image file if it exists
            if ($foto->lokasi != "") {
                unlink('./assets/image_foto/' . $foto->lokasi);
            }

            // Data for deletion
            $data = array('fotoid' => $fotoid);

            // Delete data from the database
            $this->m_foto->delete($data);

            // Set SweetAlert success message
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        } catch (Exception $e) {
            // Set SweetAlert error message
            $this->session->set_flashdata('swal', 'error');
            $this->session->set_flashdata('pesan', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // Redirect to the blog page
        redirect('profile');
    }

}
