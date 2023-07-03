// inputan hanya angka
const countInput = (event) => {
  const count = (event.which) ? event.which : event.keyCode
  if (count >= 48 && count <= 57) String.fromCharCode(count);
  else if (count === 8) String.fromCharCode(count);
  else event.preventDefault()
}