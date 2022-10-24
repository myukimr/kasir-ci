<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_model extends CI_Model {

    public function tampilTransaksi()
    {
       $this->db->select('transaksi.*, detail_transaksi.*, menu.*');
       $this->db->join('detail_transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi');
       $this->db->join('menu', 'detail_transaksi.kd_menu = menu.kd_menu');
       return $this->db->get('transaksi')->result();
    }

    public function tambahTransaksi(){
        $dataTransaksi=[
              'id_user'=>$this->input->post('id_user', true),
              'nama_customer'=>$this->input->post('customer', true),
              'total_harga'=>$this->input->post('total_harga', true),
              'waktu'=> $this->input->post('waktu', true),
              'no_meja'=>$this->input->post('no_meja', true),
        ];
        $this->db->insert('transaksi', $dataTransaksi); 
    }
    
    public function getTransaksiUser($username){
        $this->db->select('transaksi.*');
        $this->db->join('user', 'transaksi.id_user = user.id_user');
        return $this->db->get_where('transaksi',['user.username'=>$username])->result();
    }

    public function getIdTransaksi($waktu){
        $query = $this->db->query("SELECT id_transaksi from transaksi where waktu= '$waktu'");
        $hasil = $query->row();
        return $hasil->id_transaksi;
    }

    public function getIdTransaksi2($nama){
        $this->db->select('transaksi.id_transaksi');
        return $this->db->get_where('transaksi',['transaksi.nama_customer'=>$nama])->result();
    }

    public function getTransaksi($id_transaksi){
        $this->db->select('transaksi.*');
        return $this->db->get_where('transaksi',['id_transaksi'=>$id_transaksi])->result();
    }

    public function editTransaksi($id_transaksi){
        $dataTransaksi=[
            'id_user'=>$this->input->post('id_user', true),
            'nama_customer'=>$this->input->post('nama_customer', true),
            'total_harga'=>$this->input->post('total_harga', true),
            'waktu'=>$this->input->post('waktu', true),
            'no_meja'=>$this->input->post('no_meja', true),
        ];
        $this->db->where('id_transaksi', $id_transaksi);
        $this->db->update('transaksi', $dataTransaksi);
    }
    
    public function hapusTransaksi($id_transaksi)
	  {
    		$this->db->where('id_transaksi', $id_transaksi);
    		$this->db->delete('transaksi');
    }

    public function getRiwayat(){
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->query("SELECT transaksi.* FROM transaksi");
        return $query->result();
    }

    public function getRiwayatHarian(){
        date_default_timezone_set('Asia/Jakarta');
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $query = $this->db->query("SELECT transaksi.* FROM transaksi WHERE DAY(waktu)='$day' AND MONTH(waktu)='$month' AND YEAR(waktu)='$year'");
        return $query->result();
    }

    public function getRiwayatBulanan(){
        date_default_timezone_set('Asia/Jakarta');
        $month = date('m');
        $year = date('Y');
        $query = $this->db->query("SELECT transaksi.* FROM transaksi WHERE MONTH(waktu)='$month' AND YEAR(waktu)='$year'");
        return $query->result();
    }

    public function getRiwayatTahunan(){
        date_default_timezone_set('Asia/Jakarta');
        $year = date('Y');
        $query = $this->db->query("SELECT transaksi.* FROM transaksi WHERE YEAR(waktu)='$year'");
        return $query->result();
    }

 //    public function cariTransaksi(){
	//     $keyword=$this->input->post('keyword');
	//     $this->db->like('nama_customer', $keyword);
 //        $this->db->or_like('no_meja', $keyword);
 //        $this->db->or_like('total_harga', $keyword);
 //        $this->db->or_like('waktu', $keyword);
	//     return $this->db->get('transaksi')->result_array();
	// }
}

