
<?php
class Database { // Membuat class Database untuk mengatur koneksi ke database
    private $host = "localhost"; // Menyimpan alamat server database
    private $username = "root"; // Menyimpan username database
    private $password = ""; // Menyimpan password database
    private $dbname = "db_jualbeli"; // Menyimpan nama database yang digunakan
    public $conn;// Menyimpan objek koneksi database

    // Constructor dijalankan otomatis ketika objek Database dibuat
    public function __construct() {

        // Mencoba melakukan koneksi ke database
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username,$this->password); // Membuat koneksi menggunakan PDO

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mengatur PDO agar menampilkan exception ketika terjadi kesalahan

        // Menangkap kesalahan jika koneksi database gagal
        } 
        catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage(); // Menampilkan pesan kesalahan koneksi
        }
    }
}
?>
