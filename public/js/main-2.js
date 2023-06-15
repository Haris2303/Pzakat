
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

const calcFidyah = (event) => {
  // reset href
  const hrefValue = $('.next-btn').prop('href')
  const lastString = hrefValue.lastIndexOf('/')
  const newHref = hrefValue.substring(0, lastString)

  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()

  $(document).ready(function () {

    $(event.target).on('keyup', function () {
      if(this.value){
        // set href baru
        $('.next-btn').attr('href', newHref + '/' + this.value)
      }
    })
  })
}