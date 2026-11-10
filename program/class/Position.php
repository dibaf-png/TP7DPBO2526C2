<?php
// Memanggil file koneksi database
require_once 'config/db.php';

// Mendefinisikan class model Position untuk entitas posisi jabatan & mahar
class Position {
    // Properti privat untuk koneksi database
    private $db;

    // Constructor untuk inisialisasi koneksi PDO
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Method untuk mengambil seluruh posisi jabatan beserta nama instansinya via JOIN
    public function getAllPositions() {
        $query = "SELECT positions.*, departments.dept_name, departments.dept_code 
                  FROM positions 
                  JOIN departments ON positions.department_id = departments.id 
                  ORDER BY positions.id ASC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil data posisi berdasarkan ID
    public function getPositionById($id) {
        $stmt = $this->db->prepare("SELECT * FROM positions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk menambah posisi jabatan baru dengan validasi input
    public function createPosition($department_id, $position_name, $price, $quota) {
        // Membersihkan spasi pada nama jabatan
        $position_name = trim($position_name);

        // Validasi sisi server: cek field kosong, harga bernilai negatif, atau kuota kurang dari 1
        if (empty($department_id) || empty($position_name) || !is_numeric($price) || $price < 0 || !is_numeric($quota) || $quota < 1) {
            // Mengembalikan nilai false jika gagal validasi
            return false;
        }

        // Menyiapkan query INSERT jika data lolos validasi
        $stmt = $this->db->prepare("INSERT INTO positions (department_id, position_name, price, quota) VALUES (?, ?, ?, ?)");
        // Mengeksekusi query ke database
        return $stmt->execute([$department_id, $position_name, $price, $quota]);
    }

    // Method untuk mengupdate posisi jabatan dengan validasi input
    public function updatePosition($id, $department_id, $position_name, $price, $quota) {
        $position_name = trim($position_name);

        // Validasi sisi server untuk proses update data
        if (empty($id) || !is_numeric($id) || empty($department_id) || empty($position_name) || !is_numeric($price) || $price < 0 || !is_numeric($quota) || $quota < 1) {
            return false;
        }

        // Menyiapkan query UPDATE berdasarkan ID
        $stmt = $this->db->prepare("UPDATE positions SET department_id = ?, position_name = ?, price = ?, quota = ? WHERE id = ?");
        // Mengeksekusi query update
        return $stmt->execute([$department_id, $position_name, $price, $quota, $id]);
    }

    // Method untuk menghapus posisi jabatan
    public function deletePosition($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM positions WHERE id = ?");
            return $stmt->execute([$id]);
        } 
        catch (PDOException $e) {
            return false;
        }
    }
}
?>