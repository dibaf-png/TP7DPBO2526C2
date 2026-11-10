<?php
// Memanggil file konfigurasi koneksi database
require_once 'config/db.php';

// Mendefinisikan class model Department untuk entitas instansi / dinas
class Department {
    // Properti privat untuk menampung instance koneksi database
    private $db;

    // Constructor untuk menginisialisasi koneksi PDO secara otomatis
    public function __construct() {
        // Mengambil koneksi dari class Database
        $this->db = (new Database())->conn;
    }

    // Method untuk mengambil seluruh data instansi diurutkan dari ID terbaru
    public function getAllDepartments() {
        // Menjalankan query SQL SELECT untuk mengambil semua data departments
        $stmt = $this->db->query("SELECT * FROM departments ORDER BY id ASC");
        // Mengembalikan data dalam bentuk array asosiatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil satu data instansi spesifik berdasarkan ID
    public function getDepartmentById($id) {
        // Menyiapkan prepared statement untuk mencegah SQL Injection
        $stmt = $this->db->prepare("SELECT * FROM departments WHERE id = ?");
        // Mengeksekusi query dengan parameter ID
        $stmt->execute([$id]);
        // Mengembalikan satu baris data hasil query
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk menambahkan data instansi baru dengan validasi input
    public function createDepartment($dept_code, $dept_name) {
        // Membersihkan spasi di awal dan akhir input menggunakan trim()
        $dept_code = trim($dept_code);
        $dept_name = trim($dept_name);

        // Validasi sisi server: pastikan kode dan nama instansi tidak kosong
        if (empty($dept_code) || empty($dept_name)) {
            // Mengembalikan nilai false jika data tidak valid
            return false;
        }

        // Menyiapkan query INSERT jika data lolos validasi
        $stmt = $this->db->prepare("INSERT INTO departments (dept_code, dept_name) VALUES (?, ?)");
        // Mengeksekusi query dengan data kode dan nama instansi
        return $stmt->execute([$dept_code, $dept_name]);
    }

    // Method untuk memperbarui data instansi dengan validasi input
    public function updateDepartment($id, $dept_code, $dept_name) {
        // Membersihkan spasi di awal dan akhir input
        $dept_code = trim($dept_code);
        $dept_name = trim($dept_name);

        // Validasi sisi server: pastikan ID valid serta kode & nama instansi tidak kosong
        if (empty($id) || !is_numeric($id) || empty($dept_code) || empty($dept_name)) {
            return false;
        }

        // Menyiapkan query UPDATE berdasarkan ID
        $stmt = $this->db->prepare("UPDATE departments SET dept_code = ?, dept_name = ? WHERE id = ?");
        // Mengeksekusi query dengan data baru dan ID target
        return $stmt->execute([$dept_code, $dept_name, $id]);
    }

    // Method untuk menghapus data instansi dari database dengan penanganan error foreign key
    public function deleteDepartment($id) {
        try {
            // Menyiapkan query DELETE berdasarkan ID
            $stmt = $this->db->prepare("DELETE FROM departments WHERE id = ?");
            // Mengeksekusi query hapus data
            return $stmt->execute([$id]);
        } 
        catch (PDOException $e) {
            // Mengembalikan false jika terjadi kendala relasi foreign key
            return false;
        }
    }
}
?>