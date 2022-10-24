<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function tampilUser()
    {
      return $this->db->get('user')->result(); 
    }

    public function tambahUser(){
		  $dataUser=[
            'username'=>$this->input->post('username', true),
            'password'=>md5($this->input->post('password', true)),
            'level'=>$this->input->post('level', true),
      ];
      $this->db->insert('user', $dataUser);
    }
    
    public function getUser(){
      $this->db->select('id_user, username, password, level');
      $this->db->from('user');
      $this->db->where('username', $this->input->post('username'));
      $this->db->where('password', md5($this->input->post('password')));
      $this->db->limit(1);

      $query=$this->db->get();
      if ($query->num_rows()==1) {
        return $query->result();
      }
      else{
        return false;
      }
    }

    public function editUser($id_user){
      $dataUser=[
        'username'=>$this->input->post('username', true),
        'level'=>$this->input->post('level', true),
      ];
      $this->db->where('id_user', $id_user);
      $this->db->update('user', $dataUser);
    }

    public function resetPassword($id_user){
      $dataUser=[
        'password'=>md5($this->input->post('password', true)),
      ];
      $this->db->where('id_user', $id_user);
      $this->db->update('user', $dataUser);
    }
    
    public function hapusUser($id_user)
	  {
  		$this->db->where('id_user', $id_user);
  		$this->db->delete('user');
    }

    public function cekUsername(){
      $this->db->select('id_user, username, password, level');
      $this->db->from('user');
      $this->db->where('username', $this->input->post('username'));
      $this->db->limit(1);

      $query=$this->db->get();
      if ($query->num_rows()==1) {
        return true;
      }
      else{
        return false;
      }
    }    
}

