<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>
<div class="container mt-5">

    <a href="<?= base_url('admin/skills/create') ?>" class="btn btn-primary mb-3">Tambah Skill</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Skill</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($skills)): ?>
                <?php foreach ($skills as $key => $skill): ?>
                    <tr>
                        <td><?= $key + 1 ?></td>
                        <td><?= esc($skill['skill_name']) ?></td>
                        <td><?= esc($skill['category']) ?></td>
                        <td><?= esc($skill['description']) ?></td>
                        <td>
                            <a href="<?= base_url('admin/skills/show/' . $skill['id']) ?>" class="btn btn-info btn-sm">Detail</a>
                            <a href="<?= base_url('admin/skills/edit/' . $skill['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= base_url('admin/skills/delete/' . $skill['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data skill</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>