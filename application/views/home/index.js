
   $(document).ready(function() {

        function awalGabung() {
            $.ajax({
                type: 'ajax',
                url: 'http://localhost:8080/cutiApp/karyawan/v1/awal_gabung', // Requet url - di file ( controllers/karyawan/function v1()/awal_gabung )
                dataType: 'json',
                success: function(data) { 
                    var html = '';
                    data.map(e => { // looping data menggunakan map dari hasil Request url
                        html += `<tr class='text-left'>`;
                        html += `<td>${e.no_induk}</td>`;
                        html += `<td>${e.nama}</td>`;
                        html += `<td>${e.alamat}</td>`;
                        html += `</tr>`;
                    });
                    $("#awal-gabung").html(html); // tampilkan di html tag <tbody id="awal-gabung"> - di (views/home/index.php)
                }
            });
        }
        awalGabung();

        function cutiLebihSatu() {
            $.ajax({
                type: 'ajax',
                url: 'http://localhost:8080/cutiApp/cuti/v1/cuti_lebih_satu', // Requet data ke url - di file ( controllers/cuti/function v1()/cuti_lebih_satu )
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    data.map(e => {  // looping data menggunakan map dari hasil Request url
                        html += `<tr class='text-left'>`;
                        html += `<td>${e.no_induk}</td>`;
                        html += `<td>${e.nama}</td>`;
                        html += `<td>${e.tgl_cuti}</td>`;
                        html += `<td>${e.keterangan}</td>`;
                        html += `</tr>`;
                    });
                    $("#cuti-lebih-satu").html(html); // tampilkan di html tag <tbody id="cuti-lebih-satu"> - di (views/home/index.php)
                }
            });
        }
        cutiLebihSatu();

        function pernahCuti() {
            $.ajax({
                type: 'ajax',
                url: 'http://localhost:8080/cutiApp/cuti/v1/pernah_cuti', // Requet data ke url - di file ( controllers/cuti/function v1()/pernah_cuti )
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    data.map(e => { // looping data menggunakan map dari hasil Request url
                        html += `<tr class='text-left'>`;
                        html += `<td><a data-id="${e.id}" class='btn-act' title='Hapus'><i class='fa fa-trash text-danger'></i></a></td>`;  // assigned data-name, data-id untuk menentukan type action hapus sesuai id dan btn-act utk menjalan function onClick 
                        html += `<td>${e.no_induk}</td>`;
                        html += `<td>${e.nama}</td>`;
                        html += `<td>${e.tgl_cuti}</td>`;
                        html += `<td>${e.keterangan}</td>`;
                        html += `</tr>`;
                    });
                    $("#pernah-cuti").html(html); // tampilkan di html tag <tbody id="pernah-cuti"> - di (views/home/index.php)
                }
            });
        }
        pernahCuti();
          
        $(document).on("click", ".btn-act", function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: `http://localhost:8080/cutiApp/cuti/v1/hapus`, // Requet data ke url - di file ( controllers/cuti/function v1()/hapus )
                data: {
                    id: id
                },
                success: function(res) {
                    if (res.code == 201) {
                        pernahCuti();
                    }
                }
            });
        });

        function sisaCuti() {
            $.ajax({
                type: 'ajax',
                url: 'http://localhost:8080/cutiApp/cuti/v1/sisa_cuti', // Requet data ke url - di file ( controllers/cuti/function v1()/sisa_cuti )
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    data.map(e => { // looping data menggunakan map dari hasil Request url
                        html += `<tr class='text-left'>`;
                        html += `<td>${e.no_induk}</td>`;
                        html += `<td>${e.nama}</td>`;
                        html += `<td>${e.lama_cuti} Hari</td>`;
                        html += `</tr>`;
                    });
                    $("#sisa-cuti").html(html); // tampilkan di html tag <tbody id="sisa-cuti""> - di (views/home/index.php)
                }
            });
        }
        sisaCuti();

    });