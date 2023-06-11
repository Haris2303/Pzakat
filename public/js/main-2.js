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