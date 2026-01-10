<?= $this->extend('control/layout/admin_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><?= esc($title) ?></h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= base_url('admin/portfolio/create') ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Portfolio
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form action="<?= base_url('portfolio/search') ?>" method="get">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari portfolio..."
                        value="<?= isset($keyword) ? esc($keyword) : '' ?>">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Portfolio List -->
    <?php if (empty($portfolios)): ?>
        <div class="alert alert-info">
            Belum ada data portfolio.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($portfolios as $portfolio): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if ($portfolio['images_path']): ?>
                            <img src="<?= base_url($portfolio['images_path']) ?>"
                                class="card-img-top"
                                alt="<?= esc($portfolio['project_name']) ?>"
                                style="height: 200px; object-fit: cover;">
                        <?php else: ?>
                            <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 200px;">
                                <i class="fas fa-image fa-3x text-white"></i>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <h5 class="card-title"><?= esc($portfolio['project_name']) ?></h5>
                            <p class="card-text">
                                <?= strlen($portfolio['description']) > 100
                                    ? esc(substr($portfolio['description'], 0, 100)) . '...'
                                    : esc($portfolio['description']); ?>

                            </p>

                            <?php if ($portfolio['technologies_used']): ?>
                                <p class="mb-2">
                                    <small class="text-muted">
                                        <strong>Tech:</strong> <?= esc($portfolio['technologies_used']) ?>
                                    </small>
                                </p>
                            <?php endif; ?>

                            <?php if ($portfolio['project_url']): ?>
                                <a href="<?= esc($portfolio['project_url']) ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary mb-2">
                                    <i class="fas fa-external-link-alt"></i> Lihat Project
                                </a>
                            <?php endif; ?>
                        </div>

                        <div class="card-footer bg-transparent">
                            <div class="btn-group w-100" role="group">
                                <a href="<?= base_url('admin/portfolio/show/' . $portfolio['id']) ?>"
                                    class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="<?= base_url('admin/portfolio/edit/' . $portfolio['id']) ?>"
                                    class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="<?= base_url('admin/portfolio/delete/' . $portfolio['id']) ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus portfolio ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>