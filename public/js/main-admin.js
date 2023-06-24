(function ($) {

  "use strict"; // mulai dengan menggunakan strict


  /* ====================
  
          @Masjid
  
  =====================*/

  // tangkap elemen modal browsers
  const provinsi = $('.modal-body #browsers')
  const kab_kota = $('.modal-body #browsers_regencies')
  const district = $('.modal-body #browsers_districts')
  const villages = $('.modal-body #browsers_villages')

  // form modal tambah data masjid
  $('.btn-add-data-masjid').on('click', function () {
    $('#formModalLabel').html('Tambah Data Masjid');
    $('.modal-footer button[type=submit]').html('Tambah Data');

    // reset action data
    $('.modal-content form').attr('action', 'http://localhost/Pzakat/public/masjid/aksi_tambah_mesjid');

    // reset value
    $('#id').val('');
    $('#nama_mesjid').val('');
    $('#alamat_mesjid').html('');
    $('#RT').val('');
    $('#RW').val('');

    // get api wilayah provinsi
    $.getJSON("http://localhost/Pzakat/public/static/api/provinces.json", function (data) {
      // reset select option
      provinsi.html('');

      // looping setiap data dan tambahakn elemen option
      $.each(data, function (i, data) {
        provinsi.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`);
      });

      // ketika provinsi dipilih
      $('.modal-body #browsers option').on('click', function () {
        // get id data
        const id = $(this).data('id');
        kab_kota.html('')
        district.html('')
        villages.html('')

        // get api wilayah kabupaten berdasarkan id
        $.getJSON(`http://localhost/Pzakat/public/static/api/regencies/${id}.json`, function (data) {

          // looping setiap data dan tambahkan elemen option
          $.each(data, function (i, data) {
            kab_kota.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`);
          });

          // ketika kabupaten dipilih
          $('.modal-body #browsers_regencies option').on('click', function () {
            // get id data
            const id = $(this).data('id');
            // reset select option
            district.html('')
            villages.html('')

            $.getJSON(`http://localhost/Pzakat/public/static/api/districts/${id}.json`, function (data) {

              // looping setiap data dan tambahkan elemen option
              $.each(data, function (i, data) {
                district.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`);
              });

              // ketika distrik dipilih
              $('.modal-body #browsers_districts option').on('click', function () {
                // get id data
                const id = $(this).data('id');

                $.getJSON(`http://localhost/Pzakat/public/static/api/villages/${id}.json`, function (data) {
                  // reset select option
                  villages.html('');

                  // looping setiap data tambahakn elemen option
                  $.each(data, function (i, data) {
                    villages.append(`<option value='${data.name}' data-id='${data.id}'>${data.name}</option>`);
                  });
                });
              });
            });
          });
        });
      });
    });
  });


  // form modal ubah data masjid
  $('.btn-update-data-masjid').on('click', function() {
    const apiUrl = "http://localhost/Pzakat/public/static/api";
    const formActionUrl = "http://localhost/Pzakat/public/masjid/aksi_ubah_mesjid";
    const formUrl = "http://localhost/Pzakat/public/masjid/ubah";
  
    provinsi.show();
    kab_kota.show();
    district.show();
    villages.show();
  
    $('#formModalLabel').html('Ubah Data Masjid');
    $('.modal-footer button[type=submit]').html('Ubah Data');
    $('.modal-content form').attr('action', formActionUrl);
  
    const id = $(this).data('id');
  
    $('select').html('');
  
    $.getJSON(`${apiUrl}/provinces.json`, function(dataAPI) {
      $.ajax({
        url: formUrl,
        data: { id },
        method: 'post',
        dataType: 'json',
        success: function(data) {
          $('#nama_mesjid').val(data.nama_mesjid);
          $('#alamat_mesjid').html(data.alamat_mesjid);
          $('#RT').val(data.RT);
          $('#RW').val(data.RW);
          $('#id').val(data.id_mesjid);
  
          $.each(dataAPI, function(i, item) {
            const isSelected = data.provinsi === item.name ? 'selected' : '';
            provinsi.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
          });
  
          let id_provinsi = provinsi.find('option:selected').data('id');
  
          provinsi.on('click', function() {
            id_provinsi = $(this).find('option:selected').data('id');
            kab_kota.html('');
            district.html('');
            villages.html('');
  
            $.getJSON(`${apiUrl}/regencies/${id_provinsi}.json`, function(dataAPI) {
              $.each(dataAPI, function(i, item) {
                const isSelected = data.kabupaten === item.name ? 'selected' : '';
                kab_kota.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
              });
  
              let id_kabupaten = kab_kota.find('option:selected').data('id');
  
              kab_kota.on('click', function() {
                id_kabupaten = $(this).find('option:selected').data('id');
                district.html('');
                villages.html('');
  
                $.getJSON(`${apiUrl}/districts/${id_kabupaten}.json`, function(dataAPI) {
                  $.each(dataAPI, function(i, item) {
                    const isSelected = data.kecamatan === item.name ? 'selected' : '';
                    district.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
                  });
  
                  let id_kecamatan = district.find('option:selected').data('id');
  
                  district.on('click', function() {
                    id_kecamatan = $(this).find('option:selected').data('id');
                    villages.html('');
  
                    $.getJSON(`${apiUrl}/villages/${id_kecamatan}.json`, function(dataAPI) {
                      $.each(dataAPI, function(i, item) {
                        const isSelected = data.kelurahan === item.name ? 'selected' : '';
                        villages.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
                      });
                    });
                  });
                });
              });
            });
          });
        }
      });
    });
  });


  /* ====================
  
          @Norek
  
  =====================*/

  // input norek count
  const countInput = (e) => {
    const count = (e.which) ? e.which : e.keyCode
    if (count >= 48 && count <= 57) String.fromCharCode(count)
    else if (count === 8) String.fromCharCode(count)
    else e.preventDefault()
    console.log(count);
  }

  
  // form modal tambah norek
  $('.btn-add-norek').on('click', function() {
    
    // assignment variabel DOM
    const formLabel   = $('#formNorekModalLabel')
    const action      = 'http://localhost/Pzakat/public/norek/aksi_tambah_norek'
    const btnForm     = $('.modal-footer button[type=submit]')
    const namabank    = $('#nama-bank')
    const namapemilik = $('#nama-pemilik')
    const norek       = $('#norek')
    
    // input count
    norek.on('keydown', countInput)

    // remove img
    $('.img-bank').remove()

    // remove input hidden
    $('.modal-body').find('input[type="hidden"]').remove()

    // show input nama bank
    $('.modal-body .mb-3.bank').show()

    // set name modal 
    formLabel.html('Tambah Data Norek')

    // set name button
    btnForm.html('<i class="fas fa-save"></i> Tambah')

    // reset action data
    $('.modal-content form').attr('action', action)

    // reset value ke kosong
    namabank.val('')
    namapemilik.val('')
    norek.val('')

  })

  // form modal ubah norek
  $('.btn-ubah-norek').on('click', function() {

    // assignment variabel DOM
    const formLabel   = $('#formNorekModalLabel')
    const formUrl     = 'http://localhost/Pzakat/public/norek/ubah'
    const action      = 'http://localhost/Pzakat/public/norek/aksi_ubah_norek'
    const btnForm     = $('.modal-footer button[type=submit]')
    const namapemilik = $('#nama-pemilik')
    const norek       = $('#norek')

    // remove input hidden dan required input
    $('.modal-body').find('input[name="id"]').remove()

    // remove input nama bank
    $('.modal-body .mb-3.bank').hide()

    // input count
    norek.on('keydown', countInput)

    // set name modal 
    formLabel.html('Ubah Data Norek')

    // set name button
    btnForm.html('<i class="fas fa-save"></i> Ubah')

    // reset action data
    $('.modal-content form').attr('action', action)
    
    // reset value ke kosong
    namapemilik.val('')
    norek.val('')
    
    // get id
    const id = $(this).data('id')

    // add input hidden value id
    $('.modal-body').append(`<input type="hidden" name="id" value="${id}">`)

    // request data berdasarkan id
    $.ajax({
      url: formUrl,
      data: { id },
      method: 'post',
      dataType: 'json',
      success: function(data){
        namapemilik.val(data.nama_pemilik)
        norek.val(data.norek)
      }
    })

  })


  /* ====================
  
    Kategori Program
  
  =====================*/
  // form tambah data kategori program
  $('.btn-add-kategori-program').on('click', function() {
    // assignment variabel DOM
    const formLabel     = $('#formNorekModalLabel')
    const action        = 'http://localhost/Pzakat/public/kategoriprogram/aksi_tambah_kategori'
    const btnForm       = $('.modal-footer button[type=submit]')
    const namaKategori  = $('#nama-bank')

    // set name form label
    formLabel.html('Tambah Data Kategori Program')

    // set name button form
    btnForm.html('<i class="fas fa-save"></i> Tambah')

    // set action
    $('.modal-content form').attr('action', action)

    // reset value ke kosong
    namaKategori.val('')

  })


  /* ====================
  
    Banner
  
  =====================*/
  // form add data banner
  $('.btn-add-data-banner').on('click', function(){
    // assignment variabel DOM
    const formLabel   = $('#formModalLabel')
    const action      = 'http://localhost/Pzakat/public/banner/aksi_tambah_banner'
    const btnForm     = $('.modal-footer button[type=submit]')
    const gambar      = $('#gambar');

    // set value kosong
    gambar.val('');

    // set name form label
    formLabel.html('Tambah Data Banner')

    // set button name
    btnForm.html('Tambah')

    // set action
    $('.modal-content form').attr('action', action)
  })


  /**
   * 
   * @TambahDataZakat Bentuk Barang
   * 
   */
  
  $('.btn-zakat').on('click', function() {
    // get option beras value on click
    const gambarZakat = $('.gambar-zakat')
    const contentZakat = $('.content-zakat')
    $('#browsers option[value="beras"]').on('click', function() {
      // hide gambar dan content
      gambarZakat.hide()
      contentZakat.hide()
    })

    // get option fidyah value on click
    $('#browsers option[value="fidyah"]').on('click', function() {
      // show gambar dan content
      gambarZakat.show()
      contentZakat.show()
    })

    // get option uang value on click
    $('#browsers option[value="uang"]').on('click', function() {
      // show gambar dan content
      gambarZakat.show()
      contentZakat.show()
    })
  })


})(jQuery); // akhir strict