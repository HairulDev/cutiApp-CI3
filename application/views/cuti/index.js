    $(document).ready(function() {
        function tampilKaryawan() {
            $.ajax({
                type: 'ajax',
                url: 'http://localhost:8080/cutiApp/karyawan/v1/tampil_karyawan',  // Requet url - di file ( controllers/karyawan/function v1()/tampil_karyawan ) untuk memanggil semua data karyawan
                async: false,
                dataType: 'json',
                success: function(data) { // Jika sukses maka tampilkan data dari hasil Request url
                    var html = '';
                    data.map(e => {
                        html += `<tr class='text-left'>`;
                        html += `<td>${e.no_induk}</td>`;
                        html += `<td>${e.nama}</td>`;
                        html += `<td>${e.alamat}</td>`;
                        html += `<td><button data-name='cuti' data-id="${e.id}"" class='btn btn-act btn-outline-info btn-sm' title='Cuti'><i class='fa fa-check'></i> </a></td>`;
                         // assigned data-name, data-id untuk menentukan type action cuti sesuai id yg dikirim data-id  dan btn-act utk menjalan function onClick 
                        html += `</tr>`;
                    });
                    $("#tampil-cuti").html(html);
                }
            });
        }
        tampilKaryawan();
        $('#mydata').dataTable();

        function reload_table() {
            tampilKaryawan();
        }


        $(document).on("click", ".btn-act", function(e) {// Ketika button class btn-act di klik maka eksekusi perintah di bawah :
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
            // END MANIPULASI DOM

            if (name == 'cuti') { // Jika data-name="cuti" dklik, maka lakukan perintah berikut :
                method = 'save'; // Lalu merujuk pada url di method save pada ACTION FORM
                // MANIPULASI DOM pada file (cuti/index.php)
                $('.form-title').text('Pengajuan Cuti');
                $('.submitBtn').text('Simpan');
                // END MANIPULASI DOM
            }
            if (name == 'kembali') { // Jika data-name="kembali" dklik, maka lakukan perintah berikut :
                // MANIPULASI DOM pada file (cuti/index.php)
                $('.formData').addClass("d-none");
                $('.tableShow').removeClass("d-none");
                // END MANIPULASI DOM
            }
            $.ajax({
                url: `http://localhost:8080/cutiApp/karyawan/get/${id}`,  // Requet url - di file ( controllers/karyawan/function get($id) ) untuk memanggil data karyawan berdasarkan id yang dikirim dari url 
                type: "GET",
                dataType: "JSON",
                success: function(data) {  // Jika sukses maka tampilkan data dari hasil Request url
                    $('[name="id"]').val(data.id);
                    $('[name="no_induk"]').val(data.no_induk);
                    $('[name="nama"]').val(data.nama);
                    $('.nama').text(data.nama);
                    $('.no-induk').text(data.no_induk);
                    if (data.photo) {
                        $('#label-photo').text('Change Photo');
                        $('#photo-preview').html(`<img src="upload/${data.photo}" class="img-responsive img-thumbnail" width="90px">`); // show photo
                        $('#label-photo').hide();
                    } else {
                        $('#photo-preview').html('(No Image)');
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
            btn.attr('disabled', true); // setelah itu disable attribut pada button utk menghindari double submit
            var formData = new FormData($('#form')[0]);  // Masukkan semua field formdata ke dalam variabel formData

            if (method == 'save') {// Jika data-name="cuti" di klik maka eksekusi url method == save 
                url = "http://localhost:8080/cutiApp/cuti/v1/ajukan_cuti";  // url method == save
            }

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data) {
                    if (data.code == 201) { // Jika sukses lakukan perintah di bawah :
                        $('#form')[0].reset();
                        Message(data.message, data.status); // Tampilkan pesan Message - di file ( assets/js/style.js )
                        btn.html('Simpan').attr('disabled', false);  // Attribut button disable di nonaktifkan
                        setTimeout(() => {
                            reload_table();
                        }, 500);
                        setTimeout(() => {
                            $('.formData').addClass("animated fadeOut");
                        }, 1200);
                        setTimeout(() => {
                            $('.formData').removeClass("animated fadeOut");
                            $('.formData').addClass("d-none");
                        }, 1700);
                        setTimeout(() => {
                            $('.tableShow').removeClass("d-none");
                        }, 1700);
                    }
                    $('.submitBtn').text('Simpan');
                    $('.submitBtn').attr('disabled', false);
                },
                error: function() { 
                    alert("Gagal");
                }
            });
        });
      
    });