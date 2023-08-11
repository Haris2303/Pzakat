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


  // Fungsi yang dijalankan saat tombol 'Ubah Data Masjid' diklik
$('.btn-update-data-masjid').on('click', function () {
  // URL API dan URL untuk aksi formulir serta tampilan formulir
  const apiUrl = "http://localhost/Pzakat/public/static/api";
  const formActionUrl = "http://localhost/Pzakat/public/masjid/aksi_ubah_mesjid";
  const formUrl = "http://localhost/Pzakat/public/masjid/ubah";

  // Tampilkan elemen provinsi, kabupaten/kota, kecamatan, dan kelurahan
  provinsi.show();
  kab_kota.show();
  district.show();
  villages.show();

  // Konfigurasi tampilan modal saat proses ubah data
  $('#formModalLabel').html('Ubah Data Masjid');
  $('.modal-footer button[type=submit]').html('Ubah Data');
  $('.modal-content form').attr('action', formActionUrl);

  // Ambil ID data masjid yang akan diubah
  const id = $(this).data('id');

  // Kosongkan semua elemen select
  $('select').html('');

  // Ambil data provinsi dari API
  $.getJSON(`${apiUrl}/provinces.json`, function (dataAPI) {
    // Ambil data masjid berdasarkan ID
    $.ajax({
      url: formUrl,
      data: { id },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        // Isi nilai-nilai form dengan data yang diambil
        $('#nama_mesjid').val(data.nama_mesjid);
        $('#alamat_mesjid').html(data.alamat_mesjid);
        $('#RT').val(data.RT);
        $('#RW').val(data.RW);
        $('#id').val(data.id_mesjid);

        // Isi opsi provinsi dan tentukan opsi yang terpilih
        $.each(dataAPI, function (i, item) {
          const isSelected = data.provinsi === item.name ? 'selected' : '';
          provinsi.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
        });

        // Ambil ID provinsi yang terpilih
        let id_provinsi = provinsi.find('option:selected').data('id');

        // Event handler saat opsi provinsi diubah
        provinsi.on('click', function () {
          id_provinsi = $(this).find('option:selected').data('id');
          kab_kota.html('');
          district.html('');
          villages.html('');

          // Ambil data kabupaten/kota dari API berdasarkan ID provinsi
          $.getJSON(`${apiUrl}/regencies/${id_provinsi}.json`, function (dataAPI) {
            // Isi opsi kabupaten/kota dan tentukan opsi yang terpilih
            $.each(dataAPI, function (i, item) {
              const isSelected = data.kabupaten === item.name ? 'selected' : '';
              kab_kota.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
            });

            // Ambil ID kabupaten/kota yang terpilih
            let id_kabupaten = kab_kota.find('option:selected').data('id');

            // Event handler saat opsi kabupaten/kota diubah
            kab_kota.on('click', function () {
              id_kabupaten = $(this).find('option:selected').data('id');
              district.html('');
              villages.html('');

              // Ambil data kecamatan dari API berdasarkan ID kabupaten/kota
              $.getJSON(`${apiUrl}/districts/${id_kabupaten}.json`, function (dataAPI) {
                // Isi opsi kecamatan dan tentukan opsi yang terpilih
                $.each(dataAPI, function (i, item) {
                  const isSelected = data.kecamatan === item.name ? 'selected' : '';
                  district.append(`<option value='${item.name}' ${isSelected} data-id='${item.id}'>${item.name}</option>`);
                });

                // Ambil ID kecamatan yang terpilih
                let id_kecamatan = district.find('option:selected').data('id');

                // Event handler saat opsi kecamatan diubah
                district.on('click', function () {
                  id_kecamatan = $(this).find('option:selected').data('id');
                  villages.html('');

                  // Ambil data kelurahan dari API berdasarkan ID kecamatan
                  $.getJSON(`${apiUrl}/villages/${id_kecamatan}.json`, function (dataAPI) {
                    // Isi opsi kelurahan dan tentukan opsi yang terpilih
                    $.each(dataAPI, function (i, item) {
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


  // form modal tambah norek
  $('.btn-add-norek').on('click', function () {

    // assignment variabel DOM
    const formLabel = $('#formNorekModalLabel')
    const action = 'http://localhost/Pzakat/public/norek/aksi_tambah_norek'
    const btnForm = $('.modal-footer button[type=submit]')
    const namabank = $('#nama-bank')
    const namapemilik = $('#nama-pemilik')
    const norek = $('#norek')

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
  $('.btn-ubah-norek').on('click', function () {

    // assignment variabel DOM
    const formLabel = $('#formNorekModalLabel')
    const formUrl = 'http://localhost/Pzakat/public/norek/ubah'
    const action = 'http://localhost/Pzakat/public/norek/aksi_ubah_norek'
    const btnForm = $('.modal-footer button[type=submit]')
    const namapemilik = $('#nama-pemilik')
    const norek = $('#norek')

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
      success: function (data) {
        namapemilik.val(data.nama_pemilik)
        norek.val(data.norek)
      }
    })

  })


  /* ====================
  
    Kategori Program
  
  =====================*/
  // form tambah data kategori program
  $('.btn-add-kategori-program').on('click', function () {
    // assignment variabel DOM
    const formLabel = $('#formNorekModalLabel')
    const action = 'http://localhost/Pzakat/public/kategoriprogram/aksi_tambah_kategori'
    const btnForm = $('.modal-footer button[type=submit]')
    const namaKategori = $('#nama-bank')

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
  $('.btn-add-data-banner').on('click', function () {
    // assignment variabel DOM
    const formLabel = $('#formModalLabel')
    const action = 'http://localhost/Pzakat/public/banner/aksi_tambah_banner'
    const btnForm = $('.modal-footer button[type=submit]')
    const gambar = $('#gambar');

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

  $('.btn-zakat').on('click', function () {
    // get option beras value on click
    const gambarZakat = $('.gambar-zakat')
    const contentZakat = $('.content-zakat')
    $('#browsers option[value="beras"]').on('click', function () {
      // hide gambar dan content
      gambarZakat.hide()
      contentZakat.hide()
    })

    // get option fidyah value on click
    $('#browsers option[value="fidyah"]').on('click', function () {
      // show gambar dan content
      gambarZakat.show()
      contentZakat.show()
    })

    // get option uang value on click
    $('#browsers option[value="uang"]').on('click', function () {
      // show gambar dan content
      gambarZakat.show()
      contentZakat.show()
    })
  })


  /**
   * 
   * @Pengeluaran Tunai
   * 
   * @Rekening Selected
   * 
   */
  // ketika option pada nama-progarm di klik
  $('#rekening-bank option').on('click', function () {

    let saldoRekening = $(this).data('saldo')
    let dataJenisProgram = $(this).data('jenis')

    const url = 'http://localhost/Pzakat/public/kelola_program/getDataProgramByJenisProgram'
    const component = {
      elementOption: (textContent, attrValue, dataSaldo) => {
        return `
          <option value="${attrValue}" data-saldo="${dataSaldo}">${textContent}</option>
        `
      },
      msgNominalInput: (saldo) => `<span class="text-primary">Nominal sebesar <strong>${nominal.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</strong> diterima</span>`,
      msgAwal: '<span class="text-primary">Masukkan nominal!</span>',
      msgNonValid: (saldo) => `<span class="text-danger">Nominal harus lebih dari Rp 100.000 dan kurang dari <strong>${saldo.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' })}</strong></span>`,
      msgSaldoKosong: `<span class="text-danger">Saldo Kosong!</span>`
    }

    // destruct component
    const { elementOption, msgNominalInput, msgAwal, msgNonValid, msgSaldoKosong } = component

    // get nominal value
    let nominal = $('#nominal').val()

    // set option pada selection program jadi kosong
    $('#nama-program').html('');

    // request data
    $.ajax({
      type: "method",
      url: url,
      method: 'post',
      data: { jenis_program: dataJenisProgram },
      dataType: "json",
      success: function (response) {
        $.each(response, function (i, item) {
          if (saldoRekening >= item.total_dana && item.total_dana > 0) $('#nama-program').append(elementOption(item.nama_program, item.id_program, item.total_dana))
        });

        let saldoProgram = 0;
        // get saldo program option
        $('#nama-program option').on('click', function () {
          saldoProgram = $(this).data('saldo')
          if (nominal === '') {
            $('#pesan-nominal').html(msgAwal)
            $('.btn-tambah').prop('disabled', true)
          }
        })

        $('#nominal').on('keyup', function () {
          // set text content pesan nominal jadi kosong
          $('#pesan-nominal').html('')

          // replace currency ke format angka biasa
          nominal = parseInt($(this).val().replace(/\D/g, ''));

          if (saldoProgram === 0) {
            $('#pesan-nominal').html(msgSaldoKosong)
            $('.btn-tambah').prop('disabled', true)
          } else {
            // jika nominal empty
            if ((nominal >= 100000) && (nominal <= saldoProgram)) {
              $('#pesan-nominal').html(msgNominalInput(saldoProgram))
              $('.btn-tambah').prop('disabled', false)
            }

            // jika nominal <= 0
            if (nominal < 100000) {
              $('#pesan-nominal').html(msgNonValid(saldoProgram))
              $('.btn-tambah').prop('disabled', true)
            }

            // jika nominal > saldoProgram
            if (nominal > saldoProgram) {
              $('#pesan-nominal').html(msgNonValid(saldoProgram))
              $('.btn-tambah').prop('disabled', true)
            }
          }

        })


      }
    });
  })

  /**
   * 
   * @Pengeluaran Barang
   * 
   * @desc Handling untuk memproses nominal pengeluaran pada program yang dipilih.
   * 
   */
  // Ketika opsi pada elemen dengan ID 'nama-program' di klik
  $('#nama-program option').on('click', function () {

    // Ambil berat barang dari atribut data
    let beratBarang = $(this).data('berat')

    // Komponen pesan untuk berbagai kondisi
    const component = {
      msgNominalInput: () => `<span class="text-primary">Nominal sebesar <strong>${nominal.toLocaleString('id-ID')} Gram</strong> diterima</span>`,
      msgAwal: '<span class="text-primary">Masukkan nominal!</span>',
      msgNonValid: (saldo) => `<span class="text-danger">Nominal harus lebih dari 1.000 Gram dan kurang dari <strong>${saldo.toLocaleString('id-ID')} Gram</strong></span>`,
      msgSaldoKosong: `<span class="text-danger">Saldo Kosong!</span>`,
    }

    // Destructuring komponen pesan
    const { msgNominalInput, msgAwal, msgNonValid, msgSaldoKosong } = component

    // Ambil nilai nominal dari elemen dengan ID 'nominal'
    let nominal = $('#nominal').val()

    // Jika nilai nominal kosong
    if (nominal === '') {
      $('#pesan-nominal').html(msgAwal)
      $('.btn-tambah').prop('disabled', true)
    }

    // Event handler saat input nominal diubah
    $('#nominal').on('keyup', function () {
      // Set isi dari elemen dengan ID 'pesan-nominal' menjadi kosong
      $('#pesan-nominal').html('')

      // Ubah format nominal menjadi angka tanpa koma atau titik
      nominal = parseInt($(this).val().replace(/\D/g, ''));

      // Jika berat barang = 0
      if (beratBarang === 0) {
        $('#pesan-nominal').html(msgSaldoKosong)
        $('.btn-tambah').prop('disabled', true)
      } else {
        // Jika nominal < 1000
        if (nominal < 1000) {
          $('#pesan-nominal').html(msgNonValid(beratBarang))
          $('.btn-tambah').prop('disabled', true)
        }

        // Jika nominal sesuai
        if ((nominal >= 1000) && (nominal <= beratBarang)) {
          $('#pesan-nominal').html(msgNominalInput())
          $('.btn-tambah').prop('disabled', false)
        }

        // Jika nominal <= 0
        if (nominal < 0) {
          $('#pesan-nominal').html(msgNonValid(beratBarang))
          $('.btn-tambah').prop('disabled', true)
        }

        // Jika nominal > beratBarang (saldoProgram)
        if (nominal > beratBarang) {
          $('#pesan-nominal').html(msgNonValid(beratBarang))
          $('.btn-tambah').prop('disabled', true)
        }
      }
    })
  })

})(jQuery); // akhir strict