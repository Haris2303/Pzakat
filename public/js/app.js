// navbar fixed 
window.onscroll = function () {
  const navbar = document.querySelector('navbar');
  const fixedNav = navbar.offsetTop;

  if (window.pageYOffset > fixedNav) {
    navbar.classList.add('navbar-fixed')
    navbar.style.transition = '1s'
  } else {
    navbar.classList.remove('navbar-fixed')
  }
}

// hamburger
const hamburger = document.querySelector('#hamburger');
const navmenu = document.querySelector('#nav-menu')

hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('hamburger-active')
  navmenu.classList.toggle('hidden')
})

// dropdown menu
const dropdown_menu = document.querySelector('.dropdown-menu')
const btn_dropdown = document.querySelector('.btn-dropdown')

btn_dropdown.addEventListener('click', () => {
  dropdown_menu.classList.toggle('h-0')
})



/**
 * @function countOnly
 * @param {event} event 
 * @return true | 0
 */
const countOnly = (event) => {
  // // function count only
  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()

  $(document).ready(function () {

    // get element DOM by jquery
    const gajibulanan = $('#gajibulanan')
    const gajilain = $('#gajilain')
    const cicilan = $('#cicilan')
    const etotaluang = $('#totaluang')
    const enilaizakat = $('#nilaizakat')

    // when user typing..
    $(event.target).on('input', function () {
      if (this.value) {
        const value = parseInt(this.value.replace(/\D/g, ''));

        // format currency
        this.value = value.toLocaleString('id-ID', {
          style: 'decimal'
        })

        // cek value komponen zakat
        const a = (gajibulanan.val()) ? gajibulanan.val() : '0'
        const b = (gajilain.val()) ? gajilain.val() : '0'
        const c = (cicilan.val()) ? cicilan.val() : '0'

        // convert currency to number
        const num1 = parseInt(a.replace(/\D/g, ''));
        const num2 = parseInt(b.replace(/\D/g, ''));
        const num3 = parseInt(c.replace(/\D/g, ''));

        // hitung nilai
        const hitung = num1 + num2 - num3
        const result = (hitung > 0) ? hitung : 0;

        // hitung nilai zakat
        const nilaizakat = Math.floor((result > 6131333) ? result * 2.5 / 100 : 0)

        // set value total dan nilai
        etotaluang.attr('value', 'Rp. ' + result.toLocaleString('id-ID'))
        enilaizakat.attr('value', 'Rp. ' + nilaizakat.toLocaleString('id-ID'))

        return true

      } else this.value = 0

    })
  })
}


