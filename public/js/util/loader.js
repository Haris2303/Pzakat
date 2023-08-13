const showLoading = function() {
    Swal.fire({
        title: 'Please Wait !',
        html: 'data sedang diproses...',// add html attribute if you want or remove
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading()
        },
    });
}

document.querySelector(".form-loader").addEventListener("submit", function () {
    showLoading();
});