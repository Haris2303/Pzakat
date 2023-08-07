<?php

class User_model
{

    private $db;
    private $table = [
        "user" => "tb_user",
        "amil" => "tb_amil",
        "muzakki" => "tb_muzakki"
    ];

    // constructor
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        GET DATA By
     * |---------------------------------------------------------------------------------------------------------------------
     */
    public function getIdByUsername(string $username): int
    {
        $table = $this->table['user'];
        $query = "SELECT id_user FROM $table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single()['id_user'];
    }

    public function getTokenByUsername(string $username): string
    {
        $table = $this->table['user'];
        $query = "SELECT token FROM $table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single()['token'];
    }

    public function getNamaByIdUser(int $id_user): string
    {
        $tb_amil = $this->table['amil'];
        $tb_muzakki = $this->table['muzakki'];
        
        // cek pada tb_admin
        $query = "SELECT nama FROM tb_admin WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if (is_string($nama)) return $nama;

        // cek pada tb_amil
        $query = "SELECT nama FROM $tb_amil WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if (is_string($nama)) return $nama;

        // cek pada tb_muzakki
        $query = "SELECT nama FROM $tb_muzakki WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if (is_string($nama)) return $nama;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------------
     *      AKTIVASI AKUN
     * ----------------------------------------------------------------------------------------------------------------------------
     */
    public function aktivasiAkun(string $token): int
    {
        $table = $this->table['user'];
        $query = "UPDATE $table SET status_aktivasi = '1' WHERE token = '$token'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        CHECK DATA
     * |---------------------------------------------------------------------------------------------------------------------
     */
    // check token
    public function isToken(string $token): bool
    {
        $table = $this->table['user'];
        $query = "SELECT token FROM $table WHERE token = '$token'";
        $this->db->query($query);
        if (is_bool($this->db->single())) return false;
        return true;
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
     *               ACTION DATA
     * --------------------------------------------------------------------------------------------------------------------------
     */
    public function createUser(string $user, array $data)
    {
        // buat $user jadi lowercase
        $user = strtolower($user);

        // deklarsi variabel
        $tipeUser   = $this->table[$user];
        $tb_user    = $this->table['user'];
        $uuid       = Utility::generateUUID();

        // cek user
        if ($user === 'amil') {
            $level      = '2';
            $queryAmil  = "INSERT INTO $tipeUser VALUES(NULL, :uuid, :id_user, :id_masjid, :nama, :email, :nohp, :alamat)";
        }
        if ($user === 'muzakki') {
            $level        = '3';
            $queryMuzakki = "INSERT INTO $tipeUser VALUES(NULL,:uuid, :id_user, :nama, :email, :nohp)";
        }

        $query_user     = "INSERT INTO $tb_user VALUES(NULL, :username, :password, :token, NOW(), '$level', '0')";
        $cek_email_nohp  = "SELECT email, nohp FROM $tipeUser WHERE email = :email OR nohp = :nohp";
        $cek_username   = "SELECT username FROM $tb_user WHERE username = :username";

        // cek username
        $this->db->query($cek_username);
        $this->db->bind('username', $data['username']);
        if (count($this->db->resultSet()) > 0) return 'Usename is already available!';

        // cek email dan nohp
        $this->db->query($cek_email_nohp);
        $this->db->bind('email', $data['email']);
        $this->db->bind('nohp', $data['nohp']);
        if (count($this->db->resultSet()) > 0) return 'Email or NoHP is already available!';

        // generate token
        $token = base64_encode(random_bytes(32));
        // delete character '/' and '='
        $token = trim($token, '=');
        $token = explode('/', $token); // delete character '/'
        $token = join('', $token);
        $token = explode('+', $token); // delete character '+'
        $token = urlencode(join('', $token));

        // cek panjang password
        if (strlen($data['password'] < 8)) return 'Password Terlalu Lemah!';

        // password konfirmasi
        if ($data['password'] === $data['passConfirm']) {

            // insert data user
            $this->db->query($query_user);
            $this->db->bind('username', htmlspecialchars($data['username']));
            $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
            $this->db->bind('token', $token);
            $this->db->execute();

            if ($this->db->rowCount() > 0) {

                // get id user
                $this->db->query("SELECT id_user FROM $tb_user WHERE username = :username");
                $this->db->bind('username', $data['username']);
                $id_user = $this->db->single()['id_user'];

                if ($user === 'muzakki') {
                    // insert data muzakki
                    $this->db->query($queryMuzakki);
                    $this->db->bind('uuid', $uuid);
                    $this->db->bind('id_user', $id_user);
                    $this->db->bind('nama', htmlspecialchars($data['name']));
                    $this->db->bind('email', htmlspecialchars($data['email']));
                    $this->db->bind('nohp', htmlspecialchars($data['nohp']));
                    $this->db->execute();
                }

                if ($user === 'amil') {
                    // insert data amil
                    $this->db->query($queryAmil);
                    $this->db->bind('uuid', $uuid);
                    $this->db->bind('id_user', $id_user);
                    $this->db->bind('id_masjid', $data['masjid']);
                    $this->db->bind('nama', htmlspecialchars($data['name']));
                    $this->db->bind('email', htmlspecialchars($data['email']));
                    $this->db->bind('nohp', htmlspecialchars($data['nohp']));
                    $this->db->bind('alamat', htmlspecialchars($data['alamat']));
                    $this->db->execute();
                }

                return $this->db->rowCount();
            }
        }

        return 'Konfirmasi password tidak sama!';
    }

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

            // encrypt pass
            $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

            // update password
            $query = "UPDATE $table SET password = :password WHERE username = :username";
            $this->db->query($query);
            $this->db->bind('password', $password_baru);
            $this->db->bind('username', $username);
            $this->db->execute();

            return $this->db->rowCount();
        }

        return 'Password Salah!';
    }

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

        $query = "UPDATE $table SET password = :password WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('password', $password);
        $this->db->bind('id_user', $dataUser['id_user']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
