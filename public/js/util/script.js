// Fungsi untuk membatasi input hanya angka dan tombol "backspace" menggunakan event keydown
const renderCountInput = (event) => {
  // Ambil kode tombol yang ditekan (cross-browser support)
  const count = (event.which) ? event.which : event.keyCode;
  
  // Periksa apakah tombol yang ditekan adalah karakter angka (digit) atau tombol "backspace"
  if ((count >= 48 && count <= 57) || count === 8) {
    // Jika memenuhi kondisi di atas, lanjutkan dengan mengembalikan karakter yang sesuai
    return String.fromCharCode(count);
  } else {
    // Jika bukan karakter angka atau tombol "backspace", cegah input lebih lanjut
    event.preventDefault();
  }
}

// Fungsi yang memanggil renderCountInput dan meneruskannya dengan event yang sama
function countInput(event) {
  renderCountInput(event);
}


/** 
 * @method renderCurrency
 * Fungsi untuk input mata uang dan otomatis memformat sebagai format mata uang Indonesia (IDR).
 * 
 * @param {Event} event - Event yang memicu pemanggilan fungsi ini (biasanya event keyup).
 */
const renderCurrency = (event) => {
  // Ambil kode tombol yang ditekan (cross-browser support)
  const count = (event.which) ? event.which : event.keyCode;
  
  // Periksa apakah tombol yang ditekan adalah karakter angka (digit) atau tombol "backspace"
  if ((count >= 48 && count <= 57) || count === 8) {
    // Jika memenuhi kondisi di atas, lanjutkan dengan mengembalikan karakter yang sesuai
    return String.fromCharCode(count);
  } else {
    // Jika bukan karakter angka atau tombol "backspace", cegah input lebih lanjut
    event.preventDefault();
  }


  // Menggunakan jQuery: jalankan kode setelah dokumen siap
  $(document).ready(function () {
    // Pasang event handler untuk input
    $(event.target).on('input', function () {
      if (this.value) {
        // Hapus semua karakter non-digit dari nilai input
        const value = parseInt(this.value.replace(/\D/g, ''));

        // Format nilai sebagai mata uang dengan tanda desimal (IDR) menggunakan 'toLocaleString'
        this.value = value.toLocaleString('id-ID', {
          style: 'decimal'
        });
      } else {
        // Jika nilai input kosong, setel nilainya menjadi 0
        this.value = 0;
      }
    });
  });
}


// Fungsi untuk merender tampilan kalender bulanan
$('.calendar').ready(function () {
  // Daftar nama-nama bulan dalam Bahasa Indonesia
  const months = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
  ];

  // Daftar nama-nama hari dalam Bahasa Indonesia
  const nameDays = [
    "Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"
  ];

  // Inisialisasi tanggal hari ini
  const date = new Date();

  // Fungsi untuk merender tampilan kalender
  const renderCalendar = () => {
    // Seleksi elemen dengan kelas 'days' untuk menampilkan hari-hari dalam kalender
    const monthDays = document.querySelector('.days');
    
    // Set tanggal ke 1
    date.setDate(1);

    // Menentukan tanggal akhir dari bulan ini dan bulan sebelumnya
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

    // Menentukan indeks hari pertama dalam bulan ini dan indeks hari terakhir bulan ini
    const firstDayIndex = date.getDay();
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();

    // Menentukan jumlah hari dari bulan sebelumnya yang akan ditampilkan
    const nextDays = 7 - lastDayIndex - 1;

    let days = "";
    let today = "";

    // Menampilkan hari-hari dari bulan sebelumnya yang masuk dalam tampilan kalender
    for (let x = firstDayIndex; x > 0; x--) {
      days += `<div class="prev-date">${prevLastDay - x + 1}</div>`;
    }

    // Menampilkan hari-hari dari bulan ini dalam tampilan kalender
    for (let i = 1; i <= lastDay; i++) {
      if (i === new Date().getDate() && new Date().getMonth() === date.getMonth()) {
        days += `<div class="today">${i}</div>`;
        today = i;
      } else {
        days += `<div>${i}</div>`;
      }
    }

    // Menampilkan hari-hari dari bulan berikutnya yang masuk dalam tampilan kalender
    for (let j = 1; j <= nextDays; j++) {
      days += `<div class="next-date">${j}</div>`;
      monthDays.innerHTML = days;
    }

    // Mengupdate nama bulan dan tanggal yang ditampilkan
    const dateToday = date.toDateString().split(' ');
    for (let k = 0; k <= nameDays.length - 1; k++) {
      if (k === new Date().getDay()) {
        dateToday[0] = nameDays[k];
      }
    }
    dateToday[2] = today;

    // Menampilkan nama bulan dan tanggal pada tampilan kalender
    document.querySelector('.date h1').innerHTML = months[date.getMonth()];
    document.querySelector('.date p').innerHTML = dateToday.join(' ');
  }

  // Event handler untuk tombol "Previous" (Bulan sebelumnya)
  document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
  });

  // Event handler untuk tombol "Next" (Bulan berikutnya)
  document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
  });

  // Pertama kali, merender tampilan kalender
  renderCalendar();
})