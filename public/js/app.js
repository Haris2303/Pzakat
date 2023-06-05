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



/* =========================
  |   PERHITUNGAN ZAKAT
  ==========================
*/


const countOnly = (event) => {
  // // function count only
  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()

  $(document).ready(function () {

    const gajibulanan = $('#gajibulanan')
    const gajilain    = $('#gajilain')
    const cicilan     = $('#cicilan')
    const etotaluang  = $('#totaluang')
    const enilaizakat = $('#nilaizakat')

    $(event.target).on('input', function () {
      if(this.value){
        const value = parseInt(this.value.replace(/\D/g, ''));

        // format currency
        this.value = value.toLocaleString('id-ID', {
          style: 'decimal',
          currency: 'USD'
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

/* =========================
  | END  PERHITUNGAN ZAKAT
  ==========================
*/



/* =========================
  |   PROGRAM PAGINATION
  ==========================
*/
const program_kategori = document.querySelectorAll('.program-kategori a')
const program = document.querySelectorAll('.program')

for (let i = 0; i < program_kategori.length; i++) {
  program_kategori[i].addEventListener('click', () => {
    for (let j = 0; j < program_kategori.length; j++) {
      if (i == j) {
        program[j].classList.remove('hidden')
        program[j].classList.add('flex')
      } else if (i != j) {
        program[j].classList.remove('flex')
        program[j].classList.add('hidden')
      }
    }
  })
}