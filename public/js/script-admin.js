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