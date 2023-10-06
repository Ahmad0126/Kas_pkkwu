<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
	
	public function index() {
		$this->db->select('*')->from('transaksi');
		$this->db->order_by('tanggal', 'ASC');
		$transaksi = $this->db->get()->result_array();
		$data	= array('transaksi' => $transaksi);
		$this->template->load('layout/template', 'transaksi', 'Judul',$data);	
	}

	public function tambah() {
		$this->template->load('layout/template', 'transaksi_tambah');
	}

	public function simpan() {
		$data = array(
			'keterangan'		=> $this->input->post('keterangan'),
			'nominal'			=> $this->input->post('nominal'),
			'tanggal'			=> $this->input->post('tanggal'),
			'username'			=> $this->session->userdata('username'),
			'jenis_transaksi'	=> $this->input->post('jenis_transaksi')
		);
		$this->db->insert('transaksi', $data);
		redirect('transaksi');
	}

	public function hapus($id){
		$where = array('id_transaksi' => $id);
		$this->db->delete('transaksi', $where);
		$this->session->set_flashdata('alert', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>Berhasil Dihapus.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    	');
    return redirect('transaksi');
	}
}
