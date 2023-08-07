/**
* -----------------------------------------------------------------------------------------------------------------------
*               POPUP SWEETALERT2
* -----------------------------------------------------------------------------------------------------------------------
*/

$(document).ready(function () {

    /**
     * @function alertSuccess
     * @param {string} icon
     * @param {string} pesan
     * @param {string} btnOK 'n' | 'y'
     */
    const sweetAlert = (icon, pesan, btnOK = 'n') => {
        if(btnOK === 'n') {
            Swal.fire({
                position: 'top-end',
                icon: icon,
                title: `${pesan}`,
                showConfirmButton: false,
                timer: 1500
            })
        } else if(btnOK === 'y') {
            Swal.fire(
                pesan,
                'Tutup pesan dengan mengklik tombol OK',
                icon
              )
        }
    }

    // set flash sweetalert
    const flashData = $('.flash').data('flash');

    // tampilkan sweetalert jika ada data flash
    if (flashData) {
        const pesan = flashData.split("|")[0]
        const tipe = flashData.split("|")[1]
        const btnOK = flashData.split("|")[2]
        switch (tipe) {
            case 'success':
                sweetAlert('success', pesan, btnOK)
                break;
            case 'info':
                sweetAlert('info', pesan, btnOK)
                break;
            case 'warning':
                sweetAlert('warning', pesan, btnOK)
                break;
            case 'danger':
                sweetAlert('error', pesan, btnOK)
                break;
            default:
                sweetAlert('question', pesan, btnOK);
                break;
        }
    }

    // url awal
    let currentUrl = window.location.href;

    // cek url controller apakah method index atau bukan
    let parts = currentUrl.split('/');
    parts.splice(5); // sisahkan 5 array

    // url baru
    const newCurrentURL = parts.join('/')

    $('#form-delete #btn-delete').on('click', function (e) {
        // block action
        e.preventDefault()

        // get id
        const id = $(this).data('uuid')

        // buat url untuk kirim data
        const url = newCurrentURL + '/aksi_hapus_data/' + id

        // popup confirmation
        Swal.fire({
            title: 'Anda ingin hapus data?',
            text: "Klik hapus untuk menghapus data tersebut!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = url
            }
        })

    })

})