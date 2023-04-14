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