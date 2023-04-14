// sidebar collapseTwo
const navItem = document.querySelectorAll('.nav-item');
const navLink = document.querySelectorAll('.nav-link')
const collapseUtilities = document.querySelector('#collapseUtilities');
const collapseTwo = document.querySelector('#collapseTwo');

navItem.forEach( item => {
  item.addEventListener('click', () => {
    console.log(item);
    console.log(item.lastElementChild.getAttribute('id'));
    switch(item.lastElementChild.getAttribute('id')) {
      case 'collapseTwo':
        item.lastElementChild.classList.toggle('show')
        break
      case 'collapseUtilities':
        item.lastElementChild.classList.toggle('show')
        break
      case 'collapsePages':
        item.lastElementChild.classList.toggle('show')
        break
    }
    // if(item.lastElementChild.getAttribute('id') === 'collapseTwo') {
    //   item.lastElementChild.classList.toggle('show')
    // }
    // if(item.lastElementChild.getAttribute('id') === 'collapseUtilities') item.lastElementChild.classList.toggle('show')
    // if(item.lastElementChild.getAttribute('id') === 'collapsePages') item.lastElementChild.classList.toggle('show')
  })
})

navLink.forEach( item => {
  item.setAttribute('aria-expanded', 'false');
  item.addEventListener('click', () => {
    item.setAttribute('aria-expanded', 'true')
    item.classList.toggle('collapsed')
  })
})