<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function index(){
		$this->template->load('layout/template', 'user_index', 'Dashboard');
	}
    public function tambah(){
        $this->template->load('layout/template', 'user_tambah', 'Dashboard');
    }
}
