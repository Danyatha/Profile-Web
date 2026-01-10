<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><?= esc($title) ?></h4>
                    <div>
                        <a href="<?= base_url('admin/portfolio/edit/' . $portfolio['id']) ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="<?= base_url('admin/portfolio/delete/' . $portfolio['id']) ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus portfolio ini?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if ($portfolio['images_path']): ?>
                            <div class="col-md-6 mb-4">
                                <img src="<?= base_url($portfolio['images_path']) ?>"
                                    alt="<?= esc($portfolio['project_name']) ?>"
                                    class="img-fluid rounded shadow-sm">
                            </div>
                            <div class="col-md-6">
                            <?php else: ?>
                                <div class="col-md-12">
                                <?php endif; ?>
                                <h3 class="mb-3"><?= esc($portfolio['project_name']) ?></h3>

                                <?php if ($portfolio['technologies_used']): ?>
                                    <div class="mb-3">
                                        <h5 class="text-muted">Teknologi yang Digunakan:</h5>
                                        <p><?= esc($portfolio['technologies_used']) ?></p>
                                    </div>
                                <?php endif; ?>

                                <?php if ($portfolio['project_url']): ?>
                                    <div class="mb-3">
                                        <h5 class="text-muted">URL Project:</h5>
                                        <a href="<?= esc($portfolio['project_url']) ?>"
                                            target="_blank"
                                            class="btn btn-primary">
                                            <i class="fas fa-external-link-alt"></i> Kunjungi Website
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <h5 class="text-muted">Dibuat:</h5>
                                    <p><?= date('d F Y, H:i', strtotime($portfolio['created_at'])) ?> WIB</p>
                                </div>

                                <?php if ($portfolio['updated_at']): ?>
                                    <div class="mb-3">
                                        <h5 class="text-muted">Terakhir Update:</h5>
                                        <p><?= date('d F Y, H:i', strtotime($portfolio['updated_at'])) ?> WIB</p>
                                    </div>
                                <?php endif; ?>
                                </div>
                            </div>

                            <?php if ($portfolio['description']): ?>
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5 class="text-muted">Deskripsi Project:</h5>
                                        <div class="card bg-light">
                                            <div class="card-body">
                                                <p class="mb-0"><?= nl2br(esc($portfolio['description'])) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <a href="<?= base_url('admin/portfolio') ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Portfolio
                                    </a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->endSection() ?>