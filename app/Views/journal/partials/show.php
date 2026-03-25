<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>

<section class="py-5">
    <div class="container" style="max-width: 800px;">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('journal') ?>">Journal</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= esc($journal['title']) ?></li>
            </ol>
        </nav>

        <!-- Category Tag -->
        <?php if (!empty($journal['category'])): ?>
            <span class="journal-tag mb-3 d-inline-block"><?= esc($journal['category']) ?></span>
        <?php endif; ?>

        <!-- Title -->
        <h1 class="fw-bold mb-2" style="color:var(--navy-blue);">
            <?= esc($journal['title']) ?>
        </h1>

        <!-- Date -->
        <p class="text-muted mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16" class="me-1">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" />
                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
            </svg>
            <?= date('d F Y', strtotime($journal['created_at'])) ?>
            <?php if ($journal['updated_at'] && $journal['updated_at'] !== $journal['created_at']): ?>
                &nbsp;·&nbsp; <em>Diperbarui <?= date('d F Y', strtotime($journal['updated_at'])) ?></em>
            <?php endif; ?>
        </p>

        <!-- Cover Image -->
        <?php if (!empty($journal['cover_image'])): ?>
            <img src="<?= base_url($journal['cover_image']) ?>"
                alt="<?= esc($journal['title']) ?>"
                class="img-fluid rounded-3 mb-4 w-100"
                style="max-height:420px; object-fit:cover;">
        <?php endif; ?>

        <!-- Content -->
        <div class="journal-content lh-lg">
            <?= $journal['content'] /* konten boleh berisi HTML (dari editor) */ ?>
        </div>

        <!-- Back Button -->
        <div class="mt-5 pt-3 border-top">
            <a href="<?= base_url('journal') ?>" class="btn btn-outline-warning">
                &larr; Kembali ke Journal
            </a>
        </div>

    </div>

    <!-- Related Posts -->
    <?php if (!empty($related)): ?>
        <div class="container mt-5">
            <h4 class="fw-bold mb-4" style="color:var(--navy-blue);">Tulisan Lainnya</h4>
            <div class="row g-4">
                <?php foreach ($related as $rel): ?>
                    <div class="col-12 col-md-4">
                        <a href="<?= base_url('journal/' . $rel['slug']) ?>" class="text-decoration-none">
                            <div class="card h-100 shadow-sm border-0 journal-card overflow-hidden">
                                <?php if (!empty($rel['cover_image'])): ?>
                                    <img src="<?= base_url($rel['cover_image']) ?>"
                                        class="card-img-top" style="height:160px;object-fit:cover;" loading="lazy"
                                        alt="<?= esc($rel['title']) ?>">
                                <?php endif; ?>
                                <div class="card-body">
                                    <?php if (!empty($rel['category'])): ?>
                                        <span class="journal-tag mb-2 d-inline-block"><?= esc($rel['category']) ?></span>
                                    <?php endif; ?>
                                    <h6 class="fw-bold" style="color:var(--navy-blue);"><?= esc($rel['title']) ?></h6>
                                    <small class="text-muted"><?= date('d M Y', strtotime($rel['created_at'])) ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</section>

<style>
    .journal-tag {
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

    .journal-content {
        font-size: 1.05rem;
        color: #333;
    }

    .journal-content p {
        margin-bottom: 1.2rem;
    }

    .journal-content img {
        max-width: 100%;
        border-radius: 8px;
        margin: 1rem 0;
    }
</style>

<?= $this->endSection() ?>