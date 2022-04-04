<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_model
{
    public function selectAwalGabung()
    {
		return $this->db->limit(3)->get('karyawan')->result(); // Tampilkan limit data dari 1 - 3
    }

    public function createCode(){
      $this->db->select('RIGHT(karyawan.no_induk,3) as no_induk', FALSE);
      $this->db->order_by('no_induk','DESC');    
      $this->db->limit(1);    
      $query = $this->db->get('karyawan');
        if($query->num_rows() <> 0){      
          $data = $query->row();
          $kode = intval($data->no_induk) + 1; 
        }
        else{      
          $kode = 1;  
        }
      $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
      $noInduk = "IP06".$batas;
      return $noInduk;  
	}

}
