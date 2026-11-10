<h2>Manajemen Posisi Jabatan & Mahar</h2>

<?php if (!isset($_GET['action'])): ?>
    <a href="index.php?page=positions&action=add" class="btn btn-primary">+ Tambah Jabatan Baru</a>
<?php endif; ?>

<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
<div class="form-container">
    <h3><?= isset($editPos) && $editPos ? 'Edit Data Jabatan' : 'Tambah Jabatan Baru' ?></h3>
    <form action="index.php?page=positions" method="POST">
        <?php if (isset($editPos) && $editPos): ?>
            <input type="hidden" name="id" value="<?= $editPos['id'] ?>">
        <?php endif; ?>

        <div>
            <label>Instansi / Dinas:</label>
            <select name="department_id" required>
                <option value="">-- Pilih Instansi --</option>
                <?php foreach ($department->getAllDepartments() as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= (isset($editPos) && $editPos && $editPos['department_id'] == $d['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['dept_code']) ?> - <?= htmlspecialchars($d['dept_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Nama Jabatan:</label>
            <input type="text" name="position_name" value="<?= isset($editPos) && $editPos ? htmlspecialchars($editPos['position_name']) : '' ?>" required placeholder="Contoh: Kepala Dinas Proyek Jalan Tol">
        </div>

        <div>
            <label>Harga Mahar (Rp):</label>
            <input type="number" step="0.01" name="price" value="<?= isset($editPos) && $editPos ? $editPos['price'] : '' ?>" required placeholder="Contoh: 15000000000">
        </div>

        <div>
            <label>Kuota Kursi:</label>
            <input type="number" name="quota" value="<?= isset($editPos) && $editPos ? $editPos['quota'] : '1' ?>" required min="1">
        </div>

        <?php if (isset($editPos) && $editPos): ?>
            <button type="submit" name="update_position" class="btn btn-success">Update Jabatan</button>
            <a href="index.php?page=positions" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add_position" class="btn btn-success">Simpan Jabatan</button>
            <a href="index.php?page=positions" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php endif; ?>
    </form>
</div>
<?php endif; ?>

<h2>Daftar Posisi Jabatan & Mahar</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Instansi</th>
        <th>Nama Jabatan</th>
        <th>Harga Mahar</th>
        <th>Kuota</th>
        <th>Action</th>
    </tr>
    <?php foreach ($position->getAllPositions() as $p): ?>
    <tr>
        <td><?= $p['id'] ?></td>
        <td><?= htmlspecialchars($p['dept_name']) ?></td>
        <td><strong><?= htmlspecialchars($p['position_name']) ?></strong></td>
        <td>Rp <?= number_format($p['price'], 2, ',', '.') ?></td>
        <td><?= $p['quota'] ?> Kursi</td>
        <td class="table-actions">
            <a href="index.php?page=positions&action=edit&id=<?= $p['id'] ?>" class="btn btn-warning">Edit</a> 
            <a href="index.php?page=positions&action=delete&id=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jabatan ini?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>