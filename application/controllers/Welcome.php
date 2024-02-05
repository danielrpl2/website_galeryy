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
    }

    public function index()
    {
        $data = array(
            'title' => 'Home',
            'foto' => $this->m_foto->get_all_data(),
            'foto' => $this->m_foto->get_all_data_user(),
            'isi' => 'v_home',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    public function postingan()
    {
        $data = array(
            'title' => 'Postingan',
            'foto' => $this->m_foto->get_all_data(),
            'foto' => $this->m_foto->get_all_data_user(),
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
    
    

    // public function dtl_postingan()
    // {
    //     $data = array(
    //         'title' => 'Detail Postingan',
    //         'foto' => $this->m_foto->get_all_data(),
    //         'isi' => 'v_dtl_postingan',
    //     );
    //     $this->load->view('layout/v_wrapper_frontend', $data, false);
    // }

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
            'level_user' => $this->session->userdata('level_user'), // Pass level_user to the view
            'total_likes_per_fotoid' => $total_likes_per_fotoid,
            'is_liked' => $this->is_liked($fotoid), // Pass is_liked to the view
            'isi' => 'v_dtl_postingan', // Sesuaikan dengan view detail yang akan Anda buat
        );
        
        $this->load->view('layout/v_wrapper_frontend', $data, false);
    }

    //like
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
            'tanggal' => date('Y-m-d H:i:s')
        );
    
        $this->m_komentar->add_comment($data);
    
        redirect('welcome/detail/' . $fotoid);
    }
    
    



    
    public function like_photo()
    {
        // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }
    
        // Ambil fotoid dari form atau sesuai dengan cara Anda mengelola data foto di halaman postingan
        $fotoid = $this->input->post('fotoid'); // Sesuaikan dengan nama input fotoid di form
    
        // Panggil model untuk menambahkan like
        $this->m_like->add_like($fotoid, $this->session->userdata('userid'));
    
        // Redirect kembali ke halaman postingan
        redirect('welcome/postingan');
    }
    
    public function dislike_photo()
    {
        // Lakukan verifikasi level_user atau kondisi lain yang diperlukan
        $level_user = $this->session->userdata('level_user');
        if ($level_user != 1 && $level_user != 2) {
            // Tambahkan logika atau tindakan lain jika level_user tidak memenuhi syarat
            redirect('login'); // Ganti dengan URL yang sesuai
            return;
        }
    
        // Ambil fotoid dari form atau sesuai dengan cara Anda mengelola data foto di halaman postingan
        $fotoid = $this->input->post('fotoid'); // Sesuaikan dengan nama input fotoid di form
    
        // Panggil model untuk menghapus like
        $this->m_like->remove_like($fotoid, $this->session->userdata('userid'));
    
        // Redirect kembali ke halaman postingan
        redirect('welcome/postingan');
    }
    


}
