<?php

class User_model
{

    private $db;
    private $table = [
        "user" => "tb_user",
        "amil" => "tb_amil",
        "muzakki" => "tb_muzakki"
    ];
    private $baseModel;

    // constructor
    public function __construct()
    {
        $this->db = new Database();
        $this->baseModel = new BaseModel($this->table['user']);
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        GET DATA By
     * |---------------------------------------------------------------------------------------------------------------------
     */
    public function getDataById(int $id_user): array {
        $this->baseModel->selectData(null, null, [], ["id_user = " => $id_user]);
        return $this->baseModel->fetch();
    }

    public function getIdByUsername(string $username): array|bool
    {
        $this->baseModel->selectData(null, null, [], ["username = " => $username]);
        return $this->baseModel->fetch();
    }

    public function getTokenByUsername(string $username): string
    {
        $this->baseModel->selectData(null, null, [], ["username = " => $username]);
        return $this->baseModel->fetch()['token'];
    }

    public function getNamaByIdUser(int $id_user): string
    {
        // buat object dari base model
        $modelAdmin = new BaseModel('tb_admin');
        $modelAmil = new BaseModel('tb_amil');
        $modelMuzakki = new BaseModel('tb_muzakki');
        
        // cek pada tb_admin
        $modelAdmin->selectData(null, null, [], ["id_user = " => $id_user]);
        $nama = $modelAdmin->fetch()['nama'];
        if (is_string($nama)) return $nama;

        // cek pada tb_amil
        $modelAmil->selectData(null, null, [], ["id_user = " => $id_user]);
        $nama = $modelAmil->fetch()['nama'];
        if (is_string($nama)) return $nama;

        // cek pada tb_muzakki
        $modelMuzakki->selectData(null, null, [], ["id_user = " => $id_user]);
        $nama = $modelMuzakki->fetch()['nama'];
        if (is_string($nama)) return $nama;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------------
     *      AKTIVASI AKUN
     * ----------------------------------------------------------------------------------------------------------------------------
     */
    public function aktivasiAkun(string $token): int
    {
        return $this->baseModel->updateData(["status_aktivasi" => "1"], ["token" => $token]);
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        CHECK DATA
     * |---------------------------------------------------------------------------------------------------------------------
     */
    // check token
    public function isToken(string $token): bool
    {
        return $this->baseModel->isData(["token" => $token]);
    }

    /**
     * @param string $email tidak boleh kosong
     * @return true(jika valid)|`false`(jika tidak valid)
     */
    public function isEmail(string $email, int $id_user): bool
    {
        $tb_amil = $this->table['amil'];
        $tb_muzakki = $this->table['muzakki'];

        $query = "SELECT email FROM $tb_amil WHERE (email = '$email' AND id_user <> $id_user)";
        $this->db->query($query);
        if (is_string($this->db->single()['email'])) return true;

        $query = "SELECT email FROM $tb_muzakki WHERE (email = '$email' AND id_user <> $id_user)";
        $this->db->query($query);
        if (is_string($this->db->single()['email'])) return true;

        return false;
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *               ACTION DATA  => CREATE | UPDATE | DELETE
     * --------------------------------------------------------------------------------------------------------------------------
     */
    public function createUser(string $user, array $data)
    {
        // buat $user jadi lowercase
        $user = strtolower($user);

        // instansiasi object dari class BaseModel
        $baseModel = new BaseModel($this->table[$user]);

        // generate uuid
        $uuid = Utility::generateUUID();
        // generate token
        $token = Utility::generateToken();

        // cek user
        if ($user === 'amil') $level = '2';
        if ($user === 'muzakki') $level = '3';

        // cek username
        if ($this->baseModel->isData(["username" => $data['username']])) return 'Usename is already available!';
        // cek email
        if ($baseModel->isData(["email" => $data['email']])) return 'Email is already available!';
        // cek nohp
        if ($baseModel->isData(["nohp" => $data['nohp']])) return 'Handphone Number is already available!';

        // cek panjang password
        if (strlen($data['password'] < 8)) return 'Password Terlalu Lemah!';

        // password konfirmasi
        if ($data['password'] === $data['passConfirm']) {
            
            // insert data user
            $dataUser = [
                "username" => htmlspecialchars($data['username']),
                "password" => password_hash($data['password'], PASSWORD_DEFAULT),
                "token" => $token,
                "waktu_login" => date('Y-m-d H:i:s'),
                "level" => $level,
                "status_aktivasi" => '0'
            ];

            if ($this->baseModel->insertData($dataUser) > 0) {

                // get id user
                $this->baseModel->selectData(null, null, [], ["username =" => $data['username']]);
                $id_user = $this->baseModel->fetch()['id_user'];

                if ($user === 'muzakki') {
                    // insert data muzakki
                    $dataMuzakki = [
                        "uuid" => $uuid,
                        "id_user" => $id_user, 
                        "nama" => htmlspecialchars($data['name']),
                        "email" => htmlspecialchars($data['email']),
                        "nohp" => $data['nohp'],
                    ];
                    return $baseModel->insertData($dataMuzakki);
                }

                if ($user === 'amil') {
                    // insert data amil
                    $dataAmil = [
                        "uuid" => $uuid,
                        "id_user" => $id_user,
                        "id_mesjid" => $data['masjid'],
                        "nama" => htmlspecialchars($data['name']),
                        "email" => htmlspecialchars($data['email']),
                        "nohp" => $data['nohp'],
                        "alamat" => htmlspecialchars($data['alamat'])
                    ];
                    return $baseModel->insertData($dataAmil);
                }
            }
        }

        return 'Konfirmasi password tidak sama!';
    }

    // update password user
    public function updatePassword(string $username, array $data): int|string
    {
        $table = $this->table['user'];

        $password               = $data['password'];
        $password_baru          = $data['password_baru'];
        $password_konfirmasi    = $data['password_konfirmasi'];

        // cek password lama
        $cek_password = "SELECT password FROM $table WHERE username = :username";
        $this->db->query($cek_password);
        $this->db->bind('username', $username);
        $pass_in_db = $this->db->single()['password'];

        if (password_verify($password, $pass_in_db)) {

            // cek konfirmasi pasword
            if ($password_baru !== $password_konfirmasi) return 'Password Konfirmasi Salah!';

            // cek length dari password
            if(strlen($password_baru) < 8) return 'Password minimal 8 karakter!';

            // encrypt pass
            $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

            // update data
            return $this->baseModel->updateData(["password" => $password_baru], ["username" => $username]);
        }

        return 'Password Salah!';
    }

    // update password oleh admin
    public function updatePasswordByAdmin(array $data): int|string
    {
        $table = $this->table['user'];
        
        // initial data
        $username     = $data['username'];
        $password     = $data['password'];
        $passConfirm  = $data['passConfirm'];

        // get id user
        $this->db->query("SELECT id_user FROM $table WHERE username = :username");
        $this->db->bind('username', $username);
        $dataUser = $this->db->single();

        // cek panjang password
        if (strlen($password) < 8) return 'Password Terlalu Lemah';

        // cek konfirmasi password
        if ($password !== $passConfirm) return 'Konfirmasi Password Tidak Sama!';

        // encrypt password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // update data
        return $this->baseModel->updateData(["password" => $password], ["id_user" => $dataUser['id_user']]);
    }

    // update data
    public function updateDataById(array $data, int $id_user): int {
        // $table = $this->table['user'];
        $row_data = $this->getDataById($id_user);
        $username = (isset($data['username'])) ? $data['username'] : $row_data['username'];
        $token = (isset($data['token'])) ? $data['token'] : $row_data['token'];

        // cek username
        if(isset($data['username']) && is_int($this->getIdByUsername($data['username'])['id_user'])) return 0;

        return $this->baseModel->updateData(["username" => $username, "token" => $token], ["id_user" => $id_user]);
    }

    // delete data
    public function deleteData(string $token): int 
    {
        return $this->baseModel->deleteData(["token" => $token]);
    }
}
