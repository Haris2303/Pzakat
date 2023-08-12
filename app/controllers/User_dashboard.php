<?php

class User_dashboard extends Controller
{

    protected $id_user = null;         // Menyimpan ID pengguna yang sedang login
    protected $data_pending = null;    // Menyimpan data transaksi dengan status "pending"
    protected $data_konfirmasi = null; // Menyimpan data transaksi dengan status "konfirmasi"
    protected $data_sukses = null;     // Menyimpan data transaksi dengan status "sukses"
    protected $data_failed = null;     // Menyimpan data transaksi dengan status "gagal"
    protected $limit = 5;              // Batasan jumlah data yang ditampilkan
    protected $orderby = ["tanggal_pembayaran" => "DESC"]; // Pengaturan urutan data berdasarkan tanggal pembayaran secara menurun (DESC)

    /**
     * Konstruktor kelas yang digunakan untuk mengelola data pembayaran berdasarkan status dan pengguna tertentu (level 3)
     * Ini akan menginisialisasi beberapa properti dan mengambil data pembayaran berdasarkan status dan id_user.
     */
    public function __construct()
    {
        // Cek status level pengguna, jika tidak ada atau bukan level 3, arahkan ke halaman awal
        if (!isset($_SESSION['level']) || $_SESSION['level'] !== '3') {
            header('Location: ' . BASEURL . '/');
            exit;
        }

        // Ambil id_user berdasarkan username dari session pengguna
        $this->id_user = $this->model('User_model')->getIdByUsername($_SESSION['username']);

        // Inisialisasi dan ambil data pembayaran dengan status "pending" untuk id_user yang diberikan
        $this->data_pending = $this->model('Pembayaran_model')->getAllDataPembayaran(
            'pending',
            $this->orderby,
            [
                'logic' => 'AND',
                'status_pembayaran =' => 'pending',
                'id_user =' => $this->id_user
            ]
        );

        // Inisialisasi dan ambil data pembayaran dengan status "konfirmasi" untuk id_user yang diberikan
        $this->data_konfirmasi = $this->model('Pembayaran_model')->getAllDataPembayaran(
            'konfirmasi',
            $this->orderby,
            [
                'logic' => 'AND',
                'status_pembayaran =' => 'konfirmasi',
                'id_user =' => $this->id_user
            ]
        );

        // Inisialisasi dan ambil data pembayaran dengan status "failed" untuk id_user yang diberikan
        $this->data_failed = $this->model('Pembayaran_model')->getAllDataPembayaran(
            'failed',
            $this->orderby,
            [
                'logic' => 'AND',
                'status_pembayaran =' => 'failed',
                'id_user =' => $this->id_user
            ]
        );

        // Inisialisasi dan ambil data pembayaran dengan status "success" untuk id_user yang diberikan
        $this->data_sukses = $this->model('Pembayaran_model')->getAllDataPembayaran(
            'success',
            $this->orderby,
            [
                'logic' => 'AND',
                'status_pembayaran =' => 'success',
                'id_user =' => $this->id_user
            ]
        );
    }

