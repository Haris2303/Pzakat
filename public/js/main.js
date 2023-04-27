// navbar fixed 
window.onscroll = function() {
  const navbar = document.querySelector('navbar');
  const fixedNav = navbar.offsetTop;

  if( window.pageYOffset > fixedNav ) {
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
const gajibulanan = document.querySelector('#gajibulanan')
const gajilain = document.querySelector('#gajilain')
const cicilan = document.querySelector('#cicilan')
// function count only
const countOnly = (event) => {
  const count = (event.which) ? event.which : event.keyCode
  if(event.keyCode === 8 || event.keyCode === 46) return true
  else if (count < 48 || count > 57) return false

  // format currency
  $(document).ready(function() {
    $(event.target).on('input', function() {
      const value = this.value.replace(/,/g, '');
      const etotaluang = $('#totaluang')
      const enilaizakat = $('#nilaizakat')
      if(this.value) {
        this.value = parseInt(value).toLocaleString('en-US', {
          style: 'decimal',
          maximumFractionDigits: 0,
          minimumFractionDigits: 0
        });
  
        // cek value komponen zakat
        let a = (gajibulanan.value) ? gajibulanan.value : '0'
        let b = (gajilain.value) ? gajilain.value : '0'
        let c = (cicilan.value) ? cicilan.value : '0'
  
        // convert currency to number
        let num1 = parseInt(a.replace(/\D/g, ''));
        let num2 = parseInt(b.replace(/\D/g, ''));
        let num3 = parseInt(c.replace(/\D/g, ''));
        let result = num1 + num2 - num3;
  
        // hitung nilai zakat
        const nilaizakat = (result > 6131333) ? result * 2.5 / 100 : 0
  
        // set value total dan nilai
        etotaluang.attr('value', 'Rp. ' + result.toLocaleString('id-ID'))
        enilaizakat.attr('value', 'Rp. ' + nilaizakat.toLocaleString('id-ID'))
      }
    })
  })

  return true
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
      if(i == j){
        program[j].classList.remove('hidden')
        program[j].classList.add('flex')
      } else if(i != j){
        program[j].classList.remove('flex')
        program[j].classList.add('hidden')
      }
    }
  })
}