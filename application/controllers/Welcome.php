<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_foto');
        $this->load->model('m_like');
        $this->load->model('m_komentar');
        $this->load->model('m_user');
        $this->load->model('m_album');
        $this->load->model('m_logo');
        $this->load->model('m_background');
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'level_user' => $this->session->userdata('level_user'),
            'background' => $this->m_background->get_all_data(),
            'foto' => $this->m_foto->get_all_data(),
            'logo' => $this->m_logo->get_all_data(),
            'album' => $this->m_album->get_all_data(),
            'foto_baru' => $this->m_foto->get_newest_photos(5),
            'foto' => $this->m_foto->get_all_data_user(),
            'most_liked_photos' => $this->m_like->get_most_liked_photos_with_details(),
            'most_coment_photos' => $this->m_komentar->get_most_commented_photos(),
            'isi' => 'v_home',
        );

        // $data['foto'] = $this->m_foto->get_newest_photos(5);

        // Ambil total jumlah like untuk setiap fotoid
        $total_likes_per_fotoid = array();
        foreach ($data['foto'] as $foto) {
            $total_likes_per_fotoid[$foto->fotoid] = $this->m_like->get_total_likes($foto->fotoid);
        }

        // Ambil total jumlah komentar untuk setiap fotoid
        $total_comments_per_fotoid = array();
        foreach ($data['foto'] as $foto) {
            $total_comments_per_fotoid[$foto->fotoid] = $this->m_komentar->get_total_comments($foto->fotoid);
        }

        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;
        $data['total_comments_per_fotoid'] = $total_comments_per_fotoid;

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function album($albumid)
    {
        $album = $this->m_album->album($albumid);

        // Ambil semua data foto berdasarkan albumid
        $data = array(
            'title' => 'Album ' . $album->nama_album,
            'level_user' => $this->session->userdata('level_user'),
            'background' => $this->m_background->get_all_data(),
            'logo' => $this->m_logo->get_all_data(),
            'foto' => $this->m_album->get_all_data_foto($albumid), // Memuat data foto berdasarkan albumid
            'total_likes_per_fotoid' => array(), // Inisialisasi total likes per fotoid
            'users' => $this->m_user->get_all_data(), // Ambil semua data pengguna
            'isi' => 'v_album',
        );

        if (empty($data['foto'])) {
            redirect('welcome/not_found'); // Ganti 'halaman_lain' dengan URL halaman lain yang ingin Anda arahkan
        }

        // Mengambil total likes per fotoid untuk setiap foto dalam album
        foreach ($data['foto'] as $foto_item) {
            $data['total_likes_per_fotoid'][$foto_item->fotoid] = $this->m_like->get_total_likes_per_fotoid($foto_item->fotoid);
        }

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function not_found()
    {
        $data = array(
            'title' => 'NOT FOUND',
            // 'isi' => 'v_404',
        );

        $this->load->view('v_404', $data, false);
    }

    public function postingan()
    {
        $data = array(
            'title' => 'Postingan',
            'foto' => $this->m_foto->get_all_data(),
            'foto' => $this->m_foto->get_all_data_user(),
            'logo' => $this->m_logo->get_all_data(),
            'background' => $this->m_background->get_all_data(),
            'level_user' => $this->session->userdata('level_user'),
            'isi' => 'v_postingan',
        );

        // Ambil total jumlah like untuk setiap fotoid
        $total_likes_per_fotoid = array();
        foreach ($data['foto'] as $foto) {
            $total_likes_per_fotoid[$foto->fotoid] = $this->m_like->get_total_likes($foto->fotoid);
        }

        // Sertakan total jumlah like per fotoid dalam data yang akan dikirim ke view
        $data['total_likes_per_fotoid'] = $total_likes_per_fotoid;

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function detail($fotoid = null)
    {
        // Ambil data foto berdasarkan $fotoid
        $foto = $this->m_foto->get_data($fotoid);

        // Jika foto tidak ditemukan, bisa ditangani sesuai kebutuhan
        $comments = $this->m_komentar->get_comments_with_user_info($fotoid);
        // Ambil semua data user

        // Ambil semua foto yang direkomendasikan dari album yang sama
        $rekomendasi_foto = $this->m_foto->get_recommended_photos($foto->albumid);
        $total_likes_per_fotoid = $this->m_like->get_total_likes($fotoid);

        // Kirim data foto dan rekomendasi foto ke view detail
        $data = array(
            'title' => 'Detail Foto',
            'foto' => $foto, // Kirim data foto ke view
            'comments' => $comments, // Kirim data komentar ke view
            'rekomendasi_foto' => $rekomendasi_foto, // Kirim data rekomendasi foto ke view
            'logo' => $this->m_logo->get_all_data(),
            'background' => $this->m_background->get_all_data(),
            'level_user' => $this->session->userdata('level_user'), // Pass level_user to the view
            'total_likes_per_fotoid' => $total_likes_per_fotoid,
            'is_liked' => $this->is_liked($fotoid), // Pass is_liked to the view
            'isi' => 'v_dtl_postingan', // Sesuaikan dengan view detail yang akan Anda buat
        );

        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    //like detail
    public function add_like($fotoid)
    {
        // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }

        // Lakukan penambahan like
        $userid = $this->session->userdata('userid'); // Sesuaikan dengan cara Anda mengelola sesi login
        $this->m_like->add_like($fotoid, $userid);

        // Redirect kembali ke halaman foto atau halaman lain yang sesuai
        redirect('welcome/detail/' . $fotoid);
    }

    // Fungsi untuk memeriksa apakah foto sudah dilike oleh pengguna
    private function is_liked($fotoid)
    {
        $userid = $this->session->userdata('userid'); // Sesuaikan dengan cara Anda mengelola sesi login
        return $this->m_like->isLiked($fotoid, $userid);
    }

    public function remove_like($fotoid)
    {
        // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }

        // Lakukan penghapusan like
        $userid = $this->session->userdata('userid'); // Sesuaikan dengan cara Anda mengelola sesi login
        $this->m_like->remove_like($fotoid, $userid);

        // Redirect kembali ke halaman foto atau halaman lain yang sesuai
        redirect('welcome/detail/' . $fotoid); // Ganti dengan URL yang sesuai
    }

    public function add_comment()
    {
        $fotoid = $this->input->post('fotoid');
        $komentar = $this->input->post('komentar');

        // Anda dapat menambahkan validasi input di sini

        $data = array(
            'userid' => $this->session->userdata('userid'),
            'fotoid' => $fotoid,
            'komentar' => $komentar,
            'tanggal' => date('Y-m-d H:i:s'),
        );

        $this->m_komentar->add_comment($data);

        redirect('welcome/detail/' . $fotoid);
    }

    //postingan
    public function like_photo()
    {
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

    public function dislike_photo()
    {
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Lakukan tindakan sesuai dengan kebijakan aplikasi Anda
            redirect('login');
            return;
        }

        // Ambil fotoid dari permintaan AJAX
        $fotoid = $this->input->post('fotoid');

        // Panggil model untuk menambahkan like
        $this->m_like->remove_like($fotoid, $this->session->userdata('userid'));

        // Kirimkan tanggapan kembali ke frontend
        echo json_encode(array('status' => 'success'));
    }

    //home
//   public function like_photo_home()
//   {
//       // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
//       $level_user = $this->session->userdata('level_user');
//       if ($level_user != 1 && $level_user != 2) {
//           // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
//           redirect('login'); // Ganti dengan URL yang sesuai
//           return;
//       }

//       // Ambil fotoid dari form atau sesuai dengan cara Anda mengelola data foto di halaman postingan
//       $fotoid = $this->input->post('fotoid'); // Sesuaikan dengan nama input fotoid di form

//       // Panggil model untuk menambahkan like
//       $this->m_like->add_like($fotoid, $this->session->userdata('userid'));

//       // Redirect kembali ke halaman postingan
//       redirect('welcome');
//   }

//   public function dislike_photo_home()
//   {
//       // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
//       $level_user = $this->session->userdata('level_user');
//       if ($level_user != 1 && $level_user != 2) {
//           // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
//           redirect('login'); // Ganti dengan URL yang sesuai
//           return;
//       }

//       // Ambil fotoid dari form atau sesuai dengan cara Anda mengelola data foto di halaman postingan
//       $fotoid = $this->input->post('fotoid'); // Sesuaikan dengan nama input fotoid di form

//       // Panggil model untuk menghapus like
//       $this->m_like->remove_like($fotoid, $this->session->userdata('userid'));

//       // Redirect kembali ke halaman postingan
//       redirect('welcome');
//   }

    public function like_photo_home()
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

    public function dislike_photo_home()
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

    public function like_photo_album()
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

    public function dislike_photo_album()
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

}
