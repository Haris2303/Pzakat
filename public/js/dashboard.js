(function ($) {

  "use strict"; // mulai dengan menggunakan strict

  // tangkap elemen modal browsers
  const provinsi = $('.modal-body #browsers')
  const kab_kota = $('.modal-body #browsers_regencies')
  const district = $('.modal-body #browsers_districts')
  const villages = $('.modal-body #browsers_villages')

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

    // hide element kota, kecamatan, kelurahan
    kab_kota.hide()
    district.hide()
    villages.hide()

    // get api wilayah provinsi
    $.getJSON("http://localhost/Pzakat/public/static/api/provinces.json", function (data) {

      // reset select option
      provinsi.html('')

      // looping setiap data dan tambahakn elemen option
      $.each(data, function (i, data) {
        provinsi.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
      })

      // ketika provinsi dipilih
      $('.modal-body #browsers option').on('click', function () {
        // get id data
        const id = $(this).data('id')

        // show element kab_kota
        kab_kota.show()

        // get api wilayah kabupaten berdasarkan id
        $.getJSON(`http://localhost/Pzakat/public/static/api/regencies/${id}.json`, function (data) {
          // reset select option
          kab_kota.html('');

          // looping setiap data dan tambahkan elemen option
          $.each(data, function (i, data) {
            kab_kota.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
          })

          // ketika kabupaten dipilih
          $('.modal-body #browsers_regencies option').on('click', function () {
            // get id data
            const id = $(this).data('id')

            // show element district
            district.show()

            $.getJSON(`http://localhost/Pzakat/public/static/api/districts/${id}.json`, function (data) {
              // reset select option
              district.html('');

              // looping setiap data dan tambahkan elemen option
              $.each(data, function (i, data) {
                district.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
              })

              // ketika distrik dipilih
              $('.modal-body #browsers_districts option').on('click', function () {
                // get id data
                const id = $(this).data('id');

                // show element kelurahan
                villages.show()

                $.getJSON(`http://localhost/Pzakat/public/static/api/villages/${id}.json`, function (data) {
                  // reset select option
                  villages.html('')

                  // looping setiap data tambahakn elemen option
                  $.each(data, function (i, data) {
                    villages.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`)
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

    // show browsers wilayah indonesia
    provinsi.show()
    kab_kota.show()
    district.show()
    villages.show()

    $('#formModalLabel').html('Ubah Data Masjid')
    $('.modal-footer button[type=submit]').html('Ubah Data');

    // ubah action data
    $('.modal-content form').attr('action', 'http://localhost/Pzakat/public/masjid/aksi_ubah_mesjid')

    const id = $(this).data('id');

    // get api
    $.getJSON("http://localhost/Pzakat/public/static/api/provinces.json", function (dataAPI) {
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
          $.each(dataAPI, function(i, item){
            provinsi.append(`<option value='${item.name}'${data.provinsi === item.name ? 'selected' : ''} data-id='${item.id}'>${item.name}</option>`)
          })

          // get id yang terselect
          const id_provinsi = provinsi.find('option:selected').data('id')

          // get id provinsi
          $.getJSON(`http://localhost/Pzakat/public/static/api/regencies/${id_provinsi}.json`, function(dataAPI) {
            $.each(dataAPI, function(i, item){
              kab_kota.append(`<option value='${item.name}'${data.kabupaten === item.name ? 'selected' : ''} data-id='${item.id}'>${item.name}</option>`)
            })
            // get id yang terselect
            const id_kabupaten = kab_kota.find('option:selected').data('id')
            $.getJSON(`http://localhost/Pzakat/public/static/api/districts/${id_kabupaten}.json`, function (dataAPI) { 
              $.each(dataAPI, function(i, item) {
                district.append(`<option value='${item.name}'${data.kecamatan === item.name ? 'selected' : ''} data-id='${item.id}'>${item.name}</option>`)
              })
              // get id yang terselect
              const id_kecamatan = district.find('option:selected').data('id')
              $.getJSON(`http://localhost/Pzakat/public/static/api/villages/${id_kecamatan}.json`, function(dataAPI) {
                $.each(dataAPI, function(i, item) {
                  villages.append(`<option value='${item.name}'${data.kelurahan === item.name ? 'selected' : ''} data-id='${item.id}'>${item.name}</option>`)
                })
              }
              );
             }
            );
          }
          );

        }
      })
    }
    );
  })

})(jQuery); // akhir strict