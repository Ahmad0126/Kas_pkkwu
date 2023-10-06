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
}
