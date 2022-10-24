<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

    public function tampilMenu()
    {
       return $this->db->get('menu')->result();
    }

    public function tampilTerbaru()
    {
        $query = $this->db->query("SELECT * FROM menu ORDER BY kd_menu DESC LIMIT 6");
        return $query->result();
    }

    public function tampilFood()
    {
        $query = $this->db->query("SELECT * FROM menu WHERE type = 'makanan'");
        return $query->result();
    }

    public function tampilBeverages()
    {
        $query = $this->db->query("SELECT * FROM menu WHERE type = 'minuman'");
        return $query->result();
    }

    public function tampilSnack()
    {
        $query = $this->db->query("SELECT * FROM menu WHERE type = 'snack'");
        return $query->result();
    }

    public function tambahMenu($kd_menu, $img){
        $this->load->library('upload');
        $dataMenu=[
              'kd_menu'=>$kd_menu,
              'nama_menu'=>$this->input->post('nama_menu', true),
              'type'=>$this->input->post('type', true),
              'harga_satuan'=> $this->input->post('harga_satuan', true),
              'stok'=>$this->input->post('stok', true),
              'img'=>$img,
        ];
        $this->db->insert('menu', $dataMenu); 
    }

    public function editMenu($kd_menu, $img){
        $dataMenu=[
              'harga_satuan'=> $this->input->post('harga_satuan', true),
              'stok'=>$this->input->post('stok', true),
              'img'=>$img,
        ];
        $this->db->where('kd_menu', $kd_menu);
        $this->db->update('menu', $dataMenu);
    }
    
    public function hapusMenu($kd_menu)
    {
		$this->db->where('kd_menu', $kd_menu);
		$this->db->delete('menu');
    }

    public function cariMenu(){
	    $keyword=$this->input->post('keyword');
	    $this->db->like('nama_menu', $keyword);
        $this->db->or_like('type', $keyword);
        $this->db->or_like('harga_satuan', $keyword);
	    return $this->db->get('menu')->result_array();
	}

    public function cekKodeMenu()
    {
        $query = $this->db->query("SELECT MAX(kd_menu) as kodemenu from menu");
        $hasil = $query->row();
        return $hasil->kodemenu;
    }

    public function getMenuToCart($kd_menu){
        $query = $this->db->query("SELECT * from menu where kd_menu='$kd_menu'");
        $hasil = $query->row();
        $cart = array(
            'id'      => $hasil->kd_menu,
            'qty'     => 1,
            'price'   => $hasil->harga_satuan,
            'name'    => $hasil->nama_menu,
            'stok'    => $hasil->stok, 
            'catatan' => '' 
        );
        $this->cart->insert($cart);
    }

    public function cekStok($kd_menu)
    {
        $query = $this->db->query("SELECT stok from menu where kd_menu= '$kd_menu'");
        $hasil = $query->row();
        return $hasil->stok;
    }

    public function cekImg($kd_menu)
    {
        $query = $this->db->query("SELECT img from menu where kd_menu= '$kd_menu'");
        $hasil = $query->row();
        return $hasil->img;
    }

    public function updateStok($kd_menu, $stok){
        $dataMenu=[
              'stok'=>$stok,
        ];
        $this->db->where('kd_menu', $kd_menu);
        $this->db->update('menu', $dataMenu);
    }    
}

