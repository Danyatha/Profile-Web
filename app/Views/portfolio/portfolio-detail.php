<?= $this->extend('public/layouts/main') ?>

<?= $this->section('content') ?>

<!-- Breadcrumb -->
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('public/portfolio') ?>">
                        <i class="fas fa-home"></i> Portfolio
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?= esc($portfolio['project_name']) ?>
                </li>
            </ol>
        </nav>
    </div>
</section>

<!-- Project Detail Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Project Image -->
            <div class="col-lg-8 mb-4">
                <?php if ($portfolio['images_path']): ?>
                    <div class="project-image-wrapper">
                        <img src="<?= base_url($portfolio['images_path']) ?>"
                            alt="<?= esc($portfolio['project_name']) ?>"
                            class="img-fluid rounded shadow-lg">
                    </div>
                <?php else: ?>
                    <div class="project-image-wrapper">
                        <div class="bg-gradient rounded shadow-lg d-flex align-items-center justify-content-center"
                            style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <i class="fas fa-image fa-5x text-white opacity-50"></i>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Project Info -->
            <div class="col-lg-4">
                <div class="card shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-body">
                        <h2 class="card-title fw-bold mb-4"><?= esc($portfolio['project_name']) ?></h2>

                        <!-- Technologies -->
                        <?php if ($portfolio['technologies_used']): ?>
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">
                                    <i class="fas fa-code"></i> Teknologi
                                </h6>
                                <div class="d-flex flex-wrap gap-2">
                                    <?php
                                    $techs = explode(',', $portfolio['technologies_used']);
                                    foreach ($techs as $tech):
                                    ?>
                                        <span class="badge bg-primary py-2 px-3">
                                            <?= trim(esc($tech)) ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Project URL -->
                        <?php if ($portfolio['project_url']): ?>
                            <div class="mb-4">
                                <h6 class="text-muted mb-3">
                                    <i class="fas fa-link"></i> Link Project
                                </h6>
                                <a href="<?= esc($portfolio['project_url']) ?>"
                                    target="_blank"
                                    class="btn btn-primary w-100">
                                    <i class="fas fa-external-link-alt"></i> Kunjungi Website
                                </a>
                            </div>
                        <?php endif; ?>

                        <!-- Project Date -->
                        <div class="mb-3">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-calendar"></i> Tanggal Dibuat
                            </h6>
                            <p class="mb-0">
                                <?= date('d F Y', strtotime($portfolio['created_at'])) ?>
                            </p>
                        </div>

                        <!-- Share Buttons -->
                        <div class="mt-4">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-share-alt"></i> Bagikan
                            </h6>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>"
                                    target="_blank"
                                    class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= esc($portfolio['project_name']) ?>"
                                    target="_blank"
                                    class="btn btn-outline-info btn-sm flex-fill">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= current_url() ?>"
                                    target="_blank"
                                    class="btn btn-outline-primary btn-sm flex-fill">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="whatsapp://send?text=<?= esc($portfolio['project_name']) ?> - <?= current_url() ?>"
                                    target="_blank"
                                    class="btn btn-outline-success btn-sm flex-fill">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project Description -->
        <?php if ($portfolio['description']): ?>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title mb-4">
                                <i class="fas fa-align-left"></i> Deskripsi Project
                            </h4>
                            <div class="project-description">
                                <?= nl2br(esc($portfolio['description'])) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Back Button -->
        <div class="row mt-4">
            <div class="col-12">
                <a href="<?= base_url('public/portfolio') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali ke Portfolio
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Related Projects Section (Optional) -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-5">Project Lainnya</h3>
        <div class="row g-4">
            <?php
            // Get other portfolios (limit 3)
            $portfolioModel = new \App\Models\PortfolioModel();
            $otherPortfolios = $portfolioModel
                ->where('id !=', $portfolio['id'])
                ->orderBy('created_at', 'DESC')
                ->findAll(3);

            if (!empty($otherPortfolios)):
                foreach ($otherPortfolios as $other):
            ?>
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm portfolio-card">
                            <?php if ($other['images_path']): ?>
                                <img src="<?= base_url($other['images_path']) ?>"
                                    class="card-img-top"
                                    style="height: 200px; object-fit: cover;"
                                    alt="<?= esc($other['project_name']) ?>">
                            <?php else: ?>
                                <div class="card-img-top bg-gradient d-flex align-items-center justify-content-center"
                                    style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                    <i class="fas fa-image fa-3x text-white opacity-50"></i>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= esc($other['project_name']) ?></h5>
                                <p class="card-text text-muted">
                                    <?= character_limiter(esc($other['description']), 80) ?>
                                </p>
                                <a href="<?= base_url('public/portfolio/detail/' . $other['id']) ?>"
                                    class="btn btn-outline-primary btn-sm">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
            else:
                ?>
                <div class="col-12 text-center text-muted">
                    <p>Belum ada project lainnya</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .project-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .project-image-wrapper img {
        transition: transform 0.3s ease;
    }

    .project-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .project-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
    }

    .portfolio-card {
        transition: transform 0.3s ease;
    }

    .portfolio-card:hover {
        transform: translateY(-5px);
    }
</style>
<?= $this->endSection() ?>