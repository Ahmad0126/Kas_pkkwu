<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('transaksi_model');
		$this->load->model('User_model');
    	if($this->session->userdata('id') == null){ redirect(base_url('auth')); }
	}
	public function index(){
		$data['user'] = $this->User_model->get_user();
		$this->template->load('layout/template', 'dashboard', 'Dashboard', $data);
	}
	public function laporan(){
        $this->load->model('transaksi_model');
        $select = $this->input->post('pp');
        $data = $this->transaksi_model->get_laporan_pp($select);
        if($data['jenis'] != 'pp'){
            $this->buat_pmn($data);
        }else{
            $this->buat_pp_all($data);
        }
    }
    private function buat_pmn(array $data){
        $this->load->library('fpdf');
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 16);
        $this->fpdf->Cell(190, 7, $data['title'], 0, 1, 'C');
        if($data['subtitle'] != ''){
            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->Cell(190, 7, $data['subtitle'], 0, 1, 'C');
        }
        $this->fpdf->Cell(190, 7, '', 0, 1);
        //title <th>
        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(7, 6, 'No', 1, 0);
        $this->fpdf->Cell(25, 6, 'Tanggal', 1, 0);
        $this->fpdf->Cell(85, 6, 'Keterangan', 1, 0);
        $this->fpdf->Cell(30, 6, 'Username', 1, 0);
        $this->fpdf->Cell(35, 6, 'Nominal', 1, 1);

        $this->fpdf->SetFont('Arial', '', 10);
        $no = 1;
        $total = 0;
        foreach($data['duit'] as $fer){
            $this->fpdf->Cell(7, 6, $no++ , 1, 0);
            $this->fpdf->Cell(25, 6, $fer['tanggal'], 1, 0);
            $this->fpdf->Cell(85, 6, $fer['keterangan'], 1, 0);
            $this->fpdf->Cell(30, 6, $fer['username'], 1, 0);
            $this->fpdf->Cell(35, 6, 'Rp '.number_format($fer['nominal']), 1, 1);
            $total += $fer['nominal'];
        }

        $this->fpdf->SetFont('Arial', 'B', 10);
        $this->fpdf->Cell(147, 6, 'Total Keseluruhan', 1, 0);
        $this->fpdf->Cell(35, 6, 'Rp '.number_format($total), 1, 1);

        $this->fpdf->Output();
    }
    private function buat_pp_all($data){
        $this->load->library('fpdf');
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', 'B', 16);
        $this->fpdf->Cell(190, 7, $data['title'], 0, 1, 'C');
        if($data['subtitle'] != ''){
            $this->fpdf->SetFont('Arial', 'B', 12);
            $this->fpdf->Cell(190, 7, $data['subtitle'], 0, 1, 'C');
        }
        $this->fpdf->Cell(190, 7, '', 0, 1);
        //title <th>
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->Cell(6, 6, 'No', 1, 0);
        $this->fpdf->Cell(20, 6, 'Tanggal', 1, 0);
        $this->fpdf->Cell(70, 6, 'Keterangan', 1, 0);
        $this->fpdf->Cell(20, 6, 'Username', 1, 0);
        $this->fpdf->Cell(25, 6, 'Pemasukan', 1, 0);
        $this->fpdf->Cell(25, 6, 'Pengeluaran', 1, 0);
        $this->fpdf->Cell(25, 6, 'Saldo', 1, 1);

        if($data['subsubtitle'] != ''){
            $this->fpdf->Cell(166, 6, $data['subsubtitle'], 1, 0);
            $this->fpdf->Cell(25, 6, 'Rp '.number_format($data['before']), 1, 1);
        }

        $this->fpdf->SetFont('Arial', '', 9);
        $no = 1;
        $saldo = 0;
		$masuk = 0;
		$keluar = 0;
		foreach($data['duit'] as $fer){
			$this->fpdf->Cell(6, 6, $no++ , 1, 0);
			$this->fpdf->Cell(20, 6, $fer['tanggal'], 1, 0);
			$this->fpdf->Cell(70, 6, $fer['keterangan'], 1, 0);
			$this->fpdf->Cell(20, 6, $fer['username'], 1, 0);
			if($fer['jenis_transaksi'] == 'pemasukan'){
				$this->fpdf->Cell(25, 6, 'Rp '.number_format($fer['nominal']), 1, 0); 
				$saldo += intval($fer['nominal']);  
				$masuk += intval($fer['nominal']);
			}else{ $this->fpdf->Cell(25, 6, 'Rp -', 1, 0); }
			if($fer['jenis_transaksi'] == 'pengeluaran'){
				$this->fpdf->Cell(25, 6, 'Rp '.number_format($fer['nominal']), 1, 0); 
				$saldo -= intval($fer['nominal']);
				$keluar += intval($fer['nominal']);
			}else{ $this->fpdf->Cell(25, 6, 'Rp -', 1, 0); }
			$this->fpdf->Cell(25, 6, 'Rp '.number_format($saldo), 1, 1);
		}
		$this->fpdf->SetFont('Arial', 'B', 9);
		$this->fpdf->Cell(116, 6, 'Total Keseluruhan', 1, 0);
		$this->fpdf->Cell(25, 6, 'Rp '.number_format($masuk), 1, 0);
		$this->fpdf->Cell(25, 6, 'Rp '.number_format($keluar), 1, 0);
		$this->fpdf->Cell(25, 6, 'Rp '.number_format($saldo), 1, 1);

        $this->fpdf->Output();
    }
    public function profil(){
        $data['user'] = $this->User_model->getwu_user($this->session->userdata('username'));
		$this->template->load('layout/template', 'profil', 'Profil Anda', $data);
    }
    public function edit($what){
        if($what == 'password'){
            $pass = $this->input->post('password');
            $pl = $this->input->post('pl');
            $pk = $this->input->post('pk');
            $cek = $this->User_model->getwu_user($this->session->userdata('username'));
            if($cek){
                if(md5($pl) == $cek['password']){
                    if($pass == $pk){
                        $this->db->update('user', array('password' => md5($pass)), array('id_user' => $this->session->userdata('id')));
                        $this->session->set_flashdata('alert', $this->template->notif('Password berhasil diubah!', 'success'));
                        redirect(base_url('home/profil'));
                    }else{
                        $this->session->set_flashdata('pl_val', $pl);
                        $this->session->set_flashdata('pp_val', $pass);
                        $this->session->set_flashdata('pk_val', $pk);
                        $this->session->set_flashdata('konf', 'Password Tidak Sama!');
                        $this->session->set_flashdata('alert', $this->template->notif('Konfirmasi Password Baru Kembali!', 'danger'));
                        redirect(base_url('home/profil'));
                    }
                }else{
                    $this->session->set_flashdata('pl_val', $pl);
                    $this->session->set_flashdata('pp_val', $pass);
                    $this->session->set_flashdata('pk_val', $pk);
                    $this->session->set_flashdata('password', 'Password Salah!');
                    $this->session->set_flashdata('alert', $this->template->notif('Password Lama Salah!', 'danger'));
                    redirect(base_url('home/profil'));
                }
            }
        }else{
            $data = array($what => $this->input->post('nama'));
            $this->db->update('user', $data, array('id_user' => $this->session->userdata('id')));
            $this->session->set_flashdata('alert', $this->template->notif('Nama berhasil diubah!', 'success'));
            $this->session->set_userdata('nama', $this->input->post('nama'));
            redirect(base_url('home/profil'));
        }
    }
}
