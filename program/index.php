<?php
// Memanggil seluruh file class model yang dibutuhkan
require_once 'class/Department.php';
require_once 'class/Position.php';
require_once 'class/Candidate.php';
require_once 'class/Transaction.php';

// Menginisialisasi objek dari masing-masing class model
$department = new Department();
$position = new Position();
$candidate = new Candidate();
$transaction = new Transaction();

// --- LOGIKA AKSI KONTROLER (DEPARTEMEN) ---
if (isset($_POST['add_department'])) {
    $department->createDepartment($_POST['dept_code'], $_POST['dept_name']);
    header("Location: index.php?page=departments");
    exit;
}
if (isset($_POST['update_department'])) {
    $department->updateDepartment($_POST['id'], $_POST['dept_code'], $_POST['dept_name']);
    header("Location: index.php?page=departments");
    exit;
}

// --- LOGIKA AKSI KONTROLER (POSISI) ---
if (isset($_POST['add_position'])) {
    $position->createPosition($_POST['department_id'], $_POST['position_name'], $_POST['price'], $_POST['quota']);
    header("Location: index.php?page=positions");
    exit;
}
if (isset($_POST['update_position'])) {
    $position->updatePosition($_POST['id'], $_POST['department_id'], $_POST['position_name'], $_POST['price'], $_POST['quota']);
    header("Location: index.php?page=positions");
    exit;
}

// --- LOGIKA AKSI KONTROLER (KANDIDAT) ---
if (isset($_POST['add_candidate'])) {
    $candidate->createCandidate($_POST['name'], $_POST['no_ktp'], $_POST['no_phone'], $_POST['wealth_source']);
    header("Location: index.php?page=candidates");
    exit;
}
if (isset($_POST['update_candidate'])) {
    $candidate->updateCandidate($_POST['id'], $_POST['name'], $_POST['no_ktp'], $_POST['no_phone'], $_POST['wealth_source']);
    header("Location: index.php?page=candidates");
    exit;
}

// --- LOGIKA AKSI KONTROLER (TRANSAKSI) ---
if (isset($_POST['add_transaction'])) {
    $transaction->createTransaction($_POST['candidate_id'], $_POST['position_id'], $_POST['amount_paid'], $_POST['payment_method'], $_POST['note'], $_POST['status'], $_POST['transaction_date']);
    header("Location: index.php?page=transactions");
    exit;
}
if (isset($_POST['update_transaction'])) {
    $transaction->updateTransaction($_POST['id'], $_POST['candidate_id'], $_POST['position_id'], $_POST['amount_paid'], $_POST['payment_method'], $_POST['note'], $_POST['status'], $_POST['transaction_date']);
    header("Location: index.php?page=transactions");
    exit;
}

// --- LOGIKA GLOBAL HAPUS DATA & AMBIL DATA EDIT ---
$editDept = null;
$editPos = null;
$editCand = null;
$editTrans = null;

if (isset($_GET['action']) && isset($_GET['page'])) {
    $page = $_GET['page'];
    $id = $_GET['id'] ?? null;

    if ($_GET['action'] == 'delete') {
        if ($page == 'departments') $department->deleteDepartment($id);
        if ($page == 'positions') $position->deletePosition($id);
        if ($page == 'candidates') $candidate->deleteCandidate($id);
        if ($page == 'transactions') $transaction->deleteTransaction($id);
        header("Location: index.php?page=" . $page);
        exit;
    } elseif ($_GET['action'] == 'edit') {
        if ($page == 'departments') $editDept = $department->getDepartmentById($id);
        if ($page == 'positions') $editPos = $position->getPositionById($id);
        if ($page == 'candidates') $editCand = $candidate->getCandidateById($id);
        if ($page == 'transactions') $editTrans = $transaction->getTransactionById($id);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Jual Beli Jabatan Pemerintahan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Memanggil header terpisah dari folder view -->
    <?php include 'view/header.php'; ?>
    
    <main>
        <h2>Dashboard Bursa Jabatan</h2>
        <!-- Menu navigasi antartautan halaman -->
        <nav class="navbar">
            <a href="?page=transactions">Transaksi Suap</a> |
            <a href="?page=candidates">Kandidat Pejabat</a> |
            <a href="?page=positions">Posisi & Mahar</a> |
            <a href="?page=departments">Instansi / Dinas</a>
        </nav>

        <?php
        // Sistem routing halaman view berdasarkan parameter URL (?page=...)
        $page = isset($_GET['page']) ? $_GET['page'] : 'transactions';
        
        if ($page == 'departments') {
            include 'view/departments.php';
        } elseif ($page == 'positions') {
            include 'view/positions.php';
        } elseif ($page == 'candidates') {
            include 'view/candidates.php';
        } elseif ($page == 'transactions') {
            include 'view/transactions.php';
        } else {
            echo "<h2>Halaman tidak ditemukan.</h2>";
        }
        ?>
    </main>

    <!-- Memanggil footer terpisah dari folder view -->
    <?php include 'view/footer.php'; ?>
</body>
</html>