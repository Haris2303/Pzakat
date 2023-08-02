const root = document.querySelector("#root");
const loader = document.querySelector('#loader');

window.onload = function() {
    root.classList.toggle('hidden')
    loader.classList.add('none')
}