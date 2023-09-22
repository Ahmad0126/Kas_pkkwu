<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
		parent::__construct();
        $this->load->model('User_model');
	}
    
	public function index(){
        $data['user'] = $this->db->get('user')->result();
		$this->template->load('layout/template', 'user_index', 'Dashboard', $data);
	}
    
    public function simpan(){
        $this->db->from('user');
        $this->db->where('username',$this->input->post('username'));
        $cek = $this->db->get()->result_array();
        if($cek<>NULL){
            $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>Username Sudah Ada.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect('user');
        }
        $this->User_model->simpan(); 
        $this->session->set_flashdata('alert', '
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Berhasil DiTambah.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ');
        redirect('user');
    }
}
