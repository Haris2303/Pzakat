(function ($) {

  "use strict"; // mulai dengan menggunakan strict

  // form modal tambah data masjid
  $('.btn-add-data-masjid').on('click', function () {
    $('#formModalLabel').html('Tambah Data Masjid')
    $('.modal-footer button[type=submit]').html('Tambah Data');

    // reset action data
    $('.modal-content form').attr('action', 'http://localhost/Pzakat/public/masjid/aksi_tambah_mesjid')

    // reset value
    $('#id').val('');
    $('#nama_mesjid').val('')
    $('#alamat_mesjid').html('')
    $('#RT').val('');
    $('#RW').val('');

    
    // get api wilayah provinsi
    $.getJSON("http://localhost/Pzakat/public/static/api/provinces.json", function (data) {

      // reset select option
      $('.modal-body #browsers').html('')
      
      // looping setiap data dan tambahakn elemen option
      $.each(data, function (i, data) {
        $('.modal-body #browsers').append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
      })

      // ketika provinsi dipilih
      $('.modal-body #browsers option').on('click', function(){
        // get id data
        const id = $(this).data('id')

        // get api wilayah kabupaten berdasarkan id
        $.getJSON(`http://localhost/Pzakat/public/static/api/regencies/${id}.json`, function (data) {
          // reset select option
          $('.modal-body #browsers_regencies').html('');

          // looping setiap data dan tambahkan elemen option
          $.each(data, function(i, data) {
            $('.modal-body #browsers_regencies').append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
          })

          // ketika kabupaten dipilih
          $('.modal-body #browsers_regencies option').on('click', function() {
            // get id data
            const id = $(this).data('id')

            $.getJSON(`http://localhost/Pzakat/public/static/api/districts/${id}.json`, function (data) {  
                // reset select option
                $('.modal-body #browsers_districts').html('');

                // looping setiap data dan tambahkan elemen option
                $.each(data, function(i, data) {
                  $('.modal-body #browsers_districts').append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
                })

                // ketika distrik dipilih
                $('.modal-body #browsers_districts option').on('click', function(){
                  // get id data
                  const id = $(this).data('id');

                  $.getJSON(`http://localhost/Pzakat/public/static/api/villages/${id}.json`, function(data) {
                    // reset select option
                    $('.modal-body #browsers_villages').html('')

                    // looping setiap data tambahakn elemen option
                    $.each(data, function(i, data) {
                      $('.modal-body #browsers_villages').append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
                    })
                  }
                  );
                })
              },
            );
          })
        },
        );
      })

    }
    );
  })

  // form modal ubah data masjid
  $('.btn-update-data-masjid').on('click', function () {
    $('#formModalLabel').html('Ubah Data Masjid')
    $('.modal-footer button[type=submit]').html('Ubah Data');

    // ubah action data
    $('.modal-content form').attr('action', 'http://localhost/Pzakat/public/masjid/aksi_ubah_mesjid')

    const id = $(this).data('id');
    // kirimkan data dan set value
    $.ajax({
      url: 'http://localhost/Pzakat/public/masjid/ubah',
      data: { id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $('#nama_mesjid').val(data.nama_mesjid)
        $('#alamat_mesjid').html(data.alamat_mesjid)
        $('#RT').val(data.RT)
        $('#RW').val(data.RW)
        $('#id').val(data.id_mesjid)
      }
    })

  })

})(jQuery); // akhir strict