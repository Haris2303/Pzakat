<?php

class Video_model
{

    /**
     * Nama tabel dalam basis data untuk data video.
     * @var string
     */
    private $table = 'tb_video';

    /**
     * Objek model basis data untuk data video.
     * @var [tipe objek yang sesuai]
     */
    private $baseModel;

    /**
     * Konstruktor kelas yang menginisialisasi objek model basis data.
     */
    public function __construct()
    {
        // Menginisialisasi objek 'baseModel' untuk data video.
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * Mengambil data video dari basis data.
     *
     * @return array Sebuah array yang berisi data video yang diambil dari basis data.
     */
    public function getData(): array
    {
        // Melakukan operasi SELECT data dari basis data.
        $this->baseModel->selectData();

        // Mengambil dan mengembalikan data video yang diambil dari basis data.
        return $this->baseModel->fetch();
    }


    /**
     * Mengubah data video dalam basis data berdasarkan ID video tertentu.
     *
     * @param array $data Array yang berisi data yang akan diubah.
     * @return int Jumlah baris yang terpengaruh oleh operasi UPDATE.
     */
    public function ubahData(array $data): int
    {
        // Mengubah data video dalam basis data berdasarkan ID video tertentu.
        // Kolom yang akan diubah adalah "link" dan "datetime".
        return $this->baseModel->updateData(["link" => $data['link'], "datetime" => date('Y-m-d H:i:s')], ["id_video" => 1]);
    }
}
