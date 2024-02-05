<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Foto extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_foto');
        $this->load->model('m_album');
    }

    public function index()
    {
        $data = array(
            'title' => 'Foto',
            'album' => $this->m_album->get_all_data(),
            'foto' => $this->m_foto->get_all_data(),
            'isi' => 'foto/v_foto',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    // Add a new item
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
                redirect('foto');
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
                redirect('foto');
            }
        }

        // If form validation fails or when initially loading the page
        $data = array(
            'title' => 'Foto Add',
            'header' => 'Foto',
            'album' => $this->m_album->get_all_data(),
            'isi' => 'foto/v_add',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
    }

    // Update one item
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
            redirect('foto');

        }
        $data = array(
            'title' => 'Edit foto',
            'header' => 'Blog',
            'foto' => $this->m_foto->get_data($fotoid),
            'album' => $this->m_album->get_all_data(),
            'isi' => 'foto/v_edit',
        );
        $this->load->view('layout/v_wrapper_backend', $data, false);
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

    // Delete one item
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
        redirect('foto');
    }

}
