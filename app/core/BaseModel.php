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
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        $query = "SELECT * FROM $this->table WHERE $key = ?";
        $this->db->query($query);
        $this->db->bind(1, $value);
        $this->db->execute();
        return (!is_bool($this->db->single())) ? true : false;
    }

    /**
     * @param array $kondisi masukkan sebuah kondisi where untuk menghapus data contoh `["id" => 1]`
     * @return int rowCount (0 || (> 0))
     */
    public function deleteData(array $kondisi): int
    {
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        $query = "DELETE FROM $this->table WHERE $key = ?";
        $this->db->query($query);
        $this->db->bind(1, $value);
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
        $kondisi_key = array_keys($kondisi)[0];
        $kondisi_value = array_values($kondisi)[0];

        $set_clause = implode(' = ?, ', array_keys($update_values)) . ' = ? ';
        
        $query = "UPDATE $this->table SET $set_clause WHERE $kondisi_key = ?";
        $this->db->query($query);
        
        // binding data
        $i = 1;
        foreach($update_values as $key => $value) {
            $this->db->bind($i, $value);
            $i++;
        }

        // binding where kondisi
        $this->db->bind($i, $kondisi_value);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
