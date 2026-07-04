<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex align-items-center justify-content-between mb-4">
    <h2 class="fw-bold mb-0" style="color:var(--navy-blue);">Kelola Journal</h2>
    <a href="<?= base_url('admin/journals/create') ?>" class="btn btn-primary">
        + Tambah Journal
    </a>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Search -->
<form method="get" action="<?= base_url('admin/journals') ?>" class="mb-4">
    <div class="input-group" style="max-width:380px;">
        <input type="text" name="search" class="form-control"
            placeholder="Cari judul atau kategori..."
            value="<?= esc($search ?? '') ?>">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
        <?php if (!empty($search)): ?>
            <a href="<?= base_url('admin/journals') ?>" class="btn btn-outline-danger">✕</a>
        <?php endif; ?>
    </div>
</form>

<!-- Table -->
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($journals)): ?>
                    <?php foreach ($journals as $i => $j): ?>
                        <tr class="<?= !empty($j['deleted_at']) ? 'table-secondary text-muted' : '' ?>">
                            <td><?= $i + 1 ?></td>
                            <td>
                                <?php if (!empty($j['cover_image'])): ?>
                                    <img src="<?= base_url($j['cover_image']) ?>"
                                        style="width:56px;height:40px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                        style="width:56px;height:40px;">
                                        <small class="text-muted">—</small>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?= esc($j['title']) ?>
                                <?php if (!empty($j['deleted_at'])): ?>
                                    <span class="badge bg-secondary ms-1">Dihapus</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($j['category'])): ?>
                                    <span class="badge bg-warning text-dark"><?= esc($j['category']) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($j['deleted_at'])): ?>
                                    <form action="<?= base_url('admin/journals/toggle/' . $j['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <button type="submit"
                                            class="btn btn-sm <?= $j['is_published'] ? 'btn-success' : 'btn-outline-secondary' ?>">
                                            <?= $j['is_published'] ? 'Published' : 'Draft' ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
                            <td><?= date('d M Y', strtotime($j['created_at'])) ?></td>
                            <td class="text-end">
                                <div class="d-flex gap-1 justify-content-end flex-wrap">

                                    <?php if (empty($j['deleted_at'])): ?>
                                        <!-- View -->
                                        <a href="<?= base_url('journal/' . $j['slug']) ?>"
                                            target="_blank"
                                            class="btn btn-sm btn-outline-secondary"
                                            title="Lihat">👁</a>

                                        <!-- Edit -->
                                        <a href="<?= base_url('admin/journals/edit/' . $j['id']) ?>"
                                            class="btn btn-sm btn-outline-primary"
                                            title="Edit">✏️</a>

                                        <!-- Soft Delete -->
                                        <form action="<?= base_url('admin/journals/delete/' . $j['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('Hapus jurnal ini?')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">🗑</button>
                                        </form>

                                    <?php else: ?>
                                        <!-- Restore -->
                                        <form action="<?= base_url('admin/journals/restore/' . $j['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-success" title="Pulihkan">↩</button>
                                        </form>

                                        <!-- Force Delete -->
                                        <form action="<?= base_url('admin/journals/force-delete/' . $j['id']) ?>"
                                            method="post"
                                            onsubmit="return confirm('Hapus PERMANEN? Tidak bisa dikembalikan!')">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus Permanen">✕</button>
                                        </form>
                                    <?php endif; ?>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada jurnal.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination CI4 -->
<?php if (!empty($pager)): ?>
    <div class="mt-4 d-flex justify-content-center">
        <?= $pager->links('journals', 'bootstrap_full') ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>