/**
* -----------------------------------------------------------------------------------------------------------------------
*               POPUP SWEETALERT2
* -----------------------------------------------------------------------------------------------------------------------
*/

$(document).ready(function () {

    /**
     * @function sweetAlert
     * @param {string} icon Tipe ikon SweetAlert (success, error, warning, info, question)
     * @param {string} pesan Pesan yang akan ditampilkan dalam SweetAlert
     * @param {string} btnOK Opsi untuk tombol OK (n: tidak menampilkan tombol OK, y: menampilkan tombol OK)
     */
    const sweetAlert = (icon, pesan, btnOK = 'n') => {
        // Memeriksa apakah tombol OK diatur sebagai 'n'
        if (btnOK === 'n') {
            // Menampilkan SweetAlert tanpa tombol OK, hanya menampilkan pesan dengan ikon yang sesuai
            Swal.fire({
                position: 'top-end',
                icon: icon,
                title: `${pesan}`,
                showConfirmButton: false,
                timer: 1500
            })
        } else if (btnOK === 'y') {
            // Menampilkan SweetAlert dengan tombol OK yang memungkinkan pengguna menutup pesan
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
        // Memisahkan pesan, tipe, dan tombol OK dari data flash yang di-split berdasarkan '|'
        const pesan = flashData.split("|")[0]
        const tipe = flashData.split("|")[1]
        const btnOK = flashData.split("|")[2]

        // Menampilkan SweetAlert sesuai dengan tipe yang diberikan
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

    // Menangani klik tombol hapus pada form delete
    $('#form-delete #btn-delete').on('click', function (e) {
        // block action
        e.preventDefault()

        // Mendapatkan ID dari atribut data 'uuid' pada tombol
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
                // Arahkan pengguna ke URL penghapusan data
                document.location.href = url
            }
        })

    })

    /**
     * @event click
     * @description Menangani klik tombol logout untuk menghapus data sesi pengguna.
     */
    $('#btn-logout').on('click', function() {
        // set url 
        const url = 'http://localhost/Pzakat/userlogout';

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
                // Arahkan pengguna ke URL penghapusan data
                document.location.href = url
            }
        })
    })

})