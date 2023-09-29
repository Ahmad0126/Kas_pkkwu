<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('transaksi_model');
	}

	public function index()
	{
		$this->template->load('layout/template', 'dashboard', 'Dashboard');
	}
}
