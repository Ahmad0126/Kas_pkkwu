<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    protected $_table = 'user'; //nama tabel user
	public function simpan(){
        $data = array(
            'nama'       => $this->input->post('nama'),
            'username'   => $this->input->post('username'),
            'password'   => md5($this->input->post('password')),
            'level'      => $this->input->post('level'),
        );
        $this->db->insert($this->_table,$data);
	}
    public function getwu_user($user){
        return $this->db->get_where($this->_table, array('username' => $user))->row_array();
    }
}