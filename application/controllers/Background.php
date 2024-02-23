<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Background extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_background');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Background',
            'background' => $this->m_background->get_all_data(),
            'isi' => 'background/v_bg',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
    {
        // Set aturan validasi untuk form tambah background
        $this->form_validation->set_rules('bg', 'Background', 'callback_upload_check');
    
        if ($this->form_validation->run() == true) {
            // Jika form valid, tambahkan background
            $data = array(
                'bg' => $this->upload_image(), // Panggil fungsi untuk mengupload gambar
            );
    
            $this->m_background->add($data); // Panggil model untuk menambahkan background
    
            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
    
            // Redirect ke halaman background setelah berhasil menambahkan
            redirect('background');
        }
    
        // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah background
        $data = array(
            'title' => 'Tambah Background',
            'isi' => 'background/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }
    
    // Callback function untuk mengecek upload gambar
    public function upload_check($str)
    {
        if (empty($_FILES['bg']['name'])) {
            $this->form_validation->set_message('upload_check', 'The {field} field is required.');
            return false;
        } else {
            return true;
        }
    }
    

    public function edit($bghome = null)
{
    // Ambil data background berdasarkan $bghome
    $background = $this->m_background->get_data($bghome);

    // Periksa apakah data background ditemukan
    if (!$background) {
        // Redirect atau tampilkan pesan error jika data tidak ditemukan
        redirect('background');
    }

    // Memuat library upload
    $this->load->library('upload');

    $this->form_validation->set_rules('bg', 'Background', 'callback_upload_check');

    if ($this->form_validation->run() == true) {
        // Form validation sukses, update data background
        $data = array();

        // Periksa apakah ada file gambar yang diunggah
        if (!empty($_FILES['bg']['name'])) {
            // Hapus gambar lama dari folder
            if ($background->bg != '' && file_exists('./assets/image_bg/' . $background->bg)) {
                unlink('./assets/image_bg/' . $background->bg);
            }
            // Upload gambar baru
            $data['bg'] = $this->upload_image();
        } else {
            // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
            $data['bg'] = $background->bg;
        }

        $this->m_background->edit($bghome, $data);

        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('background');
    }

    // Jika validasi gagal atau halaman dimuat pertama kali
    $data = array(
        'title' => 'Edit Background',
        'background' => $background, // Kirim data background ke view
        'isi' => 'background/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, false);
}

    

    private function upload_image()
    {
        $config['upload_path'] = './assets/image_bg/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif|web';
        $config['max_size'] = '10000';
        $this->upload->initialize($config);
        $field_name = "bg";

        if (!$this->upload->do_upload($field_name)) {
            return ''; // Return string kosong jika upload gagal
        } else {
            $upload_data = $this->upload->data();
            return $upload_data['file_name']; // Return nama file jika upload berhasil
        }
    }

    public function delete($bghome)
    {
        // Periksa apakah background dengan $bghome ada dalam database
        $background = $this->m_background->get_data($bghome);

        if ($background) {

            $background = $this->m_background->get_data($bghome);

            // Delete the bg file if it exists
            if ($background->bg != "") {
                unlink('./assets/image_bg/' . $background->bg);
            }

            // Data for deletion
            $data = array('bghome' => $bghome);
            
            $this->m_background->delete($bghome);

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        } else {
            // Jika background tidak ditemukan, set pesan error
            $this->session->set_flashdata('swal', 'error');
            $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
        }

        // Redirect ke halaman background setelah berhasil menghapus atau jika data tidak ditemukan
        redirect('background');
    }

}