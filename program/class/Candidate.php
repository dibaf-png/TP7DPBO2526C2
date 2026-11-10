<?php
// Memanggil file koneksi database
require_once 'config/db.php';

// Mendefinisikan class model Candidate untuk entitas kandidat pejabat pembeli kursi
class Candidate {
    private $db;

    // Constructor inisialisasi koneksi PDO
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Method untuk mengambil semua data kandidat
    public function getAllCandidates() {
        $stmt = $this->db->query("SELECT * FROM candidates ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil data kandidat berdasarkan ID
    public function getCandidateById($id) {
        $stmt = $this->db->prepare("SELECT * FROM candidates WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk menambah kandidat baru dengan validasi input
    public function createCandidate($name, $no_ktp, $no_phone, $wealth_source) {
        // Membersihkan spasi berlebih pada input string
        $name = trim($name);
        $no_ktp = trim($no_ktp);
        $no_phone = trim($no_phone);
        $wealth_source = trim($wealth_source);

        // Validasi sisi server: pastikan kolom terisi dan KTP berupa angka
        if (empty($name) || empty($no_ktp) || !is_numeric($no_ktp) || empty($no_phone) || empty($wealth_source)) {
            return false;
        }

        // Menyiapkan query INSERT jika data valid
        $stmt = $this->db->prepare("INSERT INTO candidates (name, no_ktp, no_phone, wealth_source) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $no_ktp, $no_phone, $wealth_source]);
    }

    // Method untuk mengupdate data kandidat dengan validasi input
    public function updateCandidate($id, $name, $no_ktp, $no_phone, $wealth_source) {
        $name = trim($name);
        $no_ktp = trim($no_ktp);
        $no_phone = trim($no_phone);
        $wealth_source = trim($wealth_source);

        // Validasi sisi server untuk proses update data
        if (empty($id) || !is_numeric($id) || empty($name) || empty($no_ktp) || !is_numeric($no_ktp) || empty($no_phone) || empty($wealth_source)) {
            return false;
        }

        // Menyiapkan query UPDATE data kandidat
        $stmt = $this->db->prepare("UPDATE candidates SET name = ?, no_ktp = ?, no_phone = ?, wealth_source = ? WHERE id = ?");
        return $stmt->execute([$name, $no_ktp, $no_phone, $wealth_source, $id]);
    }

    // Method untuk menghapus data kandidat
    public function deleteCandidate($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM candidates WHERE id = ?");
            return $stmt->execute([$id]);
        } 
        catch (PDOException $e) {
            return false;
        }
    }
}
?>