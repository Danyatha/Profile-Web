<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<!-- Header row -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><?= esc($title) ?></h4>
    <a href="<?= base_url('admin/portfolio/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Portfolio
    </a>
</div>

<!-- Search -->
<div class="mb-4">
    <form action="<?= base_url('admin/portfolio/search') ?>" method="get" class="d-flex gap-2" style="max-width:400px">
        <input type="text" name="keyword" class="form-control"
            placeholder="Cari portfolio..."
            value="<?= isset($keyword) ? esc($keyword) : '' ?>">
        <button class="btn btn-outline-secondary" type="submit">
            <i class="fas fa-search"></i>
        </button>
        <?php if (!empty($keyword)): ?>
            <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-outline-danger">
                <i class="fas fa-times"></i>
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Portfolio grid -->
<?php if (empty($portfolios)): ?>
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="fas fa-briefcase fa-3x mb-3 d-block"></i>
            Belum ada data portfolio.
        </div>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($portfolios as $portfolio): ?>
            <div class="col-md-6 col-xl-4">
                <div class="card h-100 card-lift">

                    <?php if (!empty($portfolio['images_path'])): ?>
                        <img src="<?= base_url($portfolio['images_path']) ?>"
                            class="card-img-top"
                            alt="<?= esc($portfolio['project_name']) ?>"
                            style="height:200px;object-fit:cover;">
                    <?php else: ?>
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                            style="height:200px;">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= esc($portfolio['project_name']) ?></h5>
                        <p class="card-text text-muted small">
                            <?= esc(mb_substr($portfolio['description'] ?? '', 0, 100)) ?>
                            <?= strlen($portfolio['description'] ?? '') > 100 ? '…' : '' ?>
                        </p>

                        <?php if (!empty($portfolio['technologies_used'])): ?>
                            <p class="mb-2">
                                <small class="text-muted">
                                    <strong>Tech:</strong> <?= esc($portfolio['technologies_used']) ?>
                                </small>
                            </p>
                        <?php endif; ?>

                        <?php if (!empty($portfolio['project_url'])): ?>
                            <a href="<?= esc($portfolio['project_url']) ?>"
                                target="_blank" rel="noopener"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-external-link-alt me-1"></i>Lihat Project
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100">
                            <a href="<?= base_url('admin/portfolio/show/' . $portfolio['id']) ?>"
                                class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye me-1"></i>Detail
                            </a>
                            <a href="<?= base_url('admin/portfolio/edit/' . $portfolio['id']) ?>"
                                class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="<?= base_url('admin/portfolio/delete/' . $portfolio['id']) ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Yakin ingin menghapus portfolio ini?')">
                                <i class="fas fa-trash me-1"></i>Hapus
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?= $this->endSection() ?>