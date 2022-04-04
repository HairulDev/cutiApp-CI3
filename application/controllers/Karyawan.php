<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Universal_model', 'universal');
		$this->load->model('Karyawan_model', 'karyawan');
	}

	public function index()
	{
		$this->load->view('templates/header');
		$this->load->view('karyawan/index');
		$this->load->view('templates/footer');
	}

	public function v1($action = '')
	{
		switch ($action) {
			case 'tampil_karyawan':
				$data = $this->universal->selectAll('karyawan'); // eksekusi method selectAll - di (models/Universal_model) untuk memanggil seluruh data karyawan
				$response = $data;
				break; // hentikan eksekusi

			case 'awal_gabung':
				$data = $this->karyawan->selectAwalGabung(); // eksekusi method selectAwalGabung - di (models/Karyawan_model) untuk memanggil data yang 3 pertama kali bergabung
				$response = $data;
				break; // hentikan eksekusi // hentikan eksekusi

			case 'simpan':
				$noInduk = $this->karyawan->createCode(); // Generate nomor induk
				$data = [ // deklarasikan properties
					'no_induk' => $noInduk,
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'tgl_bergabung' => $this->input->post('tgl_bergabung'),
				];
				if (!empty($_FILES['photo']['name'])) { // Jika file ada ...
					$upload = $this->_do_upload(); // maka eksekusi method _do_upload()
					$data['photo'] = $upload;
				}
				$this->universal->save('karyawan', $data);  // setelah itu simpan data setelah di deklarasikan pada method save() - di file (models/Universal_model)
				$response   = ['code' => 201, "message" => "Simpan Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client$response   = ['code' => 201, "message" => "Simpan Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
			
				break; // hentikan eksekusi

			case 'ubah':
				$data = [ // deklarasikan properties
					'no_induk' => $this->input->post('no_induk'),
					'nama' => $this->input->post('nama'),
					'alamat' => $this->input->post('alamat'),
					'tgl_lahir' => $this->input->post('tgl_lahir'),
					'tgl_bergabung' => $this->input->post('tgl_bergabung'),
				];
				if ($this->input->post('remove_photo')) // jika remove photo di cek
				{
					if (file_exists('upload/' . $this->input->post('remove_photo')) && $this->input->post('remove_photo')) // Jika file foto ada maka lakukan perintah hapus file
						unlink('upload/' . $this->input->post('remove_photo'));
					$data['photo'] = '';
				}
				if (!empty($_FILES['photo']['name'])) { // Jika file ada ...
					$upload = $this->_do_upload(); // maka eksekusi method _do_upload() untuk mengupload file
					$person = $this->universal->getById('karyawan', $this->input->post('id')); // Ambil data karyawan sesuai id yang dikirim
					if (file_exists('upload/' . $person->photo) && $person->photo) // jika file sudah ada maka lakukan hapus file foto sesuai id
						unlink('upload/' . $person->photo);
					$data['photo'] = $upload;
				}
				$this->universal->update('karyawan', $data, $this->input->post('id'));   // lakukan updating data karyawan sesuai id - di method update() pada file (models/universal_model)
				$response   = ['code' => 201, "message" => "Ubah Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
				break; // hentikan eksekusi

				case 'hapus':
					$id = $this->input->post('id'); // Ambil data id yang dikirim dari url
					$person = $this->universal->getById('karyawan', $id);  // eksekusi method getById - di (models/Universal_model) untuk memanggil data sesuai id yang di kirim
					if (file_exists('upload/' . $person->photo) && $person->photo) // jika file foto ada maka lakukan perintah hapus file
						unlink('upload/' . $person->photo);
					$data = $this->universal->delete('karyawan', $id);  // eksekusi method delete - di (models/universal_model) untuk menghapus data sesuai id yang dikirim
					// echo json_encode($data);
					$response   = ['code' => 201, "message" => "Hapus Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
					break; // hentikan eksekusi

				case 'get':
					$id = $this->input->get('id'); // Ambil data id yang dikirim dari url
					$data = $this->universal->getById('karyawan', $id); // eksekusi method getById - di (models/Universal_model) untuk memanggil data karyawan sesuai id
					$response   = ['code' => 201, "message" => "Hapus Berhasil", "status" => TRUE]; // Kirimkan kode, message, status respon ke client
					break; // hentikan eksekusi
		}
		$response = json_encode($response);
		$this->output->set_content_type('application/json')->set_output($response);
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/'; // upload file ke folder root/upload
		$config['allowed_types']        = 'gif|jpg|png|svg';
		$config['max_width']            = 1000;
		$config['max_height']           = 1000;
		$config['file_name']            = round(microtime(true) * 1000);
		$this->load->library('upload', $config);
		$this->upload->do_upload('photo');
		$upload_data = $this->upload->data();
		$new_file_name = $upload_data['file_name'];
		$profile_picture = $new_file_name;
		return $profile_picture;
	}

	public function get($id)
	{
		$data = $this->universal->getById('karyawan', $id); // eksekusi method getById - di (models/Universal_model) untuk memanggil data karyawan sesuai id
		$data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

}
