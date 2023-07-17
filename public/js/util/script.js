// inputan hanya angka
const countInput = (event) => {
  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()
}

// currency input keyup
const currency = (event) => {
  // // function count only
  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()

  $(document).ready(function () {

    $(event.target).on('input', function () {
      if(this.value){
        const value = parseInt(this.value.replace(/\D/g, ''));

        // format currency
        this.value = value.toLocaleString('id-ID', {
          style: 'decimal'
        })

      } else this.value = 0
      
    })
  })
}

// calendar
$('.calendar').ready(function() {

  const months = [
    "Januari",
    "Februari",
    "Maret",
    "April",
    "Mei",
    "Juni",
    "Juli",
    "Agustus",
    "September",
    "Oktober",
    "November",
    "Desember",
  ]

  const nameDays = [
    "Minggu",
    "Sabtu",
    "Jumat",
    "Kamis",
    "Rabu",
    "Selasa",
    "Senin"
  ]

  const date = new Date()
  const renderCelendar = () => {
    const monthDays = document.querySelector('.days')
    date.setDate(1)
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate()
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate()
    const firstDayIndex = date.getDay()
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay()
    const nextDays = 7 - lastDayIndex - 1
    
    let days = "";
    let today = "";
    
    for(let x = firstDayIndex; x > 0; x--) {
      days += `<div class="prev-date">${prevLastDay - x + 1}</div>`
    }
  
    for(let i = 1; i <= lastDay; i++) {
      if(i === new Date().getDate() && new Date().getMonth() === date.getMonth()) {
        days += `<div class="today">${i}</div>`
        today = i;
      } else {
        days += `<div>${i}</div>`
      }
    }
    
    for(let j = 1; j <= nextDays; j++) {
      days += `<div class="next-date">${j}</div>`
      monthDays.innerHTML = days
    }

    const dateToday = date.toDateString().split(' ')
    for(let k = 0; k <= nameDays.length - 1; k++) {
      if(k === date.getDay()) {
        dateToday[0] = nameDays[k]
      }
    }
    dateToday[2] = today

    document.querySelector('.date h1').innerHTML = months[date.getMonth()]
    document.querySelector('.date p').innerHTML = dateToday.join(' ')
  }

  document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1)
    renderCelendar()
  })
  document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1)
    renderCelendar()
  })

  renderCelendar()
})
  