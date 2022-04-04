<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Universal_model extends CI_Model
{
	// Universal_model berguna untuk reusable model
	
	public function __construct()
	{
		parent::__construct();
	}

	public function selectAll($table) 
	{
		return $this->db->order_by('no_induk', 'ASC')->get($table)->result();
	}

	public function save($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function getById($table, $id)
	{
		return $this->db->get_where($table, ['id' => $id])->row(); // Tampilkan data dengan id yang di pinta / dikirim
	}

	public function update($table, $data, $id)
	{
		$this->db->where(['id' => $id])->update($table, $data); //  Update data berda
	}

	public function delete($table, $id)
	{
		$this->db->delete($table, ['id' => $id]);
	}
}
