<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function index(){
		$this->load->view('login', array('title' => 'Login'));
	}
    public function login(){
        $this->load->model('User_model');
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
		$cek = $this->User_model->getwu_user($user);
        if($cek){
            if(md5($pass) == $cek['password']){
                $this->session->set_userdata('level', $cek['level']);
                $this->session->set_userdata('id', $cek['id_user']);
                $this->session->set_userdata('nama', $cek['nama']);
                $this->session->set_userdata('username', $cek['username']);
                redirect(base_url('home'));
            }else{
                $this->session->set_flashdata('alert', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i> Password Salah!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ');
                redirect(base_url('auth'));
            }
        }else{
            $this->session->set_flashdata('alert', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i> Username tidak ada!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ');
            redirect(base_url('auth'));
        }
    }
    public function logout(){
        $user = array('level', 'id', 'nama', 'username');
        $this->session->unset_userdata($user);
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}
