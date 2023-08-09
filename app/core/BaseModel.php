<?php

class BaseModel
{
    public $db;
    private $table;

    public function __construct(string $table)
    {
        $this->db = new Database();
        $this->table = $table;
    }

    /**
     * @param array $kondisi masukkan sebuah kondisi where dengan menggunakan array contoh `["kolom" => "nilai"]`
     * @return bool true | false
     */
    public function isData(array $kondisi): bool
    {
        // tangkap key dan value dari array kondisi
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        // init query
        $query = "SELECT * FROM $this->table WHERE $key = ?";
        // prepare query
        $this->db->query($query);
        // binding
        $this->db->bind(1, $value);
        // execute
        $this->db->execute();
        // kembalikan true jika bukan boolean dan kembalikan false jika boolean
        return (!is_bool($this->db->single())) ? true : false;
    }

    /**
     * @param string $view nilai default adalah `null` untuk table, jika Anda ingin menampilkan view, maka masukkan view yang Anda inginkan.
     * @param string $notSelect nilai default adalah `null` untuk menampilkan semua field, jika tidak ingin menampilkan field tertentuk maka berikan `-field` untuk tidak menampilkan field tersebut contoh `-id`
     * @param string $orderBy nilai default adalah `created_at` jika ada, jika tidak ada maka Anda harus memberikan sebuah field sesuaikan dengan yang ada pada database Anda untuk di order.
     * @return void
     * 
     * @continue Hubungkan dengan fungsi berikutnya itu `fetchAll` atau `fetch`
     */
    public function selectData(string $view = null, string $notSelect = null, array $orderBy = [], array $kondisi = null): void
    {
        // set table 
        $table = (!is_null($view)) ? $view : $this->table;

        // set field selection
        $select = (!is_null($notSelect) && $notSelect !== '*') ? '*,' . $notSelect : '*';

        // init order
        $setOrder = "";
        
        // jika order by ada
        if (count($orderBy) > 0) {

            // set key dan value order
            $keyOrder = array_keys($orderBy)[0];
            $valueOrder = array_values($orderBy)[0];

            $setOrder = "ORDER BY $keyOrder $valueOrder";
        }

        // query awal 
        $query = "SELECT $select FROM $table $setOrder";

        // cek kondisi where
        if (!is_null($kondisi)) {

            // ambil gerbang logika AND | OR 
            // set index $i
            if (array_key_exists("logic", $kondisi)) {
                $logic = $kondisi['logic'];
                $i = 1;
            } else {
                $logic = "";
                $i = 0;
            };

            // ambil key dan value dari kondisi
            $arr = [];
            for ($i; $i <= count($kondisi) - 1; $i++) {
                $arr += [array_keys($kondisi)[$i] => array_values($kondisi)[$i]];
            }

            // set where kondisi
            $setKondisi = implode(" ? $logic ", array_keys($arr)) . " ? ";

            // buat query
            $query = "SELECT $select FROM $table WHERE ($setKondisi) $setOrder";

            // siapkan query
            $this->db->query($query);

            // binding
            $i = 1;
            foreach ($arr as $value) {
                $this->db->bind($i, $value);
                $i++;
            }
        } else {
            // siapkan query awal
            $this->db->query($query);
        }
    }

    /**
     * @param null 
     * @return array semua data dari fungisi `selectData()`
     */
    public function fetchAll(): array
    {
        return $this->db->resultSet();
    }

    /**
     * @param null 
     * @return array semua data dari fungisi `selectData()`
     */
    public function fetch(): array
    {
        return $this->db->single();
    }

    public function insertData(array $data): int
    {
        /// INSERT INTO table VALUES(NULL, ?, ?, ?, ?, ...);

        // set array placeholder 
        $placeholders = [];
        foreach ($data as $value) {
            $placeholders[] = "?";
        }
        // gabungkan placeholder ? menjadi string
        $placeholdersStr = implode(', ', $placeholders);

        // init query
        $query = "INSERT INTO $this->table VALUES (NULL, $placeholdersStr)";

        // prepare query
        $this->db->query($query);

        // binding
        $i = 1;
        foreach ($data as $value) {
            $this->db->bind($i, $value);
            $i++;
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * @param array $kondisi masukkan sebuah kondisi where untuk menghapus data contoh `["id" => 1]`
     * @return int rowCount (0 || (> 0))
     */
    public function deleteData(array $kondisi): int
    {
        // tangkap key dan value dari array kondisi
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        // init query
        $query = "DELETE FROM $this->table WHERE $key = ?";
        // prepare query
        $this->db->query($query);
        // binding 
        $this->db->bind(1, $value);
        // execute
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    /**
     * @param array $update_values masukkan sebuah data update sesuaikan dengan nama field pada database berupa array contoh `["nama" => "Ucup", "nohp" => "08239999999"]`
     * @param array $kondisi masukkan sebuah kondisi where untuk menghapus data contoh `["id" => 1]`
     * @return int rowCount
     */
    public function updateData(array $update_values, array $kondisi): int
    {
        // tangkap key dan value dari kondisi where
        $kondisi_key = array_keys($kondisi)[0];
        $kondisi_value = array_values($kondisi)[0];

        // set placeholder jadi : field = ?, field2 = ?
        $placeholders = implode(' = ?, ', array_keys($update_values)) . ' = ? ';

        // init query
        $query = "UPDATE $this->table SET $placeholders WHERE $kondisi_key = ?";
        
        // prepare query
        $this->db->query($query);

        // binding data
        $i = 1;
        foreach ($update_values as $value) {
            $this->db->bind($i, $value);
            $i++;
        }

        // binding where kondisi
        $this->db->bind($i, $kondisi_value);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