/**
 * 
 * @public jquery
 * 
*/
$(document).ready(function () {

  $('#btn-delete').on('click', function (e) {
    e.preventDefault();

    const action = $('form').attr('action')
    const data = $('form input#id').val()

    Swal.fire({
      title: 'Hapus data tersebut?',
      text: "Klik hapus untuk menghapus data tersebut!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus'
    }).then((result) => {
      if (result.isConfirmed) {

        $.ajax({
          type: "post",
          url: action,
          data: { id: data },
          success: function (response) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Data berhasil dihapus',
              showConfirmButton: false,
              timer: 1500
            })
          }
        });

      }
    })
  })

  // set url
  const url = 'http://localhost/Pzakat';

  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------
   *                SEARCH
   * ------------------------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * @param {this} keyword
   * @return void
   */
  const renderContentSearch = (keyword) => {
    $('#root').load(url + '/web/search/' + keyword)
  }

  // search id keyword-lg on controller web user page
  $('#keyword-lg').on('keyup', function () {
    let value = $(this).val().replace(/\s+/g, '-')
    renderContentSearch(value)
  })

  // search id keyword-md on controller web user page
  $('#keyword-md').on('keyup', function () {
    let value = $(this).val().replace(' ', '-')
    renderContentSearch(value)
  })

  /**
   * @function cardContent
   * @param {string} imageSource 
   * @param {string} programSlug 
   * @param {string} programKategori 
   * @param {string} programName 
   * @param {number} dana 
   * @param {number} donatur 
   * @returns {string} element html
   */
  const cardContent = (imageSource, programSlug, programKategori, programName, dana, donatur) => {
    return `
      <div class="lg:w-1/3 shadow-md">
        <a href="${url}/program/${programSlug}">
          <img src="${url}/img/program/${imageSource}" alt="Gambar Program ${programKategori}" class="lg:h-48 h-64 lg:w-full w-screen">
        </a>
        <div class="px-4 my-4 flex flex-col gap-1">
          <a href=""><span class="category text-lightgray text-xs">${programKategori}</span></a>
          <a href="">
            <h4 class="text-md text-darkgray">${programName}</h4>
          </a>
          <span class="garis-progress my-1 after:w-8"></span>
          <div class="flex justify-between text-xs text-lightgray">
            <div>Donasi Terkumpul</div>
            <div>Donatur</div>
          </div>
          <div class="flex justify-between text-md text">
            <div class="font-bold text-darkgray">Rp ${dana}</div>
            <div class="text-darkgray">${donatur}</div>
          </div>
        </div>
      </div>`
  }

  // set content card program
  const kategori_first = $('.program-kategori a:first-child').data('name')

  // get kosongkan isi content
  $('.program').html('');

  // get data menggunakan ajax
  $.ajax({
    url: url + '/web/getdataprogram',
    data: { name: kategori_first },
    method: 'post',
    dataType: 'json',
    success: function (data) {
      // tampilkan isi card content sesuai kategori awal
      $.each(data, function (i, item) {
        $('.program').append(cardContent(item.gambar, item.slug, item.jenis_program, item.nama_program, item.total_dana.toLocaleString('id-ID'), item.jumlah_donatur))
      })
    }
  })

  // ketika program kategori diklik
  $('.program-kategori a').on('click', function () {
    const name = $(this).data('name')

    // get kosongkan isi content
    $('.program').html('');

    // get data menggunakan ajax
    $.ajax({
      url: url + '/web/getdataprogram',
      data: { name },
      method: 'post',
      dataType: 'json',
      success: function (data) {
        $.each(data, function (i, item) {
          $('.program').append(cardContent(item.gambar, item.slug, item.jenis_program, item.deskripsi_program, item.total_dana.toLocaleString('id-ID'), item.jumlah_donatur))
        })
      }
    })
  })

  // Fungsi untuk menampilkan konten detail pembayaran dan donatur
  const detailContent = (item) => {
    return `
      <p><strong style="font-size:14px">Donatur:</strong></p>
      <p><strong style="font-size:16px">Nama Donatur:</strong> ${item.nama_donatur}</p>
      <p><strong style="font-size:16px">Email:</strong> ${item.email}</p>
      <p><strong style="font-size:16px">Nomor Telepon:</strong> ${item.nohp}</p>
      <p><strong style="font-size:16px">Pesan:</strong> ${item.pesan}</p>
      <br>
      <p><strong style="font-size:14px">PROGRAM:</strong></p>
      <p><strong style="font-size:16px">Jenis Program:</strong> ${item.jenis_program}</p>
      <p><strong style="font-size:16px">Nama Program:</strong> ${item.nama_program}</p>
      <p><strong style="font-size:16px">Status Pembayaran:</strong> ${item.status_pembayaran}</p>
      <p><strong style="font-size:16px">Tanggal Pembayaran:</strong> ${item.tanggal_pembayaran.split(' ')[0]}</p>
    `;
  }

  // Event handler untuk tombol detail
  $('.btn-detail').on('click', function () {
    // Ambil data id dari atribut data-id pada tombol
    const id = $(this).data('id');
    // Kirim permintaan ajax untuk mendapatkan data pembayaran
    $.ajax({
      url: url + '/user_dashboard/getDataPembayaran',
      data: { id },
      method: 'post',
      dataType: "json",
      success: function (response) {
        // Tampilkan pop-up detail pembayaran menggunakan library Swal (SweetAlert)
        Swal.fire({
          title: `<span style="font-size: 20px">Detail Pembayaran <em>${response.nomor_pembayaran}</em> </span>`,
          html: detailContent(response),
          confirmButtonText: 'Tutup',
          text: 'Klik oke untuk close',
          imageUrl: url + "/public/img/bukti_pembayaran/" + response.bukti_pembayaran,
          imageWidth: 250,
          imageHeight: 350,
          imageAlt: 'Bukti Pembayaran',
        });
      }
    });
  });
})