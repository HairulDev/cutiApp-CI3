<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Universal_model', 'universal');
		$this->load->model('Cuti_model', 'cuti');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('cuti/index');
		$this->load->view('templates/footer');
	}


	public function v1($action = '')
	{
		switch ($action) {
				case 'pernah_cuti':
					$data = $this->cuti->pernahCuti(); // eksekusi method pernahCuti - di (models/Cuti_model) untuk menampilkan data karyawan yg pernah cuti
					$isi = 0;
					foreach ($data as $p) {  // setelah itu looping data dari result method pernahCuti
						$data[$isi]->tgl_cuti = format_indo($p->tgl_cuti);
						$isi++;
					}
					$response = $data;
					break; // hentikan eksekusi

				case 'cuti_lebih_satu':
					$data = $this->cuti->cutiLebihSatu(); // eksekusi method cutiLebihSatu - di (models/Cuti_model) untuk menampilkan data karyawan cuti lebih dari satu
					$isi = 0;
					foreach ($data as $p) {  // setelah itu looping data dari result method cutiLebihSatu
						$data[$isi]->tgl_cuti = format_indo($p->tgl_cuti);
						$isi++;
					}
					$response = $data;
					break; // hentikan eksekusi

				case 'sisa_cuti':
					$data = $this->cuti->sisaCuti(); // eksekusi method sisaCuti - di (models/Cuti_model) untuk menampilkan sisa cuti karyawan
					$isi = 0;
					foreach ($data as $p) {  // setelah itu looping data dari result method sisaCuti
						$data[$isi]->lama_cuti = (12 - $p->lama_cuti);
						$isi++;
					}
					$response = $data;
					break; // hentikan eksekusi

				case 'ajukan_cuti':
					$data = [ // deklarasikan properties data
						'no_induk' => $this->input->post('no_induk'),
						'tgl_cuti' => $this->input->post('tgl_cuti'),
						'lama_cuti' => $this->input->post('lama_cuti'),
						'keterangan' => $this->input->post('keterangan'),
					];
					$this->universal->save('cuti', $data); // Simpan deklarasikan data ke method save() - di file(models/Universal_model)
					$response   = ['code' => 201, "message" => "Cuti Berhasil di ajukan", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
					break; // hentikan eksekusi

				case 'hapus':
					$id = $this->input->post('id'); // Ambil data id yang dikirim dari url
					$this->universal->delete('cuti', $id);  // eksekusi method delete - di (models/universal_model) untuk menghapus data sesuai id yang dikirim
					$response   = ['code' => 201, "message" => "Hapus Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
					break; // hentikan eksekusi
		}
		$response = json_encode($response); // tampilkan result dalam bentuk JSON
		$this->output->set_content_type('application/json')->set_output($response); 
	}

	public function get($id)
	{
		$data = $this->universal->getById('karyawan', $id); // eksekusi method getById - di (models/Universal_model) untuk memanggil data karyawan berdasarkan id yang dikirim
		$data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data); // tampilkan result dalam bentuk JSON
	}

}
