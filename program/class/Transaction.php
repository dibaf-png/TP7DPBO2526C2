<?php
// Memanggil file koneksi database
require_once 'config/db.php';

// Mendefinisikan class model Transaction untuk entitas transaksi suap kursi jabatan
class Transaction {
    private $db;

    // Constructor inisialisasi koneksi PDO
    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Method untuk mengambil seluruh transaksi suap dengan JOIN ke tabel terkait
    public function getAllTransactions() {
        $query = "SELECT t.*, c.name AS candidate_name, c.no_ktp, 
                         p.position_name, p.price AS target_price, d.dept_name 
                  FROM transactions t
                  JOIN candidates c ON t.candidate_id = c.id
                  JOIN positions p ON t.position_id = p.id
                  JOIN departments d ON p.department_id = d.id
                  ORDER BY t.id ASC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk mengambil transaksi berdasarkan ID
    public function getTransactionById($id) {
        $stmt = $this->db->prepare("SELECT * FROM transactions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method untuk membuat transaksi suap baru dengan validasi
    public function createTransaction($candidate_id, $position_id, $amount_paid, $payment_method, $note, $status, $transaction_date) {
        $payment_method = trim($payment_method);
        $status = trim($status);

        // Validasi sisi server: pastikan relasi ID terisi, jumlah bayar tidak negatif, dan field penting tidak kosong
        if (empty($candidate_id) || empty($position_id) || !is_numeric($amount_paid) || $amount_paid < 0 || empty($payment_method) || empty($status) || empty($transaction_date)) {
            return false;
        }

        // Menyiapkan query INSERT transaksi suap baru
        $stmt = $this->db->prepare("INSERT INTO transactions (candidate_id, position_id, amount_paid, payment_method, note, status, transaction_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        // Mengeksekusi query
        return $stmt->execute([$candidate_id, $position_id, $amount_paid, $payment_method, $note, $status, $transaction_date]);
    }

    // Method untuk mengupdate transaksi suap dengan validasi
    public function updateTransaction($id, $candidate_id, $position_id, $amount_paid, $payment_method, $note, $status, $transaction_date) {
        $payment_method = trim($payment_method);
        $status = trim($status);

        // Validasi sisi server untuk proses update transaksi
        if (empty($id) || !is_numeric($id) || empty($candidate_id) || empty($position_id) || !is_numeric($amount_paid) || $amount_paid < 0 || empty($payment_method) || empty($status) || empty($transaction_date)) {
            return false;
        }

        // Menyiapkan query UPDATE data transaksi
        $stmt = $this->db->prepare("UPDATE transactions SET candidate_id = ?, position_id = ?, amount_paid = ?, payment_method = ?, note = ?, status = ?, transaction_date = ? WHERE id = ?");
        // Mengeksekusi query
        return $stmt->execute([$candidate_id, $position_id, $amount_paid, $payment_method, $note, $status, $transaction_date, $id]);
    }

    // Method untuk menghapus data transaksi
    public function deleteTransaction($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM transactions WHERE id = ?");
            return $stmt->execute([$id]);
        } 
        catch (PDOException $e) {
            return false;
        }
    }
}
?>