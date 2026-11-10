<h2>Manajemen Kandidat Pejabat</h2>

<?php if (!isset($_GET['action'])): ?>
    <a href="index.php?page=candidates&action=add" class="btn btn-primary">+ Tambah Kandidat Baru</a>
<?php endif; ?>

<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
<div class="form-container">
    <h3><?= isset($editCand) && $editCand ? 'Edit Data Kandidat' : 'Tambah Kandidat Baru' ?></h3>
    <form action="index.php?page=candidates" method="POST">
        <?php if (isset($editCand) && $editCand): ?>
            <input type="hidden" name="id" value="<?= $editCand['id'] ?>">
        <?php endif; ?>

        <div>
            <label>Nama Lengkap & Gelar:</label>
            <input type="text" name="name" value="<?= isset($editCand) && $editCand ? htmlspecialchars($editCand['name']) : '' ?>" required placeholder="Contoh: Dr. H. Mangkrak S.H.">
        </div>

        <div>
            <label>Nomor KTP:</label>
            <input type="text" name="no_ktp" value="<?= isset($editCand) && $editCand ? htmlspecialchars($editCand['no_ktp']) : '' ?>" required placeholder="Contoh: 432678001">
        </div>

        <div>
            <label>Nomor Telepon:</label>
            <input type="text" name="no_phone" value="<?= isset($editCand) && $editCand ? htmlspecialchars($editCand['no_phone']) : '' ?>" required placeholder="Contoh: 081234567890">
        </div>

        <div>
            <label>Sumber Kekayaan / Aset Asal:</label>
            <input type="text" name="wealth_source" value="<?= isset($editCand) && $editCand ? htmlspecialchars($editCand['wealth_source']) : '' ?>" required placeholder="Contoh: Hasil Tambang Nikel Ilegal">
        </div>

        <?php if (isset($editCand) && $editCand): ?>
            <button type="submit" name="update_candidate" class="btn btn-success">Update Kandidat</button>
            <a href="index.php?page=candidates" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add_candidate" class="btn btn-success">Simpan Kandidat</button>
            <a href="index.php?page=candidates" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php endif; ?>
    </form>
</div>
<?php endif; ?>

<h2>Daftar Kandidat Pejabat</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Lengkap</th>
        <th>No KTP</th>
        <th>No Telepon</th>
        <th>Sumber Kekayaan</th>
        <th>Action</th>
    </tr>
    <?php foreach ($candidate->getAllCandidates() as $c): ?>
    <tr>
        <td><?= $c['id'] ?></td>
        <td><strong><?= htmlspecialchars($c['name']) ?></strong></td>
        <td><?= htmlspecialchars($c['no_ktp']) ?></td>
        <td><?= htmlspecialchars($c['no_phone']) ?></td>
        <td><?= htmlspecialchars($c['wealth_source']) ?></td>
        <td class="table-actions">
            <a href="index.php?page=candidates&action=edit&id=<?= $c['id'] ?>" class="btn btn-warning">Edit</a> 
            <a href="index.php?page=candidates&action=delete&id=<?= $c['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kandidat ini?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>