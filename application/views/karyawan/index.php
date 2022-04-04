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
                        <form action="#" id="form"> <!-- Form Input Karyawan -->
                            <div class="row">
                                <div class="form-group col-md-12 mb-5 text-center">
                                    <input type="hidden" value="" name="id" />
                                    <h5 class="form-title">Modal title</h5>
                                </div>
                                <div class="form-group col-md-12 mb-3 text-center" id="photo-preview">
                                    <label class="control-label">Photo</label>
                                    (No photo)
                                </div>
                                <div class="form-group col-md-12 mb-3 text-center">
                                     <div class="removefoto"></div>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                     <label>Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-2 no-induk">
                                    <label>No Induk</label>
                                    <input type="text" class="form-control" placeholder="ex. IP06001" name="no_induk" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6 mb-2 foto-input">
                                     <label>Foto</label>
                                    <input name="photo" type="file" id="fileSelect" class="form-control">
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control"></textarea>
                                </div>
                                <div class="form-group col-md-6 mb-2">
                                    <label>Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker" placeholder="Tanggal Lahir" name="tgl_lahir" autocomplete="off">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group col-md-6 mb-2" >
                                     <label>Tanggal bergabung</label>
                                    <input type="text" class="form-control datepicker" placeholder="Tanggal Bergabung" name="tgl_bergabung" autocomplete="off">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group col-md-12 mr-3">
                                    <button data-name="kembali" class="btn-act btn btn-warning">Kembali</button>
                                    <button type="submit" class="submitBtn btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form> <!-- End Form Input Karyawan -->
                    </div>
                </div>
                <div class="card bg-body" style="font-size: 14px;">
                    <div class="tableShow">  <!-- Data karyawan -->
                        <div class="card-body">
                            <div class="text-center">
                                <img src="<?= base_url('assets/img/mceasy.png') ?>" width="100px" />
                                    <h4 class="text-center">PT. Otto Menara Globalindo </h4>
                            </div>
                            <div class="card shadow animated fadeIn p-2 ">
                                <div class="float-left mb-3">
                                    <button data-name="tambah" class="float-left btn btn-act btn-outline-success btn-sm"><i class="fa fa-plus"></i> Tambah</button> <!-- Kirim data-name -->
                                    <div class="float-right">
                                        <h6 class="text-right m-2 font-weight-bold">Data Karyawan <i class="fa fa-align-left"></i></h6>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="mydata" class="display dataTable table table-striped table-hover" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width:30px"></th>
                                                <th style="width:150px">NO INDUK</th>
                                                <th style="width:170px">NAMA</th>
                                                <th>ALAMAT</th>
                                                <th style="width:30px"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tampil-karyawan"></tbody>  <!-- Tampilkan data dari method tampilKaryawan() - di file (views/karyawan/index.js) -->
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>  <!-- End Data karyawan -->
                </div>
            </div>
    </div>
</div>
</body>

</html>

<script src="<?= base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('application/views/karyawan/index.js') ?>"></script>
<script src="<?= base_url('assets/js/style.js') ?>"></script>