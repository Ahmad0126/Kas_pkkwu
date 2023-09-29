<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_model {
	public function saldo_awal($tanggal){
        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi', 'Pemasukan');
        $this->db->where("tanggal <",$tanggal);
        $pemasukan = $this->db->get()->row()->total;

        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi', 'Pengeluaran');
        $this->db->where("tanggal <",$tanggal);
        $pengeluaran = $this->db->get()->row()->total;
        $saldo = intval($pemasukan)-intval($pengeluaran);
        return $saldo;
    }
    public function pemasukan_hari_ini(){
        $tanggal = date('Y-m-d');
        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi','pemasukan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $hasil= $this->db->get()->row()->total;
        if ($hasil===NULL) {
            $hasil = 0;
            return $hasil;
        }else {
            return $hasil;
        }
    }
    public function pemasukan_bulan_ini(){
        $tanggal = date('Y-m');
        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi','pemasukan');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $hasil= $this->db->get()->row()->total;
        if ($hasil==NULL) {
            $hasil = 0;
            return $hasil;
        }else {
            return $hasil;
        }
    }
    public function pengeluaran_hari_ini(){
        $tanggal = date('Y-m-d');
        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi','pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m-%d')",$tanggal);
        $hasil= $this->db->get()->row()->total;
        if ($hasil==NULL) {
            $hasil = 0;
            return $hasil;
        }else {
            return $hasil;
        }
    }
    public function pengeluaran_bulan_ini(){
        $tanggal = date('Y-m');
        $this->db->select('sum(nominal) as total')->from('transaksi');
        $this->db->where('jenis_transaksi','pengeluaran');
        $this->db->where("DATE_FORMAT(tanggal,'%Y-%m')",$tanggal);
        $hasil= $this->db->get()->row()->total;
        if ($hasil==NULL) {
            $hasil = 0;
            return $hasil;
        }else {
            return $hasil;
        }
    }
    public function filterTanggal($tanggal1, $tanggal2){
        $query = $this->db->query("SELECT * FROM transaksi WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2'");
        return $query->result_array();
    }
    public function filterTanggalpengeluaran($tanggal1, $tanggal2){
        $query = $this->db->query("SELECT sum(nominal) as pengeluaran FROM transaksi WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2' AND jenis_transaksi = 'pengeluaran'");
        return $query->row_array();
    }
    public function filterTanggalpemasukan($tanggal1, $tanggal2){
        $query = $this->db->query("SELECT sum(nominal) as pemasukan FROM transaksi WHERE tanggal BETWEEN '$tanggal1' AND '$tanggal2' AND jenis_transaksi = 'pemasukan'");
        return $query->row_array();
    }
}