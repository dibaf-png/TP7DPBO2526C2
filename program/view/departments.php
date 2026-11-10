<h2>Manajemen Instansi / Dinas</h2>

<!-- Tombol Tambah Data (Hanya muncul jika sedang tidak dalam mode add atau edit) -->
<?php if (!isset($_GET['action'])): ?>
    <a href="index.php?page=departments&action=add" class="btn btn-primary">+ Tambah Instansi Baru</a>
<?php endif; ?>

<!-- Form Tersembunyi (Hanya muncul jika parameter action bernilai 'add' atau 'edit') -->
<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
<div class="form-container">
    <h3><?= isset($editDept) && $editDept ? 'Edit Data Instansi' : 'Tambah Instansi Baru' ?></h3>
    <form action="index.php?page=departments" method="POST">
        <!-- Input tersembunyi untuk membawa ID jika dalam mode edit -->
        <?php if (isset($editDept) && $editDept): ?>
            <input type="hidden" name="id" value="<?= $editDept['id'] ?>">
        <?php endif; ?>

        <div>
            <label>Kode Dinas:</label>
            <input type="text" name="dept_code" value="<?= isset($editDept) && $editDept ? htmlspecialchars($editDept['dept_code']) : '' ?>" required placeholder="Contoh: DPU">
        </div>

        <div>
            <label>Nama Instansi / Dinas:</label>
            <input type="text" name="dept_name" value="<?= isset($editDept) && $editDept ? htmlspecialchars($editDept['dept_name']) : '' ?>" required placeholder="Contoh: Dinas Pekerjaan Proyek Strategis">
        </div>

        <!-- Tombol aksi dinamis dan tombol batal kembali ke tabel -->
        <?php if (isset($editDept) && $editDept): ?>
            <button type="submit" name="update_department" class="btn btn-success">Update Instansi</button>
            <a href="index.php?page=departments" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add_department" class="btn btn-success">Simpan Instansi</button>
            <a href="index.php?page=departments" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php endif; ?>
    </form>
</div>
<?php endif; ?>

<!-- Tabel daftar instansi / dinas -->
<h2>Daftar Instansi / Dinas</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Kode Dinas</th>
        <th>Nama Instansi</th>
        <th>Action</th>
    </tr>
    <!-- Melakukan perulangan untuk menampilkan setiap data instansi dari database -->
    <?php foreach ($department->getAllDepartments() as $d): ?>
    <tr>
        <td><?= $d['id'] ?></td>
        <td><strong><?= htmlspecialchars($d['dept_code']) ?></strong></td>
        <td><?= htmlspecialchars($d['dept_name']) ?></td>
        <td class="table-actions">
            <a href="index.php?page=departments&action=edit&id=<?= $d['id'] ?>" class="btn btn-warning">Edit</a> 
            <!-- Tombol Delete dilengkapi konfirmasi dialog JavaScript -->
            <a href="index.php?page=departments&action=delete&id=<?= $d['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus instansi ini?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>