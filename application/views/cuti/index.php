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
        <div class="row justify-content-center">
            <div id="error-message" class="messages"></div>  <!-- Tampilkan error message -->
            <div id="success-message" class="messages"></div>  <!-- Tampilkan success message -->

            <div class="col-md-10">
                <div class="card bg-body formData d-none">
                    <div class="card-body">
                        <form action="#" id="form">  <!-- Form Input Cuti -->
                            <div class="row">
                                <div class="form-group col-md-12 mb-5 text-center">
                                    <input type="hidden" value="" name="id" />
                                    <h5 class="form-title"></h5>
                                </div>
                                <div class="form-group col-md-12 mb-3 text-center" id="photo-preview">
                                    <label class="control-label">Photo</label>
                                    (No photo)
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group col-md-12 mb-3 text-center font-weight-bold">
                                    <label class="nama"></label> / 
                                    <label class="no-induk"></label>
                                </div>
                                <div class="form-group col-md-6 mb-2 d-none">
                                    <label>No Induk</label>
                                    <input type="text" class="form-control" placeholder="ex. IP06001" name="no_induk" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-2 d-none">
                                     <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label>Tanggal Cuti</label>
                                    <input type="text" class="form-control datepicker" placeholder="Tanggal Cuti" name="tgl_cuti" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-2" >
                                     <label>Lama Cuti</label>
                                    <input type="number" class="form-control" placeholder="ex. 2" name="lama_cuti" autocomplete="off">
                                </div>
                                <div class="form-group col-md-12 mb-2">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-12 mr-3">
                                    <button data-name="kembali" class="btn-act btn btn-warning">Kembali</button>
                                    <button type="submit" class="submitBtn btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>   <!-- End Form Input Cuti -->
                    </div>
                </div>
            </div>

            <div class="col-lg-10 text-center mt-n5">
                <div class="card mt-5 bg-body" style="font-size: 14px;">
                    <div class="tableShow">  <!-- Data Karyawan -->
                        <div class="card-body ">
                            <div class="float-center">
                                <img src="<?= base_url('assets/img/mceasy.png') ?>" width="100px" />
                                    <h4 class="text-center">PT. Otto Menara Globalindo </h4>
                            </div>
                            <div class="card shadow animated fadeIn p-2 ">
                                <div class="float-left">
                                    <div class="float-right">
                                        <h6 class="text-right m-2 font-weight-bold">Cuti Karyawan <i class="fa fa-align-left"></i></h6>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="mydata" class="table table-striped table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:150px">NO INDUK</th>
                                                <th style="width:170px">NAMA</th>
                                                <th>ALAMAT</th>
                                                <th style="width:30px"></th>   
                                            </tr>
                                        </thead>
                                        <tbody id="tampil-cuti"></tbody>  <!-- Tampilkan data dari method tampilKaryawan() - di file (views/cuti/index.js) -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End Data Karyawan -->
                </div>
            </div>

        </div>
    </div>
</body>

</html>

<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('application/views/cuti/index.js') ?>"></script>
<script src="<?= base_url('assets/js/style.js') ?>"></script>