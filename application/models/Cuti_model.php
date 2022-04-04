<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cuti_model extends CI_model
{
    public function pernahCuti()
    {
        $data = $this->db->query("
            SELECT k.nama, k.no_induk, c.*
            FROM karyawan k
            JOIN cuti c
            ON c.no_induk = k.no_induk
        ");
        return $data->result();
    }

    public function cutiLebihSatu()
    {
        $data = $this->db->query("
            SELECT k.nama, k.no_induk, c.*
            FROM karyawan k
            JOIN cuti c
            ON c.no_induk = k.no_induk
            GROUP BY c.no_induk HAVING COUNT(*) > 1;
        ");
        return $data->result();
    }

    public function sisaCuti()
    {
        $data = $this->db->query("
            SELECT *,
            SUM(lama_cuti) as lama_cuti
            FROM cuti
            RIGHT OUTER JOIN karyawan
            ON cuti.no_induk = karyawan.no_induk
            GROUP BY karyawan.no_induk ;
        ");
        return $data->result();
    }

}
