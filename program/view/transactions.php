<h2>Manajemen Transaksi Jual Beli Jabatan</h2>

<?php if (!isset($_GET['action'])): ?>
    <a href="index.php?page=transactions&action=add" class="btn btn-primary">+ Tambah Transaksi Baru</a>
<?php endif; ?>

<?php if (isset($_GET['action']) && ($_GET['action'] == 'add' || $_GET['action'] == 'edit')): ?>
<div class="form-container">
    <h3><?= isset($editTrans) && $editTrans ? 'Edit Data Transaksi Suap' : 'Tambah Transaksi Baru' ?></h3>
    <form action="index.php?page=transactions" method="POST">
        <?php if (isset($editTrans) && $editTrans): ?>
            <input type="hidden" name="id" value="<?= $editTrans['id'] ?>">
        <?php endif; ?>

        <div>
            <label>Kandidat / Pejabat:</label>
            <select name="candidate_id" required>
                <option value="">-- Pilih Kandidat --</option>
                <?php foreach ($candidate->getAllCandidates() as $c): ?>
                    <option value="<?= $c['id'] ?>" <?= (isset($editTrans) && $editTrans && $editTrans['candidate_id'] == $c['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($c['name']) ?> (KTP: <?= $c['no_ktp'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Jabatan Incaran:</label>
            <select name="position_id" required>
                <option value="">-- Pilih Jabatan --</option>
                <?php foreach ($position->getAllPositions() as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= (isset($editTrans) && $editTrans && $editTrans['position_id'] == $p['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['position_name']) ?> (Rp <?= number_format($p['price'], 0, ',', '.') ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Jumlah Mahar Disetor (Rp):</label>
            <input type="number" step="0.01" name="amount_paid" value="<?= isset($editTrans) && $editTrans ? $editTrans['amount_paid'] : '' ?>" required placeholder="Contoh: 5000000000">
        </div>

        <div>
            <label>Metode / Kedok Pembayaran:</label>
            <input type="text" name="payment_method" value="<?= isset($editTrans) && $editTrans ? htmlspecialchars($editTrans['payment_method']) : '' ?>" required placeholder="Contoh: Donasi Panti Asuhan Fiktif">
        </div>

        <div>
            <label>Catatan Khusus / Keterangan:</label>
            <textarea name="note" rows="2" placeholder="Contoh: DP Awal 50% via offshore"><?= isset($editTrans) && $editTrans ? htmlspecialchars($editTrans['note']) : '' ?></textarea>
        </div>

        <div>
            <label>Status Transaksi:</label>
            <select name="status" required>
                <?php 
                $statuses = ['Pending', 'Verifikasi Mahar', 'Dilantik', 'Kena KPK'];
                foreach ($statuses as $st): 
                ?>
                    <option value="<?= $st ?>" <?= (isset($editTrans) && $editTrans && $editTrans['status'] == $st) ? 'selected' : '' ?>><?= $st ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label>Tanggal Transaksi:</label>
            <input type="date" name="transaction_date" value="<?= isset($editTrans) && $editTrans ? $editTrans['transaction_date'] : date('Y-m-d') ?>" required>
        </div>

        <?php if (isset($editTrans) && $editTrans): ?>
            <button type="submit" name="update_transaction" class="btn btn-success">Update Transaksi</button>
            <a href="index.php?page=transactions" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add_transaction" class="btn btn-success">Simpan Transaksi Suap</button>
            <a href="index.php?page=transactions" class="btn" style="background-color: #444; color: #fff; text-decoration: none; padding: 10px 15px; border-radius: 4px; display: inline-block;">Cancel</a>
        <?php endif; ?>
    </form>
</div>
<?php endif; ?>

<h2>Daftar Transaksi Kursi Jabatan</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Kandidat</th>
        <th>Jabatan Incaran</th>
        <th>Jumlah Bayar</th>
        <th>Kedok Pembayaran</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Action</th>
    </tr>
    <?php foreach ($transaction->getAllTransactions() as $t): ?>
    <tr>
        <td><?= $t['id'] ?></td>
        <td><?= htmlspecialchars($t['candidate_name']) ?></td>
        <td><?= htmlspecialchars($t['position_name']) ?></td>
        <td>Rp <?= number_format($t['amount_paid'], 2, ',', '.') ?></td>
        <td><?= htmlspecialchars($t['payment_method']) ?></td>
        <td><strong><?= htmlspecialchars($t['status']) ?></strong></td>
        <td><?= $t['transaction_date'] ?></td>
        <td class="table-actions">
            <a href="index.php?page=transactions&action=edit&id=<?= $t['id'] ?>" class="btn btn-warning">Edit</a> 
            <a href="index.php?page=transactions&action=delete&id=<?= $t['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi suap ini?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>