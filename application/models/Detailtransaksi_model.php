<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Detailtransaksi_model extends CI_Model {

    public function tampilDetail()
    {
       $this->db->select('detail_transaksi.*, menu.*');
       $this->db->join('menu', 'detail_transaksi.kd_menu = menu.kd_menu');
       return $this->db->get('detail_transaksi')->result();
    }

    public function tambahDetail(){
        $content = $this->cart->contents();
        $this->load->model('Transaksi_model');
        $this->load->model('Menu_model');
        $id = $this->Transaksi_model->getIdTransaksi($this->input->post('waktu'));
        foreach ($content as $item) {  
          $stok = $this->Menu_model->cekStok($item['id']);
          $this->Menu_model->updateStok($item['id'], $stok-$item['qty']);
          $dataDetail=[
                'id_transaksi'=> $id,
                'kd_menu'=> $item['id'],
                'quantity'=>$item['qty'],
                'catatan'=>$item['catatan']
          ];
          $this->db->insert('detail_transaksi', $dataDetail); 
        }
    }
    
    public function getDetailByNama($nama_customer){
        $this->db->select('transaksi.*, detail_transaksi.*');
        $this->db->join('transaksi', 'detail_transaksi.id_transaksi = transaksi.id_transaksi');
        return $this->db->get_where('detail_transaksi',['transaksi.nama_customer'=>$nama_customer])->result();
    }

    public function getDetailTransaksi($id_transaksi){
        $this->db->select('detail_transaksi.*');
        return $this->db->get_where('detail_transaksi',['id_transaksi'=>$id_transaksi])->result();
    }

    public function getDetail($id_detail){
        $this->db->select('detail_transaksi.*');
        return $this->db->get_where('detail_transaksi',['id_detail'=>$id_detail])->result();
    }

    public function editDetail($id_detail){
        $dataDetail=[
              'id_transaksi'=>$this->input->post('id_transaksi', true),
              'kd_menu'=>$this->input->post('kd_menu', true),
              'quantity'=>$this->input->post('quantity', true),
              'catatan'=>$this->input->post('catatan', true),
        ];
        $this->db->where('id_detail', $id_detail);
        $this->db->update('detail_transaksi', $dataDetail);
    }
    
    public function hapusDetail($id_detail)
	  {
    		$this->db->where('id_detail', $id_detail);
    		$this->db->delete('detail_transaksi');
    }

    public function getLaporan(){
        date_default_timezone_set('Asia/Jakarta');
        $query = $this->db->query("SELECT menu.kd_menu, menu.nama_menu, SUM(detail_transaksi.quantity) AS quantity, menu.type, menu.harga_satuan FROM transaksi INNER JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi INNER JOIN menu ON detail_transaksi.kd_menu=menu.kd_menu GROUP BY menu.kd_menu");
        return $query->result();
    }

    public function getLaporanHarian(){
        date_default_timezone_set('Asia/Jakarta');
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $query = $this->db->query("SELECT menu.kd_menu, menu.nama_menu, SUM(detail_transaksi.quantity) AS quantity, menu.type, menu.harga_satuan FROM transaksi INNER JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi INNER JOIN menu ON detail_transaksi.kd_menu=menu.kd_menu WHERE DAY(waktu)='$day' AND MONTH(waktu)='$month' AND YEAR(waktu)='$year' GROUP BY menu.kd_menu");
        return $query->result();
    }

    public function getLaporanBulanan(){
        date_default_timezone_set('Asia/Jakarta');
        $month = date('m');
        $year = date('Y');
        $query = $this->db->query("SELECT menu.kd_menu, menu.nama_menu, SUM(detail_transaksi.quantity) AS quantity, menu.type, menu.harga_satuan FROM transaksi INNER JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi INNER JOIN menu ON detail_transaksi.kd_menu=menu.kd_menu WHERE MONTH(waktu)='$month' AND YEAR(waktu)='$year' GROUP BY menu.kd_menu");
        return $query->result();
    }

    public function getLaporanTahunan(){
        date_default_timezone_set('Asia/Jakarta');
        $year = date('Y');
        $query = $this->db->query("SELECT menu.kd_menu, menu.nama_menu, SUM(detail_transaksi.quantity) AS quantity, menu.type, menu.harga_satuan FROM transaksi INNER JOIN detail_transaksi ON transaksi.id_transaksi=detail_transaksi.id_transaksi INNER JOIN menu ON detail_transaksi.kd_menu=menu.kd_menu WHERE YEAR(waktu)='$year' GROUP BY menu.kd_menu");
        return $query->result();
    }

 //    public function cariDetail(){
	// 	    $keyword=$this->input->post('keyword');
	// 	    $this->db->like('nama_customer', $keyword);
 //            $this->db->or_like('no_meja', $keyword);
 //            $this->db->or_like('total_harga', $keyword);
 //            $this->db->or_like('waktu', $keyword);
	// 	    return $this->db->get('transaksi')->result_array();
	// }
}

