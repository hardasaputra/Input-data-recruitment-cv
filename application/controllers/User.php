<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_Document');
        $this->load->model('M_Pendidikan');
        $this->load->model('M_Pekerjaan');
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];  
        $data['pendidikan'] = $this->M_Pendidikan->showPendidikanById($id);
        $data['pekerjaan'] = $this->M_Pekerjaan->showPekerjaanById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }


    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('summary', 'Summary', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $tanggal_lahir = $this->input->post('tanggal_lahir');            
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $summary = $this->input->post('summary');
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']      = '10000';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->set('alamat', $alamat);
            $this->db->set('tanggal_lahir', $tanggal_lahir);
            $this->db->set('jenis_kelamin', $jenis_kelamin);
            $this->db->set('summary', $summary);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user/edit');
        }
    }

    public function document(){
        $data['title'] = 'Upload Document';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];  
        
        $data['document'] = $this->M_Document->showAllDocumentById($id);
        // var_dump($data['document']);
        // die();
        if (isset($_FILES["document"]["name"])) {

            $config['upload_path']          = './assets/document/';
            $config['allowed_types']        = 'pdf';
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;


            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('document')) {
                $this->session->set_flashdata('message', 'failed');
            } else {

                $gbr = $this->upload->data();

                $image = $gbr['file_name'];
            }
            $data = array(
                'nama_file' => $image,
                'user_id' => $id
        );
        $this->db->insert('document', $data);
        
        redirect('user/document');
        }else{


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/document', $data);
            $this->load->view('templates/footer');
        }
    }

    public function pendidikan(){
        $data['title'] = 'Add Pendidikan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];  
        $data['jenjang'] = $this->db->get('jenjang')->result();
        $data['pendidikan'] = $this->M_Pendidikan->showPendidikanById($id);

        $this->form_validation->set_rules('institusi', 'Institusi', 'required|trim');
        $this->form_validation->set_rules('jenjang', 'Jenjang', 'required|trim');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|trim');
        $this->form_validation->set_rules('tahun_keluar', 'Tahun Keluar', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pendidikan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->set('institusi', $this->input->post('institusi'));
            $this->db->set('jenjang_id', $this->input->post('jenjang'));
            $this->db->set('tahun_masuk', $this->input->post('tahun_masuk'));
            $this->db->set('tahun_keluar', $this->input->post('tahun_keluar'));
            $this->db->set('user_id', $id);
                     
            $this->db->insert('pendidikan');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user/pendidikan');
        }
    }

    public function prosesDeletePendidikan($id){
        $this->db->where('id_pendidikan', $id);
        $this->db->delete('pendidikan');
        redirect('user/pendidikan');
    }

    public function pekerjaan(){
        $data['title'] = 'Add Pekerjaan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $id = $data['user']['id'];  
        $data['pekerjaan'] = $this->M_Pekerjaan->showPekerjaanById($id);

        $this->form_validation->set_rules('nama_kantor', 'Nama_Kantor', 'required|trim');
        $this->form_validation->set_rules('tahun_masuk', 'Tahun Masuk', 'required|trim');
        $this->form_validation->set_rules('tahun_keluar', 'Tahun Keluar', 'required|trim');
        $this->form_validation->set_rules('posisi', 'Posisi', 'required|trim');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');        
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim');
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/pekerjaan', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->set('nama_kantor', $this->input->post('nama_kantor'));
            $this->db->set('tahun_masuk', $this->input->post('tahun_masuk'));
            $this->db->set('tahun_keluar', $this->input->post('tahun_keluar'));
            $this->db->set('posisi', $this->input->post('posisi'));
            $this->db->set('lokasi', $this->input->post('lokasi'));
            $this->db->set('deskripsi', $this->input->post('deskripsi'));
            $this->db->set('user_id', $id);
                     
            $this->db->insert('pengalaman');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user/pekerjaan');
        }
    }

    public function prosesDeletePekerjaan($id){
        $this->db->where('id_pengalaman', $id);
        $this->db->delete('pengalaman');
        redirect('user/pekerjaan');
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