    /**
     * Menampilkan halaman dashboard pengguna (user dashboard)
     * @method index
     */
    public function index()
    {
        // Persiapan data untuk ditampilkan di halaman dashboard
        $data = [
            'judul' => 'User Dashboard',                        // Judul halaman
            'jumlah_donasi' => count($this->data_sukses),        // Jumlah donasi sukses
            'dana' => $this->data_sukses                        // Data transaksi dengan status sukses
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman dashboard pengguna
        $this->view('user_dashboard/index', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman daftar donasi yang sedang menunggu pembayaran (donasi dengan status "pending")
     * @method donasi_pending
     * @param int $page Halaman yang ingin ditampilkan (default: 1)
     */
    public function donasi_pending($page = 1)
    {
        // Membuat objek Pagination untuk mengelola paginasi
        $pagination = new Pagination('vwAllPembayaran', $this->data_pending, $this->limit, $page);

        // Mengatur pager untuk paginasi berdasarkan data pending yang telah diinisialisasi sebelumnya
        $paginate = $pagination->setPager($this->orderby, [
            "logic" => "AND",
            "status_pembayaran =" => "pending",
            "id_user =" => $this->id_user
        ]);

        // Persiapan data untuk ditampilkan di halaman daftar donasi pending
        $data = [
            'judul' => 'Menunggu Pembayaran',  // Judul halaman
            'pending' => $paginate,             // Data yang akan ditampilkan pada halaman
            'no' => (($page - 1) * $this->limit) + 1  // Nomor urut untuk menampilkan nomor pada halaman paginasi
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman daftar donasi pending
        $this->view('user_dashboard/donasi_pending', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman daftar donasi yang telah dikonfirmasi (donasi dengan status "konfirmasi")
     * @method donasi_konfirmasi
     * @param int $page Halaman yang ingin ditampilkan (default: 1)
     */
    public function donasi_konfirmasi($page = 1)
    {
        // Membuat objek Pagination untuk mengelola paginasi
        $pagination = new Pagination('vwAllPembayaran', $this->data_konfirmasi, $this->limit, $page);

        // Mengatur pager untuk paginasi berdasarkan data konfirmasi yang telah diinisialisasi sebelumnya
        $paginate = $pagination->setPager($this->orderby, [
            "logic" => "AND",
            "status_pembayaran =" => "konfirmasi",
            "id_user =" => $this->id_user
        ]);

        // Persiapan data untuk ditampilkan di halaman daftar donasi yang telah dikonfirmasi
        $data = [
            'judul' => 'Konfirmasi Donasi',       // Judul halaman
            'konfirmasi' => $paginate,            // Data yang akan ditampilkan pada halaman
            'no' => (($page - 1) * $this->limit) + 1  // Nomor urut untuk menampilkan nomor pada halaman paginasi
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman daftar donasi yang telah dikonfirmasi
        $this->view('user_dashboard/donasi_konfirmasi', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman daftar donasi yang gagal (donasi dengan status "failed")
     * @method donasi_gagal
     * @param int $page Halaman yang ingin ditampilkan (default: 1)
     */
    public function donasi_gagal($page = 1)
    {
        // Membuat objek Pagination untuk mengelola paginasi
        $pagination = new Pagination('vwAllPembayaran', $this->data_failed, $this->limit, $page);

        // Mengatur pager untuk paginasi berdasarkan data yang gagal yang telah diinisialisasi sebelumnya
        $paginate = $pagination->setPager($this->orderby, [
            "logic" => "AND",
            "status_pembayaran =" => "failed",
            "id_user =" => $this->id_user
        ]);

        // Persiapan data untuk ditampilkan di halaman daftar donasi yang gagal
        $data = [
            'judul' => 'Donasi Gagal',          // Judul halaman
            'gagal' => $paginate,                // Data yang akan ditampilkan pada halaman
            'no' => (($page - 1) * $this->limit) + 1  // Nomor urut untuk menampilkan nomor pada halaman paginasi
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman daftar donasi yang gagal
        $this->view('user_dashboard/donasi_gagal', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman daftar donasi yang berhasil (donasi dengan status "success")
     * @method donasi_sukses
     * @param int $page Halaman yang ingin ditampilkan (default: 1)
     */
    public function donasi_sukses($page = 1)
    {
        // Membuat objek Pagination untuk mengelola paginasi
        $pagination = new Pagination('vwAllPembayaran', $this->data_sukses, $this->limit, $page);

        // Mengatur pager untuk paginasi berdasarkan data yang berhasil yang telah diinisialisasi sebelumnya
        $paginate = $pagination->setPager($this->orderby, [
            "logic" => "AND",
            "status_pembayaran =" => "success",
            "id_user =" => $this->id_user
        ]);

        // Persiapan data untuk ditampilkan di halaman daftar donasi yang berhasil
        $data = [
            'judul' => 'Donasi Sukses',          // Judul halaman
            'sukses' => $paginate,                // Data yang akan ditampilkan pada halaman
            'no' => (($page - 1) * $this->limit) + 1  // Nomor urut untuk menampilkan nomor pada halaman paginasi
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman daftar donasi yang berhasil
        $this->view('user_dashboard/donasi_sukses', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman pengaturan akun pengguna (muzakki)
     * @method pengaturan
     */
    public function pengaturan()
    {
        // Mengambil data pengguna (muzakki) berdasarkan nama pengguna yang sedang masuk (diambil dari sesi)
        $data_user = $this->model('Muzakki_model')->getDataByUsername($_SESSION['username']);

        // Persiapan data untuk ditampilkan di halaman pengaturan akun
        $data = [
            'judul' => 'Pengaturan Akun',  // Judul halaman
            'muzakki' => $data_user        // Data pengguna (muzakki) yang akan ditampilkan pada halaman
        ];

        // Memuat template header
        $this->view('template/header', $data);

        // Memuat template sidebar pengguna
        $this->view('template/user_sidebar', $data);

        // Memuat tampilan halaman pengaturan akun
        $this->view('user_dashboard/pengaturan', $data);

        // Memuat template footer
        $this->view('template/footer', $data);
    }

    /**
     * Menampilkan halaman detail pembayaran berdasarkan ID donatur
     * @method detail
     * @param string|null $param ID donatur (jika tidak ada, akan menampilkan halaman error 404)
     */
    public function getDataPembayaran(): void
    {
        echo json_encode($this->model('Pembayaran_model')->getDataPembayaranById($_POST['id']));

        // // Jika parameter ID donatur tidak diberikan, tampilkan halaman error 404
        // if (is_null($param)) {
        //     $this->view('error/404');
        //     exit;
        // }

        // // Mengambil data detail pembayaran berdasarkan ID donatur yang diberikan
        // $data_detail = $this->model('Pembayaran_model')->getDataPembayaranById($_POST['id_donatur']);

        // // Persiapan data untuk ditampilkan di halaman detail pembayaran
        // $data = [
        //     "judul" => "Detail Pembayaran",  // Judul halaman
        //     "detail" => $data_detail         // Data detail pembayaran yang akan ditampilkan pada halaman
        // ];

        // // Memuat template header
        // $this->view('template/header', $data);

        // // Memuat template sidebar pengguna
        // $this->view('template/user_sidebar', $data);

        // // Memuat tampilan halaman detail pembayaran
        // $this->view('user_dashboard/detail', $data);

        // // Memuat template footer
        // $this->view('template/footer', $data);
    }

    /**
     * -------------------------------------------------------------------------------------------------------------------------------------
     *                  ACTION METHOD
     * -------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Menangani aksi perubahan profil pengguna (muzakki)
     * @method aksi_ubah_profil
     */
    public function aksi_ubah_profil()
    {
        // Melakukan pembaruan data profil pengguna di database berdasarkan ID pengguna yang sedang masuk
        $update = $this->model('Muzakki_model')->updateData($this->id_user, $_POST);

        // Menggunakan hasil pembaruan untuk memberikan umpan balik kepada pengguna
        if ($update > 0 && is_int($update)) {
            // Jika pembaruan berhasil, tampilkan pesan sukses
            Flasher::setFlash('Perubahan berhasil disimpan!', 'success');
        } else {
            // Jika pembaruan gagal, tampilkan pesan kesalahan (jika ada) atau pesan umum "Perubahan gagal disimpan!"
            Flasher::setFlash((!is_int($update)) ? $update : 'Perubahan gagal disimpan!', 'danger');
        }

        // Redirect pengguna ke halaman pengaturan setelah pembaruan selesai (tanpa memperhatikan berhasil atau gagal)
        header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
        exit;
    }

    /**
     * Menangani aksi perubahan password pengguna
     * @method aksi_ubah_password
     */
    public function aksi_ubah_password()
    {
        // Melakukan pembaruan password pengguna di database berdasarkan username pengguna yang sedang masuk
        $update = $this->model('User_model')->updatePassword($_SESSION['username'], $_POST);

        // Menggunakan hasil pembaruan untuk memberikan umpan balik kepada pengguna
        if ($update > 0 && is_int($update)) {
            // Jika pembaruan password berhasil, tampilkan pesan sukses
            Flasher::setFlash('Perubahan Password berhasil disimpan!', 'success');
        } else {
            // Jika pembaruan password gagal, tampilkan pesan kesalahan (yang diterima dari model)
            Flasher::setFlash($update, 'danger');
        }

        // Redirect pengguna ke halaman pengaturan setelah pembaruan password selesai (tanpa memperhatikan berhasil atau gagal)
        header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
        exit;
    }
}
