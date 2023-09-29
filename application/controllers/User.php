<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
    public function __construct(){
		parent::__construct();
        if($this->session->userdata('level') <> 'Admin'){ redirect(base_url()); }
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
            <div class="alert alert-danger" role="alert">Username Sudah Ada</div>
            ');
            redirect('user');
        }
        $this->User_model->simpan(); 
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
