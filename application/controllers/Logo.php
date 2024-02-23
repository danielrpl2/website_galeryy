<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logo extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logo');
        // $this->load->library('upload');
    }

    public function index()
    {
        $data = array(
            'title' => 'Logo',
            'logo' => $this->m_logo->get_all_data(),
            'isi' => 'logo/v_logo',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    public function add()
    {
        // Set aturan validasi untuk form tambah logo
        $this->form_validation->set_rules('logo', 'Logo', 'callback_upload_check');
    
        if ($this->form_validation->run() == true) {
            // Jika form valid, tambahkan logo
            $data = array(
                'logo' => $this->upload_image(), // Panggil fungsi untuk mengupload gambar
            );
    
            $this->m_logo->add($data); // Panggil model untuk menambahkan logo
    
            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !!!');
    
            // Redirect ke halaman logo setelah berhasil menambahkan
            redirect('logo');
        }
    
        // Jika validasi gagal atau halaman dimuat pertama kali, tampilkan form tambah logo
        $data = array(
            'title' => 'Tambah Logo',
            'isi' => 'logo/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }
    
    // Callback function untuk mengecek upload gambar
    public function upload_check($str)
    {
        if (empty($_FILES['logo']['name'])) {
            $this->form_validation->set_message('upload_check', 'The {field} field is required.');
            return false;
        } else {
            return true;
        }
    }
    

    public function edit($logoid = null)
{
    // Ambil data logo berdasarkan $logoid
    $logo = $this->m_logo->get_data($logoid);

    // Periksa apakah data logo ditemukan
    if (!$logo) {
        // Redirect atau tampilkan pesan error jika data tidak ditemukan
        redirect('logo');
    }

    // Memuat library upload
    $this->load->library('upload');

    $this->form_validation->set_rules('logo', 'Logo', 'callback_upload_check');

    if ($this->form_validation->run() == true) {
        // Form validation sukses, update data logo
        $data = array();

        // Periksa apakah ada file gambar yang diunggah
        if (!empty($_FILES['logo']['name'])) {
            // Hapus gambar lama dari folder
            if ($logo->logo != '' && file_exists('./assets/image_logo/' . $logo->logo)) {
                unlink('./assets/image_logo/' . $logo->logo);
            }
            // Upload gambar baru
            $data['logo'] = $this->upload_image();
        } else {
            // Gunakan nama gambar lama jika tidak ada file gambar yang diunggah
            $data['logo'] = $logo->logo;
        }

        $this->m_logo->edit($logoid, $data);

        $this->session->set_flashdata('swal', 'success');
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !!!');
        redirect('logo');
    }

    // Jika validasi gagal atau halaman dimuat pertama kali
    $data = array(
        'title' => 'Edit Logo',
        'logo' => $logo, // Kirim data logo ke view
        'isi' => 'logo/v_edit',
    );
    $this->load->view('layout/v_wrapper_backend', $data, false);
}

    

    private function upload_image()
    {
        $config['upload_path'] = './assets/image_logo/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif|web';
        $config['max_size'] = '10000';
        $this->upload->initialize($config);
        $field_name = "logo";

        if (!$this->upload->do_upload($field_name)) {
            return ''; // Return string kosong jika upload gagal
        } else {
            $upload_data = $this->upload->data();
            return $upload_data['file_name']; // Return nama file jika upload berhasil
        }
    }

    public function delete($logoid)
    {
        // Periksa apakah logo dengan $logoid ada dalam database
        $logo = $this->m_logo->get_data($logoid);

        if ($logo) {

            $logo = $this->m_logo->get_data($logoid);

            // Delete the bg file if it exists
            if ($logo->logo != "") {
                unlink('./assets/image_logo/' . $logo->logo);
            }

            // Data for deletion
            $data = array('logoid' => $logoid);
            
            $this->m_logo->delete($logoid);

            // Set pesan flash untuk notifikasi
            $this->session->set_flashdata('swal', 'success');
            $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !!!');
        } else {
            // Jika logo tidak ditemukan, set pesan error
            $this->session->set_flashdata('swal', 'error');
            $this->session->set_flashdata('pesan', 'Data tidak ditemukan atau sudah dihapus !!!');
        }

        // Redirect ke halaman logo setelah berhasil menghapus atau jika data tidak ditemukan
        redirect('logo');
    }

}