<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
		parent::__construct();
        if($this->session->userdata('level') <> 'Admin'){ redirect(base_url()); }
        $this->load->model('User_model');
	}
    
	public function index(){
        $data['user'] = $this->User_model->get_user();
		$this->template->load('layout/template', 'user_index', 'Dashboard', $data);
	}
    
    public function simpan(){
        $namafoto = date('YmdHis').'.jpg';
        $config['upload_path']  = 'assets/upload/profil/';
        $config['max_size']  = 500 * 1024;
        $config['file_name']  = $namafoto;
        $config['allowed_types']  = '*';
        $this->load->library('upload', $config);
        if($_FILES['foto']['size'] >= 500 * 1024){
            $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Ukuran foto terlalu Besar, Upload ulang foto dengan ukuran yang kurang dari 500 KB.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('user');
        } elseif (!$this->upload->do_upload('foto')) {
            $error = array('error' => $this->upload->display_errors());
        }else {
            $data = array('upload_file' => $this->upload->data());
        }

        $this->db->from('user');
        $this->db->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert', '
            <div class="alert alert-danger" role="alert">Username Sudah Ada</div>
            ');
            redirect('user');
        }
        $this->User_model->simpan($namafoto); 
        $this->session->set_flashdata('alert', '
        <div class="alert alert-success" role="alert">Berhasil Di Simpan</div>
        ');
        redirect('user');
    }

    public function delete_data($id){
        $where = array(
            'id_user'   => $id
        );
        $this->db->delete('user' ,$where);
        $this->session->set_flashdata('alert','
        <div class="alert alert-success" role="alert">Berhasil Menghapus User</div>
        ');
        redirect('user');
    }

    public function update(){
        $this->User_model->update();
        $this->session->set_flashdata('alert','
        <div class="alert alert-success" role="alert">Berhasil Di edit</div>
        ');
        redirect('user');
    }
}
