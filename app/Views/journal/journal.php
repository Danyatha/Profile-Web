<?php helper('text'); ?>
<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="journal-section py-5">
    <div class="container">

        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold" style="color: var(--navy-blue);">
                Daily Journal
                <span style="color: orange; font-family:'Abril Fatface';">& Notes</span>
            </h1>
            <p class="text-muted">Thoughts, updates, and things I'm currently working on.</p>
        </div>

        <!-- Filter Kategori -->
        <?php if (!empty($categories)): ?>
            <div class="d-flex flex-wrap gap-2 mb-4 justify-content-center">
                <a href="<?= base_url('journal') ?>"
                    class="btn btn-sm <?= empty($category) ? 'btn-warning' : 'btn-outline-secondary' ?> rounded-pill">
                    All
                </a>
                <?php foreach ($categories as $cat): ?>
                    <?php if (!empty($cat['category'])): ?>
                        <a href="<?= base_url('journal?category=' . urlencode($cat['category'])) ?>"
                            class="btn btn-sm <?= ($category === $cat['category']) ? 'btn-warning' : 'btn-outline-secondary' ?> rounded-pill">
                            <?= esc($cat['category']) ?>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Journal Grid -->
        <?php if (!empty($journals)): ?>
            <div class="row g-4">
                <?php foreach ($journals as $journal): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?= base_url('journal/' . $journal['slug']) ?>" class="text-decoration-none">
                            <div class="card h-100 shadow-sm border-0 journal-card overflow-hidden">
                                <?php if (!empty($journal['cover_image'])): ?>
                                    <div class="journal-cover">
                                        <img src="<?= base_url($journal['cover_image']) ?>"
                                            alt="" aria-hidden="true"
                                            class="journal-cover-bg" loading="lazy">
                                        <img src="<?= base_url($journal['cover_image']) ?>"
                                            alt="<?= esc($journal['title']) ?>"
                                            class="journal-cover-img" loading="lazy">
                                    </div>
                                <?php else: ?>
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="aspect-ratio:16/10; background:linear-gradient(135deg,#f0f4ff,#e8f0fe);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="#b0bcd4" viewBox="0 0 16 16">
                                            <path d="M5 4a.5.5 0 0 0 0 1h6a.5.5 0 0 0 0-1H5zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1H5z" />
                                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H4z" />
                                        </svg>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body d-flex flex-column">
                                    <?php if (!empty($journal['category'])): ?>
                                        <span class="journal-tag mb-2"><?= esc($journal['category']) ?></span>
                                    <?php endif; ?>
                                    <h5 class="fw-bold" style="color:var(--navy-blue);"><?= esc($journal['title']) ?></h5>
                                    <p class="text-muted small flex-grow-1">
                                        <?= character_limiter(strip_tags($journal['content']), 130) ?>
                                    </p>
                                    <small class="text-muted mt-2">
                                        <?= date('d M Y', strtotime($journal['created_at'])) ?>
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($totalPages > 1): ?>
                <nav class="mt-5 d-flex justify-content-center">
                    <ul class="pagination">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= base_url('journal?page=' . ($page - 1) . ($category ? '&category=' . urlencode($category) : '')) ?>">
                                &laquo;
                            </a>
                        </li>
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
                                <a class="page-link" href="<?= base_url('journal?page=' . $i . ($category ? '&category=' . urlencode($category) : '')) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= base_url('journal?page=' . ($page + 1) . ($category ? '&category=' . urlencode($category) : '')) ?>">
                                &raquo;
                            </a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>

        <?php else: ?>
            <div class="text-center py-5">
                <p class="text-muted fs-5">Belum ada jurnal. Cek lagi nanti!</p>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
    /* ── Cover frame: gambar utuh (tidak terpotong), tinggi seragam ── */
    .journal-cover {
        position: relative;
        aspect-ratio: 16 / 10;
        overflow: hidden;
        background: #eef2f9;
        isolation: isolate;
    }

    .journal-cover-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: blur(18px) saturate(1.1) brightness(.92);
        transform: scale(1.18);
        z-index: 0;
    }

    .journal-cover-img {
        position: relative;
        width: 100%;
        height: 100%;
        object-fit: contain;
        z-index: 1;
        transition: transform .3s ease;
    }

    .journal-card:hover .journal-cover-img {
        transform: scale(1.03);
    }

    .journal-tag {
        display: inline-block;
        background: rgba(255, 165, 0, .12);
        color: #b07800;
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: .05em;
        text-transform: uppercase;
        padding: 2px 10px;
        border-radius: 20px;
    }

    .journal-card {
        border-radius: 12px;
        transition: transform .2s, box-shadow .2s;
    }

    .journal-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, .1) !important;
    }
</style>

<?= $this->endSection() ?>