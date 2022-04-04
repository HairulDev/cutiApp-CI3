<?php

if(!function_exists('format_indoe')) {
    function format_indo($date) {
        date_default_timezone_set('Asia/Jakarta');
        //array hari dan bulan
        $Hari = array("Minggu","Sennin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $Bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

       //pemisahan tahun, bulan dan hari dan waktu
        $tahun = substr($date,0,4);
        $bulan = substr($date,5,2);
        $tgl = substr($date,8,2);
        $waktu = substr($date,11,5);
        $hari = date("w", strtotime($date));
        $result = $Hari[$hari].", ".$tgl." ".$Bulan[(int)$bulan-1]." ".$tahun." ".$waktu;
        return $result;
    }
}