<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><?= esc($title) ?></h4>
    <a href="<?= base_url('admin/skills/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Skill
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3" style="width:50px">No</th>
                        <th style="width:80px">Icon</th>
                        <th>Nama Skill</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width:160px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($skills)): ?>
                        <?php foreach ($skills as $i => $skill): ?>
                            <tr>
                                <td class="ps-3"><?= $i + 1 ?></td>
                                <td>
                                    <?php if (!empty($skill['image_path'])): ?>
                                        <img src="<?= base_url('uploads/skills/' . esc($skill['image_path'])) ?>"
                                            alt="<?= esc($skill['skill_name']) ?>"
                                            style="width:40px;height:40px;object-fit:contain;">
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="fw-semibold"><?= esc($skill['skill_name']) ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?= esc($skill['category']) ?></span>
                                </td>
                                <td class="text-muted small">
                                    <?= esc(mb_substr($skill['description'] ?? '', 0, 80)) ?>
                                    <?= strlen($skill['description'] ?? '') > 80 ? '…' : '' ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('admin/skills/show/' . $skill['id']) ?>"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="<?= base_url('admin/skills/edit/' . $skill['id']) ?>"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= base_url('admin/skills/delete/' . $skill['id']) ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus skill ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="fas fa-star fa-2x mb-2 d-block"></i>
                                Tidak ada data skill
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>