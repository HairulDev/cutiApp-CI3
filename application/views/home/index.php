<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuti App</title>
</head>

<body>
    <div class="container mt-5">
    <div class="card bg-body border-white" style="font-size: 14px;">
        <div class="text-center mt-4">
            <img src="<?= base_url('assets/img/mceasy.png') ?>" width="100px" />
                <h4 class="text-center">PT. Otto Menara Globalindo </h4>
        </div>
        <div class="row">
            <div class="col-lg-6 text-center">
                <div class="card-body animated swing"> <!-- Karyawan Baru Bergabung -->
                    <div class="card shadow p-2 ">
                        <div class="row mb-2">
                            <div class="col-md-8 text-left">
                                <h6 class="font-weight-bold text-primary"> <i class="fa fa-spinner fa-spin"></i> Karyawan Pertama Bergabung</h6>
                            </div>
                            <div class="col-md-4 text-right">
                                <h6 class="ext-muted "><a href="<?= base_url('/karyawan'); ?>">Lihat semua <i class="fa fa-arrow-circle-right"></i></a></h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                    </tr>
                                </thead>
                                <tbody id="awal-gabung"></tbody> <!-- Tampilkan data dari method awalGabung() - di file (views/home/index.js) -->
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body animated fadeInUp delay-1s"> <!-- Karyawan Pernah Cuti -->
                    <div class="card shadow p-2 "> 
                        <div class="row mb-2">
                            <div class="col-md-8 text-left">
                                <h6 class="font-weight-bold text-primary"> <i class="fa fa-spinner fa-spin"></i> Karyawan Pernah Cuti</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width:5px"></th>
                                        <th style="width:70px">No Induk</th>
                                        <th>Nama</th>
                                        <th>Tanggal Cuti</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="pernah-cuti"></tbody> <!-- Tampilkan data dari method pernahCuti() - di file (views/home/index.js) -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="card-body animated fadeInRightBig delay-1s">   <!-- Karyawan Cuti Lebih dari 1 -->
                    <div class="card shadow p-2 ">
                        <div class="row mb-2">
                            <div class="col-md-8 text-left">
                                <h6 class="font-weight-bold text-primary"> <i class="fa fa-spinner fa-spin"></i> Karyawan Cuti Lebih Dari Satu</h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Tanggal Cuti</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody id="cuti-lebih-satu"></tbody> <!-- Tampilkan data dari method cutiLebihSatu() - di file (views/home/index.js) -->
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-body animated flipInY delay-2s">
                    <div class="card shadow p-2 ">  <!-- Sisa Cuti Karyawan -->
                        <div class="row mb-2">
                            <div class="col-md-8 text-left">
                                <h6 class="font-weight-bold text-primary"> <i class="fa fa-spinner fa-spin"></i> Sisa Cuti Karyawan</h6>
                            </div>
                            <div class="col-md-4 text-right">
                                <h6 class="ext-muted "><a href="<?= base_url('/cuti'); ?>">Lihat semua <i class="fa fa-arrow-circle-right"></i></a></h6>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Sisa Cuti</th>
                                    </tr>
                                </thead>
                                <tbody id="sisa-cuti"></tbody> <!-- Tampilkan data dari method sisaCuti() - di file (views/home/index.js) -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('application/views/home/index.js') ?>"></script>
<script src="<?= base_url('assets/js/style.js') ?>"></script>