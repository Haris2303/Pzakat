<?php

class Pagination
{

    protected $db;
    protected $view;
    protected static $limit = 5;
    protected static $page;
    protected static $data;

    public function __construct(string $view, array $data, int $limit, int $page)
    {
        $this->db = new Database();
        $this->view = $view;
        self::$limit = $limit;
        self::$page = $page;
        self::$data = count($data);
    }

    /**
     * 
     * @method setPage (setting halaman dari pagination)
     * @var table&limit
     * @param string $table Nama tabel
     * @param int $limit Batas data yang diambil
     * @param array|null $where Klausa WHERE opsional
     * 
     */
    public function setPager(callable $callback = null): array
    {
        $limit = self::$limit;
        $page = self::$page;
        $view = $this->view;
        
        // jika page adalah 0
        if($page <= 0) $page = 1;

        // tentukan offset
        $offset = $limit * ($page - 1);

        // query limit tanpa callback
        $q1 = "SELECT * FROM $view LIMIT $limit OFFSET $offset";

        // jika array null
        if (is_null($callback)) $query = $q1;

        // jika callback tidak null
        if (!is_null($callback)) {
            $q2 = "SELECT * FROM $view " . $callback() . " LIMIT $limit OFFSET $offset";
            $query = $q2;
        }

        // siapkan query
        $this->db->query($query);

        // Sesuaikan dengan metode resultSet() dari objek Database
        return $this->db->resultSet();
    }

    public static function view(int $jumlah_pagination = 3)
    {
        $page = self::$page;
        $jumlah_page = ceil(self::$data / self::$limit);
        $next = $page + 1; // tambahkan 1 setiap klik
        $prev = $page - 1; // kurangkan 1 setiap klik

        // set awal start and end page
        $start_page = 1;
        $end_page = $page + $jumlah_pagination;

        // start pagination
        if($page > $jumlah_pagination) {
            $start_page =+ ($page - $jumlah_pagination);
        }

        // end pagination
        if(($page + $jumlah_pagination) > $jumlah_page) {
            $end_page = $jumlah_page;
        }

        // kirimkan data
        $data = [
            "jumlah_page" => $jumlah_page,
            "next_page" => $next,
            "prev_page" => $prev,
            "start_page" => $start_page,
            "end_page" => $end_page,
            "page" => $page,
        ];

        // jika data lebih banyak dari limit munculkan view pagination
        if(self::$data > self::$limit) {
            $view = new Controller();
            echo $view->view('pagination/default', $data);
        }
    }
}
