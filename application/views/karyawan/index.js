$(document).ready(function() {
    
    function tampilKaryawan() {
        $.ajax({
            type: 'ajax',
            url: 'http://localhost:8080/cutiApp/karyawan/v1/tampil_karyawan', // Requet url - di file ( controllers/karyawan/function v1()/tampil_karyawan ) untuk memanggil semua data karyawan
            async: false,
            dataType: 'json',
            success: function(data) { // Jika sukses maka tampilkan data dari hasil Request url
                var html = '';
                data.map(e => { 
                    html += `<tr class='text-left'>`;
                    html += `<td><button data-name='hapus' data-id="${e.id}" class='btn btn-act btn-outline-danger btn-sm' title='Hapus'><i class='fa fa-trash'></i> </button></td>`;  // assigned data-name, data-id untuk menentukan type action hapus sesuai id dan btn-act utk menjalan function onClick 
                    html += `<td class='btn-act' data-name='detail' data-id="${e.id}">${e.no_induk}</td>`;   // assigned data-name, data-id untuk menentukan type action detail sesuai id  dan btn-act utk menjalan function onClick 
                    html += `<td>${e.nama}</td>`;
                    html += `<td>${e.alamat}</td>`;
                    html += `<td><button data-name='ubah' data-id="${e.id}" class='btn btn-act btn-outline-info btn-sm' title='Ubah'><i class='fa fa-edit'></i> </a></td>`; // assigned data-name, data-id untuk menentukan type action ubah sesuai id  dan btn-act utk menjalan function onClick 
                    html += `</tr>`;
                });
                $("#tampil-karyawan").html(html);
            }
        });
    }
    tampilKaryawan();
    $('#mydata').dataTable();

    $(document).on("click", ".btn-act", function(e) { // Ketika button class btn-act di klik maka eksekusi perintah di bawah :
        e.preventDefault(); // Matikan fungsi refresh page bawaan browser
        var id = $(this).data('id'); // Masukkan data-id ke variabel id
        var name = $(this).data('name'); // Masukkan data-name ke variabel name

        // MANIPULASI DOM pada file (karyawan/index.php)
        $('#form')[0].reset(); // Reset form kembali - di tag <form action="#" id="form"> 
        $('#form').show(); // Tampilkan <form action="#" id="form">
        $('.formData').addClass("animated fadeIn"); // Tambah animasi - pada Form di <div class="card bg-warnings border-white formData d-none">
        $('.formData').removeClass("d-none"); // Hapus class d-none - di Form agar Form tampil
        $('.submitBtn').removeClass("d-none");
        $('.tableShow').addClass("d-none");
        $('#photo-preview').show();
        $('.removefoto').hide();
        $('.form-group').removeClass('has-error');
        $('.foto-input').removeClass("d-none"); 
        $('input').attr('readonly', false);
        $('[name="alamat"]').attr('readonly', false);
        $('[name="tgl_lahir"]').attr('readonly', false);
        $('[name="tgl_bergabung"]').attr('readonly', false);
        // END MANIPULASI DOM

        if (name == 'tambah') { // Jika data-name="tambah" dklik di file (karyawan/index.php), maka lakukan perintah berikut :
            method = 'add'; // Lalu merujuk pada url di method add pada ACTION FORM
            // MANIPULASI DOM pada file (karyawan/index.php)
            $('.form-title').text('Tambah Karyawan'); // Manipulasi Title menjadi Tambah Karyawan
            $('.submitBtn').text('Simpan'); // Manipulasi nama tombol menjadi Simpan
            $('#photo-preview').hide(); // Sembunyikan Foto jika fitur Tambah Karyawan
            $('.no-induk').hide(); 
            // END MANIPULASI DOM
        }
        if (name == 'ubah') { // Jika data-name='ubah' dklik, maka lakukan perintah berikut :
            method = 'update'; // Maka merujuk pada url di method update pada ACTION FORM
            // MANIPULASI DOM pada file (karyawan/index.php)
            $('.form-title').text('Ubah Karyawan'); // Manipulasi Title menjadi Ubah Karyawan
            $('.submitBtn').text('Ubah'); // Manipulasi nama tombol menjadi Ubah
            $('.removefoto').show(); // Tampilkan foto jika fitur Ubah Karyawan
            $('.no-induk').show(); 
            // END MANIPULASI DOM
        }
        if (name == 'hapus') { // Jika data-name='hapus' dklik, maka lakukan perintah berikut :
            method = 'delete'; // Maka merujuk pada url di method delete pada ACTION FORM
            $('.form-title').text('Hapus Karyawan');
            $('.submitBtn').text('Hapus');
            $('.no-induk').show();
            $('.foto-input').addClass("d-none"); 
        }
        if (name == 'kembali') {
            $('.formData').addClass("d-none");
            $('.tableShow').removeClass("d-none");
        }
        if (name == 'detail') {
            $('.form-title').text('Detail Karyawan');
            $('.submitBtn').addClass("d-none");
            $('.foto-input').addClass("d-none"); 
            $('input').attr('readonly', true);
            $('[name="alamat"]').attr('readonly', true);
            $('[name="tgl_lahir"]').attr('readonly', true);
            $('[name="tgl_bergabung"]').attr('readonly', true);
        }
        $.ajax({
            url: `http://localhost:8080/cutiApp/karyawan/get/${id}`, // Requet url - di file ( controllers/karyawan/function get($id) ) untuk memanggil data karyawan berdasarkan id yang dikirim dari url 
            type: "GET",
            dataType: "JSON",
            success: function(data) { // Jika sukses maka tampilkan data dari hasil Request url
                console.log(data);
                $('[name="id"]').val(data.id);
                $('[name="no_induk"]').val(data.no_induk);
                $('[name="nama"]').val(data.nama);
                $('[name="alamat"]').val(data.alamat);
                $('[name="tgl_lahir"]').datepicker('update', data.tgl_lahir);
                $('[name="tgl_bergabung"]').datepicker('update', data.tgl_bergabung);
                if (data.photo) {
                    $('#label-photo').text('Change Photo');
                    $('#photo-preview').html(`<a href="#" class="changeProfile"><img src="upload/${data.photo}" class="img-responsive img-thumbnail" width="90px"></a>`); // show photo
                    $('.removefoto').html(`<input type="checkbox" name="remove_photo" value="${data.photo}"/>Hapus foto`); //Hapus foto
                    $('#label-photo').hide();
                } else {
                    $('#label-photo').text('Upload Photo');
                    $('#photo-preview').html('<a href="#" class="changeProfile">(No Image)</a>');
                }
            },
            error: function() { 
                alert("Gagal");
            }
        });
    });

    //ACTION FORM
    $(document).on("click", ".submitBtn", function(e) { //  Ketika class submitBtn di klik maka eksekusi perintah di bawah :
        e.preventDefault(); // Matika fungsi reload page bawaan browser
        var url;

        var btn = $('.submitBtn');  // Masukkan class submitBtn ke variabel btn
        btn.attr('disabled', true); // setelah itu aktifkan disable attribut pada button utk menghindari double submit 
        var formData = new FormData($('#form')[0]); // Masukkan semua field formdata ke dalam variabel formData

        if (method == 'add') { // Jika data-name="tambah" di klik di (file karyawan/index.php) maka eksekusi url method == add 
            url = "http://localhost:8080/cutiApp/karyawan/v1/simpan"; // url method == add
        } else if (method == 'update') { // Jika data-name='ubah' di klik di (file karyawan/index.js) maka eksekusi url method == update 
            url = "http://localhost:8080/cutiApp/karyawan/v1/ubah"; // url method == update
        } else if (method == 'delete') { // Jika data-name='hapus' di klik di (file karyawan/index.js) maka eksekusi url method == delete 
            url = "http://localhost:8080/cutiApp/karyawan/v1/hapus"; // url method == delete
        }

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(res) {
                if (res.code == 201) { // Jika sukses lakukan perintah di bawah :
                    Message(res.message, res.status); // Tampilkan pesan Message - di file ( assets/js/style.js )
                    $('#form')[0].reset();
                    btn.html('Simpan').attr('disabled', false); // Attribut button disable di nonaktifkan
                    setTimeout(() => { 
                        $('.formData').removeClass("animated fadeOut");
                        $('.formData').addClass("d-none");
                        $('.tableShow').removeClass("d-none");
                    }, 500);
                    setTimeout(() => {
                        tampilKaryawan();
                   }, 600);
                }
                $('.submitBtn').text('Simpan');
            },
            error: function() { 
                alert("Gagal");
            }
        });
    });

});