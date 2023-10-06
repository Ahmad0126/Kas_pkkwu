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
    public function get_laporan_pp($select){
        $where = array();
        $like = array();
        $data = array();
        $tanggal = '';
        $saldobefore = '';
        $user = 'semua user';
        $t1 = '';
        $t2 = '';
        $u1 = '';
        //message tanggal
        if($this->input->post('tanggal1') != null && $this->input->post('tanggal2') != null){
            $where += array(
                'tanggal >=' => $this->input->post('tanggal1'),
                'tanggal <=' => $this->input->post('tanggal2')
            );
            $tanggal = 'Dari tanggal '.$this->input->post('tanggal1').' sampai '.$this->input->post('tanggal2');
            $t1 = $this->input->post('tanggal1');
            $t2 = $this->input->post('tanggal2');
            $saldobefore = $this->saldo_awal($t1);
        }
        //message user
        if($this->input->post('user') != 'semua'){
            $this->db->like('username', $this->input->post('user'));
            $user = 'user '.$this->input->post('user');
            $u1 = $this->input->post('user');
        }
        //data berdasarkan select
        if($select == 'pm'){
            $where += array('jenis_transaksi' => 'pemasukan');
            $data = array(
                'title' => 'Laporan Pemasukan '.$user,
                'jenis' => 'masuk'
            );
        }else if($select == 'pn'){
            $where += array('jenis_transaksi' => 'pengeluaran');
            $data = array(
                'title' => 'Laporan Pengeluaran '.$user,
                'jenis' => 'keluar'
            );
        }else if($select == 'pp'){
            if($this->input->post('user') != 'semua'){
                $where += array('username' => $u1);
            }
            $subtt = '';
            if($t1 != ''){
                $subtt = 'Saldo sebelum tanggal '.$t1;
            }
            $data = array(
                'title' => 'Laporan Pemasukan dan Pengeluaran '.$user,
                'jenis' => 'pp',
                'before' => $saldobefore,
                'subsubtitle' => $subtt
            );
        }
        $this->db->where($where);
        $this->db->order_by('tanggal', 'ASC');
        $data += array('duit' => $this->db->get('transaksi')->result_array(), 'subtitle' => $tanggal);
        // var_dump($data); die;
        return $data;
    }
}