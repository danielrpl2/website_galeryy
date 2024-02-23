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
        $this->load->model('m_logo');
        $this->load->model('m_background');
        $this->load->library('upload');

        // Load model dan library yang dibutuhkan
    }

    public function index()
    {

        if (!$this->session->userdata('userid')) {
            // If user is not logged in, redirect to login page
            redirect('login');
        }

        // Ambil data pengguna yang sudah login dari session atau sesuai kebutuhan
        $userid = $this->session->userdata('userid');
        $user_data = $this->m_user->get_data($userid);
        $total_like = $this->m_profile->get_total_likes_per_user($userid);
        $total_postingan = $this->m_profile->get_total_postingan_per_user($userid);
        $total_komentar = $this->m_profile->get_total_komentar_per_user($userid);
        $postingan = $this->m_profile->get_all_data_by_userid($userid);

        // Load view profil dengan data pengguna yang sudah login, foto yang diunggah oleh pengguna, dan total jumlah like
        $data = array(
            'title' => 'Profil Pengguna',         
            'user_data' => $user_data,
            'total_like' => $total_like,
            'total_postingan' => $total_postingan,
            'foto' => $this->m_foto->get_all_data(),
            'background' => $this->m_background->get_all_data(),
            'level_user' => $this->session->userdata('level_user'), // Pass level_user to the view
            'logo' => $this->m_logo->get_all_data(),
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

    public function profile_admin()
    {

        if (!$this->session->userdata('userid')) {
            // If user is not logged in, redirect to login page
            redirect('login');
        }

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
            'isi' => 'profile/v_profile_admin',
        );

        $total_likes_per_fotoid = array();
        foreach ($data['postingan'] as $postingan) {
            $total_likes_per_fotoid[$postingan->fotoid] = $this->m_like->get_total_likes($postingan->fotoid);
        }

        // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;

        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    // public function detail($userid)
    // {
    //     // Mendapatkan data pengguna berdasarkan userid
    //     $userid = $this->session->userdata('userid');
    //     $user_data = $this->m_user->get_data($userid);
    //     $total_like = $this->m_profile->get_total_likes_per_user($userid);
    //     $total_komentar = $this->m_profile->get_total_komentar_per_user($userid);
    //     $total_postingan = $this->m_profile->get_total_postingan_per_user($userid);
    //     $postingan = $this->m_profile->get_all_data_by_userid($userid);

    //     // Jika data pengguna tidak ditemukan, bisa diarahkan ke halaman 404 atau halaman lain
    //     if (!$user_data) {
    //         show_404(); // Menampilkan halaman 404
    //         // Atau, bisa diarahkan ke halaman lain
    //         // redirect('error_page');
    //     }

    //     // Load view halaman detail profil dengan data pengguna
    //     $data = array(
    //         'title' => 'Detail Profil Pengguna',
    //         'background' => $this->m_background->get_all_data(),
    //         'logo' => $this->m_logo->get_all_data(),
    //         'total_like' => $total_like,
    //         'total_postingan' => $total_postingan,
    //         'level_user' => $this->session->userdata('level_user'), // Pass level_user to the view
    //         'total_komentar' => $total_komentar,
    //         'postingan' => $postingan, // Mengirim data foto ke view
    //         'user_data' => $user_data,
    //         'isi' => 'profile/v_profile', // Sesuaikan dengan view halaman detail profil
    //     );
    //     $this->load->view('layout/v_wrapper_frontend', $data, false);

    //     $total_likes_per_fotoid = array();
    //     foreach ($data['postingan'] as $postingan) {
    //         $total_likes_per_fotoid[$postingan->fotoid] = $this->m_like->get_total_likes($postingan->fotoid);
    //     }

    //     // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
    //     $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;
    // }

    public function like_photo_profile()
    {
        // Pastikan hanya user yang sesuai yang bisa melakukan like
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Lakukan tindakan sesuai dengan kebijakan aplikasi Anda
            redirect('login');
            return;
        }

        // Ambil fotoid dari permintaan AJAX
        $fotoid = $this->input->post('fotoid');

        // Panggil model untuk menambahkan like
        $this->m_like->add_like($fotoid, $this->session->userdata('userid'));

        // Kirimkan tanggapan kembali ke frontend
        echo json_encode(array('status' => 'success'));
    }

    public function dislike_photo_profile()
    {
        // Pastikan hanya user yang sesuai yang bisa melakukan dislike
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Lakukan tindakan sesuai dengan kebijakan aplikasi Anda
            redirect('login');
            return;
        }

        // Ambil fotoid dari permintaan AJAX
        $fotoid = $this->input->post('fotoid');

        // Panggil model untuk menghapus like
        $this->m_like->remove_like($fotoid, $this->session->userdata('userid'));

        // Kirimkan tanggapan kembali ke frontend
        echo json_encode(array('status' => 'success'));
    }

    public function like_photo_profile_detail()
    {
        // Pastikan hanya user yang sesuai yang bisa melakukan like
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Lakukan tindakan sesuai dengan kebijakan aplikasi Anda
            redirect('login');
            return;
        }

        // Ambil fotoid dari permintaan AJAX
        $fotoid = $this->input->post('fotoid');

        // Panggil model untuk menambahkan like
        $this->m_like->add_like($fotoid, $this->session->userdata('userid'));

        // Kirimkan tanggapan kembali ke frontend
        echo json_encode(array('status' => 'success'));
    }

    public function dislike_photo_profile_detail()
    {
        // Pastikan hanya user yang sesuai yang bisa melakukan dislike
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Lakukan tindakan sesuai dengan kebijakan aplikasi Anda
            redirect('login');
            return;
        }

        // Ambil fotoid dari permintaan AJAX
        $fotoid = $this->input->post('fotoid');

        // Panggil model untuk menghapus like
        $this->m_like->remove_like($fotoid, $this->session->userdata('userid'));

        // Kirimkan tanggapan kembali ke frontend
        echo json_encode(array('status' => 'success'));
    }

    public function view($userid)
    {
        // Mendapatkan data pengguna berdasarkan userid
        $user_data = $this->m_user->get_data($userid);
        $total_like = $this->m_profile->get_total_likes_per_user($userid);
        $total_postingan = $this->m_profile->get_total_postingan_per_user($userid);
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
            'logo' => $this->m_logo->get_all_data(),
            'background' => $this->m_background->get_all_data(),
            'level_user' => $this->session->userdata('level_user'), // Pass level_user to the view
            'total_postingan' => $total_postingan,
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

        if (!$this->session->userdata('userid')) {
            // If user is not logged in, redirect to login page
            redirect('login');
        }

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
            'foto' => $this->m_foto->get_all_data(),
            'logo' => $this->m_logo->get_all_data(),
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
            'logo' => $this->m_logo->get_all_data(),
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

    private function upload_image_user()
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

    public function edit_profile()
    {
        // Ambil userid dari sesi
        $userid = $this->session->userdata('userid');
        $user = $this->m_user->get_data($userid);

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
            );

            // Periksa apakah ada file gambar yang diunggah
            if ($_FILES['image']['name'] != '') {
                // Hapus gambar lama dari folder
                if ($user->image != '' && file_exists('./assets/image_user/' . $user->image)) {
                    unlink('./assets/image_user/' . $user->image);
                }
                // Upload gambar baru
                $data['image'] = $this->upload_image_user();
            } else {
                // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
                $data['image'] = $user->image;
            }

            $this->m_user->edit($userid, $data);
            $this->update_session_user_data($data);

            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('profile');
        }

        // Jika validasi gagal, kembali ke halaman edit profile dengan error message
        $data = array(
            'title' => 'Edit Profile',
            'header' => 'Edit Profile',
            'logo' => $this->m_logo->get_all_data(),
            'user' => $this->m_user->get_data($userid), // Ambil data user yang akan diedit
            'isi' => 'profile/v_edit_profile', // Sesuaikan dengan view halaman edit profile
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function edit_profile_admin()
    {
        // Ambil userid dari sesi
        $userid = $this->session->userdata('userid');
        $user = $this->m_user->get_data($userid);

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
            );

            // Periksa apakah ada file gambar yang diunggah
            if ($_FILES['image']['name'] != '') {
                // Hapus gambar lama dari folder
                if ($user->image != '' && file_exists('./assets/image_user/' . $user->image)) {
                    unlink('./assets/image_user/' . $user->image);
                }
                // Upload gambar baru
                $data['image'] = $this->upload_image_user();
            } else {
                // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
                $data['image'] = $user->image;
            }

            $this->m_user->edit($userid, $data);
            $this->update_session_user_data($data);

            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
            redirect('profile/edit_profile_admin');
        }

        // Jika validasi gagal, kembali ke halaman edit profile dengan error message
        $data = array(
            'title' => 'Edit Profile',
            'header' => 'Edit Profile',
            'user' => $this->m_user->get_data($userid), // Ambil data user yang akan diedit
            'isi' => 'profile/v_edit_profile_admin', // Sesuaikan dengan view halaman edit profile
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

}
