<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><?= esc($title) ?></h5>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/portfolio/edit/' . $portfolio['id']) ?>"
                        class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <a href="<?= base_url('admin/portfolio/delete/' . $portfolio['id']) ?>"
                        class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin ingin menghapus portfolio ini?')">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </a>
                    <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="card-body">

                <!-- Fixed: was broken if/else div nesting in original -->
                <div class="row g-4">
                    <?php if (!empty($portfolio['images_path'])): ?>
                        <div class="col-md-5">
                            <img src="<?= base_url($portfolio['images_path']) ?>"
                                alt="<?= esc($portfolio['project_name']) ?>"
                                class="img-fluid rounded shadow-sm">
                        </div>
                        <div class="col-md-7">
                        <?php else: ?>
                            <div class="col-12">
                            <?php endif; ?>

                            <h3><?= esc($portfolio['project_name']) ?></h3>

                            <?php if (!empty($portfolio['technologies_used'])): ?>
                                <div class="mb-3">
                                    <h6 class="text-muted">Teknologi yang Digunakan</h6>
                                    <p><?= esc($portfolio['technologies_used']) ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($portfolio['project_url'])): ?>
                                <div class="mb-3">
                                    <a href="<?= esc($portfolio['project_url']) ?>"
                                        target="_blank" rel="noopener"
                                        class="btn btn-primary">
                                        <i class="fas fa-external-link-alt me-1"></i>Kunjungi Website
                                    </a>
                                </div>
                            <?php endif; ?>

                            <p class="text-muted small mb-1">
                                <i class="fas fa-clock me-1"></i>
                                Dibuat: <?= date('d F Y, H:i', strtotime($portfolio['created_at'])) ?> WIB
                            </p>
                            <?php if (!empty($portfolio['updated_at'])): ?>
                                <p class="text-muted small">
                                    <i class="fas fa-pencil-alt me-1"></i>
                                    Update: <?= date('d F Y, H:i', strtotime($portfolio['updated_at'])) ?> WIB
                                </p>
                            <?php endif; ?>
                            </div>
                        </div>

                        <?php if (!empty($portfolio['description'])): ?>
                            <hr>
                            <h6 class="text-muted">Deskripsi Project</h6>
                            <div class="bg-light rounded p-3">
                                <p class="mb-0"><?= nl2br(esc($portfolio['description'])) ?></p>
                            </div>
                        <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>